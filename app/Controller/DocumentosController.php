<?php

class DocumentosController extends AppController {
    public $uses = array('Documento', 'Nota');
    public $helpers = array('Html', 'Form', 'Number', 'Crumb');
    public $components = array('Session','Email', 'Issuu' => array('apiAddress' => 'http://upload.issuu.com/1_0'));
    public $name = 'Documentos';
    
    private $folderPath = 'files';
    /*
     * Esta función se ejectuta antes de cada acción del Controlador Users
     */
    public function beforeFilter() {
        parent::beforeFilter();
        // Lista de acciones donde no es requirida la autenticación del Usuario.
        $this->Auth->allow('add', 'login', 'logout','upload');
        $this->set('title_for_layout', 'Documentos');
    }
    
    public function index() {
        if (parent::isAdmin()) {
            $this->redirect(array('action' => 'index', 'admin' => 1));
        } else {
            $this->set('documentos', $this->Documento->find('all', array(
                'conditions' => array('Documento.user_id' => $this->Auth->user('id'))
            )));
        }
    }
    
    public function admin_index() {
        $this->Documento->recursive = 0;
        $this->set('documentos', $this->paginate());
        $this->render('index');
    }
    
    public function admin_change($id = null, $status = '') {
        $this->autoRender = false;
        
        $this->Documento->id = $id;
        if (!$this->Documento->exists()) {
            throw new NotFoundException('Documento no Existe');
        }
        if ($this->request->is('post')) {
            $this->Documento->recursive = -1;
            
            $documento = $this->Documento->read(null, $id);
            //debug($documento); die;
            if (!$$documento['Documento']['status'] && $this->Documento->saveField('status', 1)) {
                $nota = array('Nota' => array(
                    'user_id' => $this->Auth->user('id'),
                    'to_user_id' => $documento['Documento']['user_id'],
                    'type' => 'documento',
                    'type_id' => $documento['Documento']['id'],
                    'text' => 'El documento ha sido aprobado.',
                    'status' => 0
                ));
                $this->Nota->create($nota);
                $this->Nota->save();
                $this->success('Se ha aprobado el artículo.');
            } else {
                $this->error('No se ha podido cambiar el estado del artículo.');
            }
            //debug($this->Beca->validationErrors); die;
        }
        $this->redirect(array('action' => 'index'));
    }
    
    public function view($id = null) {
        $this->Documento->id = $id;
        if (!$this->Documento->exists()) {
            throw new NotFoundException('Documento que buscas no existe.');
        } else {
            $this->Documento->recursive = -1;
            $documento = $this->Documento->read(null, $id);
            $this->set('documento', $documento);
        }
        //$this->set('documentId', '120211003710-a3728bd97ffc402a87b2e42c19dba049');
    }
    
    public function upload_issuu() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            
            $this->Issuu->openAction($data['action']);
            $this->Issuu->setFile($data['Documento']['file']);
            $this->Issuu->name($data['Documento']['name']);
            
            if ($this->validateField('name', $this->Issuu->getName())) {
                if ($this->Issuu->executeAction()) {
                    $docData = $this->Issuu->getResponseDoc();
                    if ($this->saveIssuuDocument($docData)) {
                        $this->info('Se ha guardado el documento con el nombre ' . $docData['name'] . '.');
                    } else {
                        $this->error('Ha ocurrido un error. No se han podido guardar los datos.');
                    }
                }
                else {
                    $this->error('Error al subir el archivo. Intenta de nuevo.');
                }
            }

            $this->Issuu->closeAction();
        }
    }
    
    private function saveIssuuDocument($issuDocument = array()) {
        $data = array();
        $this->Documento->create();
        $data['user_id'] = $this->Auth->user('id');
        $data['documentId'] = $issuDocument['documentId'];
        $data['originalName'] = $issuDocument['orgDocName'];
        $data['issuuAccount'] = $issuDocument['username'];
        $data['name'] = $issuDocument['name'];
        $data['type'] = $issuDocument['orgDocType'];
        $data['size'] = $issuDocument['size'];
        $data['url'] = 'http://issuu.com/' . $data['issuuAccount'] . '/docs/' . $data['name'];
        
        return $this->Documento->save($data);
    }
    
    /**
     * Valida un campo del Modelo.
     * 
     * @param string $field
     * @param string $value
     * @return boolean 
     */
    private function validateField($field = '', $value = '') {
        $this->Documento->create();
        $this->Documento->set($field, $value);
        
        if (!$this->Documento->validates()) {
            $this->error('Datos invalidos. Verifica de nuevo.');
            return false;
        }
        return true;
    } 

    public function upload() {
        
        // Los archivos sólo se pueden cargar mediante POST.
        if ($this->request->is('post')) {
            $this->layout = false;
            if(isset($_FILES['ax-files'])) 
            {
                pr('ewrwererwrwerwerwerwer');
            } elseif (isset($_GET['ax-file-name'])) {
                pr('asdadasdasdasd');
                pr($_GET);
                pr($this->request->data);
            } else {
                pr('123123132132131');
            }  
        } elseif ($this->request->is('get')) {
            $this->set('requireFileupload', true);
        }
    }
    
    function uploadFile($folder, $formData, $item = null) {
        $folderUrl = WWW_ROOT . $folder;
        $relativeUrl = $folder;
        $allowedFileTypes = array(/*'image/gif', 'image/jpeg', 'image/png',*/'application/pdf');
        
        // Si el directorio no esta creado lo crea.
        if (!is_dir($folderUrl)) {
            mkdir($folderUrl);
        }
        
        if ($item) {
            $folderUrl = WWW_ROOT . $folder . '/' . $item;
            $relativeUrl = $folder . '/' . $item;
            if (!is_dir($folderUrl)) {
                mkdir($folderUrl);
            }
        }
        
        foreach ($formData as $file) {
            // En caso de que un archivo tenca espacios en su nombre se reemplazan por '_'
            $filename = str_replace(' ', '_', $file['name']);
            // Variable 
            $typeOk = in_array($file['type'], $allowedFileTypes, true);
            
            /*foreach ($allowedFileTypes as $fileType) {
                if ($fileType === $file['type']) {
                    $typeOk = true;
                    break;
                }
            }*/
            
            if ($typeOk) {
                switch ($file['error']) {
                    case 0:
                        if (!file_exists($folderUrl . '/' . $filename)) {
                            $full_url = $folderUrl . '/' . $filename;
                            $url = $relativeUrl . '/' . $filename;
                            $success = move_uploaded_file($file['tmp_name'], $url);
                        } else {
                            // create unique filename and upload file  
                            ini_set('date.timezone', 'Europe/London');  
                            $now = date('Y-m-d-His');  
                            $full_url = $folderUrl .'/'.$now . $filename;  
                            $url = $relativeUrl.'/'. $now . $filename;  
                            $success = move_uploaded_file($file['tmp_name'], $url);
                        }
                        
                        if($success) {  
                            // save the url of the file  
                            $result['urls'][] = $url;  
                        } else {  
                            $result['errors'][] = "Error uploaded $filename. Please try again.";  
                        }  
                        break;  
                    case 3:  
                        // an error occured  
                        $result['errors'][] = "Error uploading $filename. Please try again.";  
                        break;  
                    default:  
                        // an error occured  
                        $result['errors'][] = "System error uploading $filename. Contact webmaster.";  
                        break;  
                }
            } else if ($file['error'] == 4) {  
                // no file was selected for upload  
                $result['nofiles'][] = "No file Selected";  
            } else {  
                // unacceptable file type  
                $result['errors'][] = "$filename cannot be uploaded. Acceptable file types: pdf.";  
            } 
        }
        return $result; 
    }
}
?>

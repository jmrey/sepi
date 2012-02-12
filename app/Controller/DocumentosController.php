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
        $this->Auth->allow('add', 'login', 'logout');
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
    
    public function view() {
        $this->set('documentId', '120211003710-a3728bd97ffc402a87b2e42c19dba049');
    }
    
    public function upload_issuu() {
        if ($this->request->is('post')) {
            $action = $this->request->data['Documento']['action'];
            $file = $this->request->data['Documento']['file'];
            $this->Issuu->openAction($action);
            $this->Issuu->setFile($file);
            $this->Issuu->executeAction();
            debug($this->Issuu->getResponse()); die;
            $this->Issuu->closeAction();
        }
    }
    
    public function upload() {
        
        // Los archivos sólo se pueden cargar mediante POST.
        if ($this->request->is('post')) {
            
            $results = $this->uploadFile($this->folderPath, $this->request->data['Documento']);
            $this->set('results', $results);
            //pr($results);
            if (!(array_key_exists('errors', $results) || array_key_exists('nofiles', $results))) {
                $this->Documento->create();
                $data = $this->request->data['Documento']['submittedfile'];
                $data['user_id'] = $this->Auth->user('id');
                $data['url'] = 'files/' . $data['name'];
                if ($this->Documento->save($data)) {
                    $this->info('Se han guardado los datos.');
                    //$this->redirect(array('action' => 'index'));
                } else {
                    $this->error('No se han podido guardar los datos.');
                }
            } else {
                $this->error($results['errors'][0]);
            }
        } elseif ($this->request->is('get')) {
            $apiKey = '5h2jdh47dz9y4ddj5wckuv4g1qipbn5p';
            $secret = 'qp7dsg1p6so5xlr3imh8sxgy5rh5bhaz';
            $signature = md5($secret . 'action' . 'issuu.document.upload' . 'apiKey' . $apiKey . 'formatjson');
            $this->set('signature', $signature);
            $this->set('apiKey', $apiKey);
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

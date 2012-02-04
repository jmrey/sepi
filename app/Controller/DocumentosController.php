<?php

class DocumentosController extends AppController {
    public $helpers = array('Html', 'Form', 'Number', 'Crumb');
    public $components = array('Session','Email');
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
        if (parent::isAdmin($this->Auth->user())) {
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

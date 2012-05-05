<?php

class NotasController extends AppController {
    public $helpers = array('Html', 'Form', 'Time', 'Crumb');
    public $components = array('Session');
    public $name = 'Notas';
    
    public $status = array(0 => 'unread', 1 => 'read', 2 => 'hidden');
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador Notas
     */
    public function beforeFilter() {
        parent::beforeFilter();
        // Lista de acciones donde no es requirida la autenticación del User.
        //$this->Auth->allow('add', 'login', 'logout');
        $this->set('status', $this->status);
        $this->set('title_for_layout', 'Notas');
    }
    
    /*public function admin_index() {
        $this->redirect(array('controller' => 'notas', 'action' => 'list', 'admin' => 1));
    }*/
    
    /* Lista de Notas 
    public function admin_list() {
        $this->Nota->recursive = 0;
        $this->set('notas', $this->paginate());
    }*/
    
    public function index($type = 'all', $type_id = 'all') {
        $notas = array();
        $this->Nota->recursive = 0;
        if ($type === 'all' && $type_id === 'all') {
            $notas = $this->paginate('Nota', array('Nota.to_user_id' => $this->Auth->user('id')));
        } else if ($type != 'all' && $type_id === 'all') {
            $notas = $this->Nota->find('all', array(
                        'limit' => 10,
                        'conditions' => array(
                            'Nota.type' => $type,
                            'Nota.to_user_id' => $this->Auth->user('id'))
                    ));
        } else {
            $notas = $this->Nota->find('all', array(
                        'limit' => 10,
                        'conditions' => array(
                            'Nota.type' => $type,
                            'Nota.type_id' => $type_id,
                            'Nota.to_user_id' => $this->Auth->user('id'))
                    ));
        }
        $this->set('notas', $notas);
        $this->set('type_title', $type);
    }
    
    public function admin_index($type = 'all', $type_id = 'all') {
        
        $notas = array();
        $this->Nota->recursive = 0;
        if ($type === 'all' && $type_id === 'all') {
            $notas = $this->paginate();
        } else if ($type != 'all' && $type_id === 'all') {
            $notas = $this->Nota->find('all', array(
                        'limit' => 10,
                        'conditions' => array('Nota.type' => $type)
                    ));
        } else {
            $notas = $this->Nota->find('all', array(
                        'limit' => 10,
                        'conditions' => array('Nota.type' => $type, 'Nota.type_id' => $type_id)
                    ));
        }
        $this->set('notas', $notas);
        $this->set('type_title', $type);
        $this->render('index');
    }
    
    public function view($id = null) {
        
        $this->Nota->id = $id;
        if (!$this->Nota->exists()) {
            throw new NotFoundException('Invalid User');
        } else {
            $this->Nota->recursive = -1;
            $this->set('nota', $this->Nota->read(null, $id));
        }
    }
    
    public function admin_view($id = null) {
        $this->Nota->id = $id;
        if (!$this->Nota->exists()) {
            throw new NotFoundException('Invalid User');
        } else {
            $this->Nota->recursive = 0;
            $this->set('nota', $this->Nota->read(null, $id));
        }
        $this->render('profile');
    }
    
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->Nota->create();
            $this->request->data('Nota.user_id', $this->Auth->user('id'));
            if ($this->Nota->save($this->request->data)) {
                
                $this->set('message','Se ha agregado la nota satisfactoriamente.');
                $this->set('type','success');
                $this->render('/Elements/alert', false);
                //$this->response->body('Ya estuvo!');
            } else {
                $this->error('Ha habido un problema. Intente más tarde.');
            }
        }
    }
    
    public function admin_edit($id = null) {
        $this->Nota->id = $id;
        if (!$this->Nota->exists()) {
            throw new NotFoundException('Id. de Nota inválido.');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Nota->save($this->request->data)) {
                $this->info('Se han guardado la nota.');
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->error('No se han podido guardar la nota.');
            }
        } else {
            $this->request->data = $this->Nota->read(null, $id);
            //unset($this->request->data['User']['password']);
        }
    }
    
    public function delete($id = null) {
        $this->autoRender = false;
        if (!($this->request->is('post') || $this->request->is('delete'))) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The nota with id: ' . $id . ' has been deleted.');
        }
        $this->Nota->id = $id;
        if (!$this->Nota->exists()) {
            throw new NotFoundException('Id. de Nota Inválido.');
        }
        if ($this->Nota->delete()) {
            $this->info('The nota with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index', 'admin' => 1));
        } else {
            $this->error('Nota no se ha podido borrar.');
        }
    }
    
    public function change($id = null, $status = '') {
        $this->Nota->id = $id;
        if (!$this->Nota->exists()) {
            throw new NotFoundException('Beca no Existe');
        }
        if ($this->request->is('post')) {
            $this->Nota->read(null, $id);
            $this->Nota->set('status', array_search($status, $this->status));
            if ($this->Nota->save()) {
                //$this->Nota->create($nota);
                //$this->Nota->save();
                $this->success('Se han guardado los datos.');
                $this->redirect(array('controller'=> 'users', 'action' => 'dashboard'));
            } else {
                $this->error('No se han podido guardar los datos.');
            }
        }
    }
}
?>

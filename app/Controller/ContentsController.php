<?php

class ContentsController extends AppController {
    public $name = 'Contents';
    public $helpers = array('Html', 'Form');
    public $components = array('Session');
    
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display');
    }
    
    public function index() {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'index', 'admin' => 1));
        }
        $this->warning('No tienes los permisos suficientes para entrar a esta area.');
    }
    
    public function admin_index() {
        $this->set('contents', $this->Content->find('all'));
        $this->render('index');
    }
    
    public function display($field = 'type', $query = 'about') {
        $this->set('contents', $this->Content->find('all', array(
            'limit' => 6,
            'conditions' => array('Content.' . $field => $query)
        )));
        $this->set('title', $query);
    }
    
    public function view($id = null) {
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('No se ha encontrado lo que buscas.');
        } else {
            $this->set('content', $this->Content->read());
        }
    }
    
    public function add() {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'add', 'admin' => 1));
        }
        $this->warning('No tienes los permisos suficientes para entrar a esta area.');
    }
    
    public function admin_add() {
        $this->set('requireEditor',true);
        if ($this->request->is('post')) {
            $this->Content->create();
            //$this->request->data['Content']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Content']['user_id'] = $this->Auth->user('id');
            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash('Se ha guardado la content');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ha habido un problema. Intenta más tarde.');
            }
        }
        $this->render('add');
    }
    
    public function edit($id = null) {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'edit', 'admin' => 1, $id));
        }
        $this->warning('No tienes los permisos suficientes para entrar a esta area.');
    }
    
    public function admin_edit($id = null) {
        $this->set('requireEditor',true);
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('Contenido no existe.');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash('Se han guardado los datos.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('No se han podido guardar los datos.');
            }
        } else {
            $this->request->data = $this->Content->read(null, $id);
            unset($this->request->data['Content']['password']);
        }
        $this->render('edit');
    }
    
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The Content with id: ' . $id . ' has been deleted.');
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException('Usuario Invalido');
        }
        if ($this->Content->delete()) {
            $this->Session->setFlash('The Content with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Content no se ha podido borrar.');
        $this->redirect(array('action' => 'index'));
    }
    
    public function isAuthorized($user) {
        if (!parent::isAuthorized($user)) {
            if ($this->action === 'add') {
                return true;
            }
            if (in_array($this->action, array('edit', 'delete'))) {
                $becaId = $this->request->params['pass'][0];
                return $this->Beca->isOwnedBy($becaId, $user['id']);
            }
        }
        return true;
    }
}
?>

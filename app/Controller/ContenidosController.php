<?php

class ContenidosController extends AppController {
    public $name = 'Contenidos';
    public $helpers = array('Html', 'Form', 'Crumb');
    public $components = array('Session');
    
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display', 'announcements');
        $this->set('title_for_layout', 'Contenidos');
    }
    
    public function index() {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'index', 'admin' => 1));
        }
        $this->warning('No tienes los permisos suficientes para entrar a esta area.');
    }
    
    public function admin_index() {
        $this->set('contenidos', $this->Contenido->find('all'));
        $this->render('index');
    }
    
    public function display($field = 'type', $query = 'about') {
        $this->set('contenidos', $this->Contenido->find('all', array(
            'limit' => 6,
            'conditions' => array('Contenido.' . $field => $query)
        )));
        $this->set('title', $query);
        $this->layout = 'pages';
    }
    
    public function admin_view($id = null) {
        $this->Contenido->id = $id;
        if (!$this->Contenido->exists()) {
            throw new NotFoundException('No se ha encontrado lo que buscas.');
        } else {
            $this->set('contenido', $this->Contenido->read());
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
            $this->Contenido->create();
            //$this->request->data['Contenido']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Contenido']['user_id'] = $this->Auth->user('id');
            if ($this->Contenido->save($this->request->data)) {
                $this->success('Se ha guardado la contenido');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('Ha habido un problema. Intenta más tarde.');
            }
        }
        $this->render('add');
    }
    
    public function admin_add_convocatory() {
        $this->set('requireEditor',true);
        if ($this->request->is('post')) {
            $this->Contenido->create();
            //$this->request->data['Contenido']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Contenido']['user_id'] = $this->Auth->user('id');
            if ($this->Contenido->save($this->request->data)) {
                $this->success('Se ha guardado la convocatoria.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('Ha habido un problema. Intenta más tarde.');
            }
        }
        $this->render('add_convocatory');
    }
    
    public function edit($id = null) {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'edit', 'admin' => 1, $id));
        }
        $this->warning('No tienes los permisos suficientes para entrar a esta area.');
    }
    
    public function admin_edit($id = null) {
        $this->set('requireEditor',true);
        $this->Contenido->id = $id;
        if (!$this->Contenido->exists()) {
            throw new NotFoundException('Contenido no existe.');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Contenido->save($this->request->data)) {
                $this->success('Se han guardado los datos.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('No se han podido guardar los datos.');
            }
        } else {
            $this->request->data = $this->Contenido->read(null, $id);
            unset($this->request->data['Contenido']['password']);
        }
        $this->render('edit');
    }
    
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The Contenido with id: ' . $id . ' has been deleted.');
        }
        $this->Contenido->id = $id;
        if (!$this->Contenido->exists()) {
            throw new NotFoundException('Usuario Invalido');
        }
        if ($this->Contenido->delete()) {
            $this->info('The Contenido with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->error('Contenido no se ha podido borrar.');
        $this->redirect(array('action' => 'index'));
    }
    
    public function announcements() {
        $this->layout = 'pages';
        $this->set('convocatorias', $this->Contenido->find('all', array(
            'limit' => 10,
            'conditions' => array('Contenido.type' => 'convocatoria')
        )));
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

<?php

class BecasController extends AppController {
    public $name = 'Becas';
    public $helpers = array('Html', 'Form');
    public $components = array('Session');
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index() {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'index', 'admin' => 1));
        } else {
            $this->set('becas', $this->Beca->find('all', array(
                'conditions' => array('Beca.user_id' => $this->Auth->user('id'))
            )));
        }
    }
    
    public function admin_index() {
        $this->set('becas', $this->Beca->find('all'));
        $this->render('index');
    }
    
    public function view($id = null) {
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Invalid Beca');
        } else {
            $this->set('Beca', $this->Beca->read());
        }
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->Beca->create();
            //$this->request->data['Beca']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Beca']['user_id'] = $this->Auth->user('id');
            if ($this->Beca->save($this->request->data)) {
                $this->Session->setFlash('SE ha guardado la beca');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Ha habido un problema. Intenta más tarde.');
            }
        }
    }
    
    public function edit($id = null) {
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Usuario Inválido');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Beca->save($this->request->data)) {
                $this->Session->setFlash('Se han guardado los datos.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('No se han podido guardar los datos.');
            }
        } else {
            $this->request->data = $this->Beca->read(null, $id);
            unset($this->request->data['Beca']['password']);
        }
    }
    
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The Beca with id: ' . $id . ' has been deleted.');
        }
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Usuario Invalido');
        }
        if ($this->Beca->delete()) {
            $this->Session->setFlash('The Beca with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Beca no se ha podido borrar.');
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
        } return true;
    }
}
?>

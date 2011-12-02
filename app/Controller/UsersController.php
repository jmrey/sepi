<?php

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('Session');
    public $name = 'Users';
    
    public function index() {
        $this->set('users', $this->User->find('all'));
    }
    
    public function view($id = null) {
        $this->User->id = $id;
        $this->set('user', $this->User->read());
    }
    
    public function add() {
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit($id = null) {
        $this->User->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->User->read();
        } else {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Your user has been updated.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
        } else if ($this->request->is('post')) {
            if ($this->User->delete($id)) {
                $this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }
}
?>

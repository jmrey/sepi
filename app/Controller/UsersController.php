<?php

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    public $components = array('Session','Email');
    public $name = 'Users';
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'login', 'logout');
    }
    
    /*
     * Checa las credenciales del usuario.
     */
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login(/*$this->request->data*/)) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->error('Nombre de usuario o contraseña invalido.');
            }
        } else {
            if($this->Auth->user()) {
                $this->redirect($this->Auth->redirect());
            }
        }
    }
    
    public function admin_login() {
        $this->redirect(array('action' => 'login', 'admin' => 0));
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function index() {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'index', 'admin' => 1));
        }
        //$this->redirect(array('action' => 'dashboard', 'admin' => 0));
        $this->redirect('/dashboard');
    }
    
    public function admin_index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
     
        $this->render('index');
    }
    
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid User');
        } else {
            $this->set('user', $this->User->read(null, $id));
        }
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->success('Te has registrado satisfactoriamente.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('Ha habido un problema. Intenta más tarde.');
            }
        }
    }
    
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Usuario Inválido');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->info('Se han guardado los datos.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('No se han podido guardar los datos.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Usuario Invalido');
        }
        if ($this->User->delete()) {
            $this->info('The user with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->error('Usuario no se ha podido borrar.');
        $this->redirect(array('action' => 'index'));
    }
    
    public function dashboard() {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'dashboard', 'admin' => 1));
        }
        $this->set('text', 'NOADMIN');
    }
    
    public function admin_dashboard() {
        $this->set('user',$this->Auth->user());
        $this->set('text','ADMIN');
    }
    
    public function admin_send($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
        }
        
        $this->_sendContractEmail($this->User->id);
        
        $this->success('Se ha enviado el correo');
        $this->redirect(array('action' => 'index'));
    }
    
    function _sendContractEmail($id) {
        $this->Email->smtpOptions = array(
        'port'=>'465',
        'timeout'=>'30',
        'host'=>'ssl://smtp.gmail.com',
        'username'=>'yeah.mue@gmail.com',
        'password'=>'navar0ne'
        );
        $this->Email->delivery = 'smtp';
        $this->Email->to = "mue.navarone@gmail.com";
        $this->Email->subject = 'TEST';
        $this->Email->replyTo = 'mue.navarone@gmail.com';
        $this->Email->from = 'yeah.mue@gmail.com';
        $this->Email->template = 'email';
        $this->Email->sendAs = 'html';
        $this->set('name', $this->Auth->user('name'));
        //$this->Email->_debug = true;
        $this->Email->send();
        $this->redirect(array('controller'=>'users', 'action'=>'index'));
    }
}
?>

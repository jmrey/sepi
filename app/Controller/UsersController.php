<?php

class UsersController extends AppController {
    public $uses = array('User', 'Nota');
    public $helpers = array('Html', 'Form', 'Time', 'Crumb');
    public $components = array('Session','Email');
    public $name = 'Users';
    //$this->la
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador Users
     */
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->layout = 'main';
        // Lista de acciones donde no es requirida la autenticación del User.
        $this->Auth->allow('add', 'login', 'logout');
        $this->set('title_for_layout', 'Usuarios');
    }
    
    /*
     * Revisa las credenciales del user.
     */
    public function login() {
        $this->layout = 'pages';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->error('Nombre de Usuario o contraseña invalido.');
            }
        } else {
            if($this->Auth->user()) {
                $this->redirect($this->Auth->redirect());
            }
        }
    }
    
    public function admin_login(){
        $this->redirect('/login');
    }


    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function index() {
        $this->redirect('/dashboard');
    }
    
    /* Lista de Users */
    public function admin_index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
    
    public function view($id = null) {
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid User');
        } else {
            $this->User->recursive = -1;
            $this->set('user', $this->User->read(null, $id));
        }
    }
    
    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid User');
        } else {
            $this->User->recursive = 0;
            $this->set('user', $this->User->read(null, $id));
        }
        $this->render('view');
    }
    
    public function add() {
        $this->layout = 'pages';
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->success('Te has registrado satisfactoriamente.');
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->error('Ha habido un problema. Intenta más tarde.');
            }
        }
    }
    
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('User Inválido');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->info('Se han guardado los datos.');
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->error('No se han podido guardar los datos.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function admin_edit($id = null) {
        $this->edit($id);
    }
    
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('User Invalido');
        }
        if ($this->User->delete()) {
            $this->info('The user with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->error('User no se ha podido borrar.');
        $this->redirect(array('action' => 'index'));
    }
    
    public function dashboard() {
        if (parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'dashboard', 'admin' => 1));
        }
        $this->set('notas', $this->Nota->find('all', array(
            'limit' => '10',
            'conditions' => array('Nota.to_user_id' => $this->Auth->user('id'),
                'Nota.status' => 0)
        )));
        $this->set('user',$this->Auth->user());
        $this->set('text', 'NOADMIN');
    }
    
    public function admin_dashboard() {
        if (!parent::isAdmin($this->Auth->user())) {
            $this->redirect(array('action' => 'dashboard', 'admin' => 0));
        }
        $this->set('text','ADMIN');
    }
    
    public function admin_email($id = null) {
        $this->set('requireEditor',true);
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('User Inválido');
        } else {
            $this->set('user', $this->User->read(null, $id));
        }
    }
    
    public function admin_send() {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
        }
        pr($this->request->data);
        $this->_sendContractEmail($this->request->data);
        
        $this->success('Se ha enviado el correo');
        $this->redirect(array('action' => 'index'));
    }
    
    function _sendContractEmail($data) {
        $this->Email->smtpOptions = array(
        'port'=>'465',
        'timeout'=>'30',
        'host'=>'ssl://smtp.gmail.com',
        'username'=>'yeah.mue@gmail.com',
        'password'=>'navar0ne'
        );
        $this->Email->delivery = 'smtp';
        $this->Email->to = $data['to'];
        $this->Email->subject = $data['subject'];
        $this->Email->replyTo = 'mue.navarone@gmail.com';
        $this->Email->from = 'yeah.mue@gmail.com';
        $this->Email->template = 'email';
        $this->Email->sendAs = 'html';
        $this->set('message', $data['message']);
        //$this->Email->_debug = true;
        $this->Email->send();
        //$this->redirect(array('controller'=>'users', 'action'=>'index'));
    }
}
?>

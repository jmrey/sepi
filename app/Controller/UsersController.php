<?php

class UsersController extends AppController {
    public $uses = array('User', 'Nota');
    public $helpers = array('Html', 'Form', 'Time', 'Crumb');
    public $components = array('Session','Email');
    public $name = 'Users';
    //$this->la
    
    private $roles = array('admin' => 1, 'alumno' => 2, 'profesor' => 3, 'administrativo' => 4);
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador Users
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'default';
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
    /* Redirecciona al usuario a su dashboard. */
    public function index() {
        $this->redirect('/dashboard');
    }
    
    /* Lista a los usuarios. */
    public function admin_index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
    
    public function profile() {
        $id = $this->Auth->user('id');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid User');
        } else {
            $this->User->recursive = -1;
            $user = $this->User->read(null, $id);
            $this->set('user', $user);
            //debug($user);
        }
        //$this->render('profile');
    }
    
    public function view($id = null) {
        $this->redirect(array('action' => 'profile'));
    }
    
    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid User');
        } else {
            $this->User->recursive = -1;
            $user = $this->User->read(null, $id);
            $this->set('user', $user);
        }
        $this->render('profile');
    }
    
    public function add() {
        $this->layout = 'pages';
        if ($this->request->is('post')) {
            $this->User->create();
            //$this->request->data['User']['role'] = $this->roles[$this->request->data['User']['role']]; 
            if ($this->User->save($this->request->data)) {
                $this->success('Te has registrado satisfactoriamente.');
            } else {
                $this->error('Ha ocurrido un problema. Verica tus datos.');
            }
        }
    }
    
   
    public function edit() {
        //  El Usuario sólo puede editar su propio perfil, por eso se pasa su propio id.
        $id = $this->Auth->user('id');
        $this->User->id = $id;
        
        if (!$this->User->exists()) {
            throw new NotFoundException('Usuario no existe.');
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            // Se sobreescrube el id por el id correcto (sólo por seguridad).
            $this->request->data['User']['id'] = $id;
            
            /* El usuario solo puede actualizar sólo los siguientes campos. */
            $fieldList = array('id', 'email', 'rfc', 'curp', 'fullname');
            $this->_saveUser($this->request->data, $fieldList);
        } else {
            $user = $this->User->read(null, $id);
            $this->request->data = $user;
            unset($this->request->data['User']['password']);
            unset($this->request->data['User']['id']);
        }
    }
    
    public function admin_edit($id = null) {
        $this->User->id = $id;
        
        if (!$this->User->exists()) {
            throw new NotFoundException('Usuario no existe.');
        }
        
        $this->User->recursive = -1;
        $user = $this->User->read(null, $id);
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $fieldList = array();
            
            /* Si es el usuario que se edita es administrador. */
            if (parent::isAdmin($user['User'])) {
                $this->request->data['User']['role'] = 'admin';
            }
            
            $fieldList = $this->User->blacklist(array('password'));
            $this->_saveUser($this->request->data, $fieldList);
        } else {
            $this->request->data = $user;
            unset($this->request->data['User']['password']);
        }
    }
    
    public function admin_delete($id = null) {
        $this->autoRender = false;
        
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Usuario no existe.');
        }
        if ($this->User->delete()) {
            $this->info('El usuario con el id: ' . $id . ' ha sido borrado.');
        } else {
            $this->error('El usuario con el id: ' . $id . ' no se ha podido borrar.');
        }
        
        $this->redirect(array('action' => 'index'));
    }
    
    public function dashboard() {
        if (parent::isAdmin()) {
            $this->redirect(array('action' => 'dashboard', 'admin' => 1));
        }
        
        $this->set('notas', $this->Nota->find('all', array(
            'limit' => '10',
            'conditions' => array('Nota.to_user_id' => $this->Auth->user('id'),
                'Nota.status' => '0')
        )));
    }
    
    public function admin_dashboard() {
        if (!parent::isAdmin()) {
            $this->redirect(array('action' => 'dashboard', 'admin' => 0));
        }
    }
    
    public function admin_email($id = null) {
        $this->set('requireEditor',true);
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('User Inválido');
        } else {
            $this->User->recursive = -1;
            $this->set('user', $this->User->read(null, $id));
        }
    }
    
    public function admin_send() {
        $this->autoRender = false;
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
            //$this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
        }
        //pr($this->request->data);
        $this->_sendEmail($this->request->data);
        
        $this->success('Se ha enviado el correo');
        $this->redirect(array('action' => 'index'));
    }
    
    function _sendEmail($data) {
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
    
    function _saveUser($data = array(), $fieldList = array()) {
        //debug($data);
        if ($this->User->save($data, true, $fieldList)) {
            $this->info('Se han actualizado los datos satisfactoriamente.');
        } else {
            $this->error('No se han podido actualizar tus datos.');
        }
    }
}
?>

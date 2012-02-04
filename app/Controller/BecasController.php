<?php

class BecasController extends AppController {
    public $uses = array('Beca', 'Nota');
    public $name = 'Becas';
    public $helpers = array('Html', 'Form', 'Crumb');
    public $components = array('Session');
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador
     */
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->layout = 'main';
        $this->set('title_for_layout', 'Becas');
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
            $this->set('beca', $this->Beca->read());
        }
    }
    
    public function admin_view($id = null) {
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Invalid Beca');
        } else {
            $this->set('Beca', $this->Beca->read());
        }
        $this->render('view');
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->Beca->create();
            //$this->request->data['Beca']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Beca']['user_id'] = $this->Auth->user('id');
            if ($this->Beca->save($this->request->data)) {
                $this->success('SE ha guardado la beca Fecha: ' . $this->request->data['Beca']['begin_date'] . '---'. $this->request->data['Beca']['end_date']);
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
            $this->success('The Beca with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->error('Beca no se ha podido borrar.');
        $this->redirect(array('action' => 'index'));
    }
    
    public function change($id = null, $status = '') {
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Beca no Existe');
        }
        if ($this->request->is('post')) {
            $this->Beca->read(null, $id);
            $this->Beca->set('status', $status);
            if ($this->Beca->save()) {
                $nota = array('Nota' => array(
                    'user_id' => $this->Auth->user('id'),
                    'to_user_id' => $this->Beca->field('user_id'),
                    'type' => 'beca',
                    'type_id' => $this->Beca->field('id'),
                    'text' => 'Tu beca ha sido aprobada.',
                    'status' => 0
                ));
                $this->Nota->create($nota);
                $this->Nota->save();
                $this->success('Se han guardado los datos.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('No se han podido guardar los datos.');
            }
        }
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

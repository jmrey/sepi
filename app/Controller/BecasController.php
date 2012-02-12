<?php

class BecasController extends AppController {
    public $uses = array('Beca', 'Nota');
    public $name = 'Becas';
    public $helpers = array('Html', 'Form', 'Time', 'Crumb');
    public $components = array('Session');
    
    //private $status = array('apro');
    
    /*
     * Esta función se ejectuta antes de cada acción del Controlador
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('title_for_layout', 'Becas');
    }
    
    public function index() {
        if (parent::isAdmin()) {
            $this->redirect(array('action' => 'index', 'admin' => 1));
        } else {
            $this->Beca->recursive = -1;
            $conditions = array('Beca.user_id' => $this->Auth->user('id'));
            $becas = $this->Beca->find('all', array(
               'conditions' => $conditions 
            ));
            
            $this->set('becas', $becas);
        }
    }
    
    public function admin_index() {
        $this->Beca->recursive = 0;
        $becas = $this->Beca->find('all');
        $this->set('becas', $becas);
        
        $this->render('index');
    }
    
    public function view($id = null) {
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Beca que buscas no existe.');
        } else {
            $this->Beca->recursive = -1;
            $beca = $this->Beca->read(null, $id);
            $this->set('beca', $beca);
        }
    }
    
    public function admin_view($id = null) {
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Beca con id: ' . $id . ' no existe.');
        } else {
            $this->Beca->recursive = 0;
            $beca = $this->Beca->read(null, $id);
            $this->set('beca', $beca);
        }
        
        $this->render('view');
    }
    
    public function add() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Beca->create();
            $this->request->data['Beca']['user_id'] = $this->Auth->user('id');
            if ($this->Beca->save($this->request->data)) {
                $this->success('Se ha guardado la beca satisfactoriamente.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('Ha ocurrido un problema. Intenta más tarde.');
            }
        }
    }
    
    public function edit($id = null) {
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Beca no existe.');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Beca->save($this->request->data)) {
                $this->success('Se han actualizado los datos.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->error('No se han podido guardar los datos.');
            }
        } else {
            $this->Beca->recursive = -1;
            $this->request->data = $this->Beca->read(null, $id);
        }
    }
    
    public function delete($id = null) {
        $this->autoRender = false;
        
        if (!($this->request->is('post') || $this->request->is('delete'))) {
            throw new MethodNotAllowedException();
        }
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Beca no existe o ya ha sido borrada.');
        }
        
        $isOwnedBy = $this->Beca->isOwnedBy($id, $this->Auth->user('id'));
        if ($isOwnedBy || parent::isAdmin()) {
            if ($this->Beca->delete()) {
                $this->success('La beca ha sido borrada.');
            } else {
                $this->error('Beca no se ha podido borrar.');
            }
        } else {
            $this->error('No tienes los permisos para está acción.');
        }
        $this->redirect(array('action' => 'index'));
    }
    
    public function admin_change($id = null, $status = '') {
        $this->autoRender = false;
        
        $this->Beca->id = $id;
        if (!$this->Beca->exists()) {
            throw new NotFoundException('Beca no Existe');
        }
        if ($this->request->is('post')) {
            $this->Beca->recursive = -1;
            
            $beca = $this->Beca->read(null, $id);
            //debug($beca); die;
            if (!$beca['Beca']['status'] && $this->Beca->saveField('status', 1)) {
                $nota = array('Nota' => array(
                    'user_id' => $this->Auth->user('id'),
                    'to_user_id' => $beca['Beca']['user_id'],
                    'type' => 'beca',
                    'type_id' => $beca['Beca']['id'],
                    'text' => 'Tu beca ha sido aprobada.',
                    'status' => 0
                ));
                $this->Nota->create($nota);
                $this->Nota->save();
                $this->success('Se ha aprobado la beca.');
            } else {
                $this->error('No se ha podido cambiar el estado de la beca.');
            }
            //debug($this->Beca->validationErrors); die;
        }
        $this->redirect(array('action' => 'index'));
    }
    
    public function isAuthorized($user = null) {
        if (!parent::isAuthorized($user)) {
            if ($this->action === 'add') {
                return true;
            }
            if (in_array($this->action, array('edit', 'delete'))) {
                $becaId = $this->request->params['pass'][0];
                debug($becaId);
                return $this->Beca->isOwnedBy($becaId, $user['id']);
            }
        } return true;
    }
}
?>

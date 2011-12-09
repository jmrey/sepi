<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    public $name = 'User';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nombre de usuario es requerido'
            )
        ),
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nombre de usuario es requerido'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Contraseña es requerida'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('profesor', 'alumno', 'administrativo')),
                'message' => 'Por ingresa un rol valido',
                'allowEmpty' => false
            )
        )
    );
    
    
    public function beforeSave() {
        if(isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}
?>

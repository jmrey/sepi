<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    public $name = 'User';
    public $useTable = 'usuarios';
    var $hasMany = array (
      'Documento' => array (
            'className' => 'Documento',
            'foreignKey' => 'user_id'
         )
    );
    
    
    public $validate = array(
        'username' => array(
            'validateUserame' => array(
                'rule' => array('alphaNumeric'),
                'required' => true,
                'message' => 'Nombre usuario debe contener letras y números.'
            ),
            'uniqueUsername' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre de usuario no está disponible.'
            ),
            'between' => array(
                'rule' => array('between', 3, 15),
                'message' => 'Entre 3 y 15 caracteres.'
            )
        ),
        'fullname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'require' => true,
                'message' => 'Nombre Completo es requerido.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('minLength', 6),
                'allowEmpty' => false,
                'required' => true,
                'message' => 'La contraseña debe contener 6 caracteres como mínimo.'
            )
        ),
        'email' => array(
            'validateEmail' => array(
                'rule' => 'email',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Por favor ingresa un email válido.'
            ),
            'uniqueEmail' => array(
                'rule' => 'isUnique',
                'message' => 'Ya ha sido registrado esta cuenta de correo.'
            )
        ),
        'role' => array(
            'allowedRole' => array(
                'rule' => array('inList', array('admin', 'alumno', 'profesor', 'administrativo')),
                'message' => 'Por favor selecciona un rol válido.',
                'allowEmpty' => false,
                'required' => true
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

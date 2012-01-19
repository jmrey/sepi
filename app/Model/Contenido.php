<?php
class Contenido extends AppModel {
    public $name = 'Contenido';
    
    /*public $validate = array(
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
        'type' => array(
            'valid' => array(
                'rule' => array('inList', array('pifi', 'cotepabe', 'cofaa','sibe')),
                'message' => 'Por ingresa un tipo de contenido valido',
                'allowEmpty' => false
            )
        )
    );
    */
    public function isOwnedBy($contenido, $user) {
        return $this->field($id, array('id' => $contenido, 'user_id' => $user)) === $contenido;
    }
}
?>

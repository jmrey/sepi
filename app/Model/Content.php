<?php
class Content extends AppModel {
    public $name = 'Content';
    
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
                'message' => 'Por ingresa un tipo de content valido',
                'allowEmpty' => false
            )
        )
    );
    */
    public function isOwnedBy($content, $user) {
        return $this->field($id, array('id' => $content, 'user_id' => $user)) === $content;
    }
}
?>

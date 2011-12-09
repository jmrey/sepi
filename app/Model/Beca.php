<?php
class Beca extends AppModel {
    public $name = 'Beca';
    
    public $validate = array(
        /*'username' => array(
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
        ),*/
        'type' => array(
            'valid' => array(
                'rule' => array('inList', array('pifi', 'cotepabe', 'cofaa','sibe')),
                'message' => 'Por ingresa un tipo de beca valido',
                'allowEmpty' => false
            )
        )
    );
    
    public function isOwnedBy($beca, $user) {
        return $this->field($id, array('id' => $beca, 'user_id' => $user)) === $beca;
    }
}
?>

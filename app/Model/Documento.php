<?php
class Documento extends AppModel {
    public $name = 'Documento';
    public $belongsTo = 'User';
    
    public $validate = array(
        'description' => array(
            'between' => array(
                'rule' => array('maxLength', 1000),
                'message' => 'El tamaño de descripción ha superado el límite.'
            )
        ),
        'name' => array(
            'validateName' => array(
                'rule' => array('alphaNumericDashUnderscore'),
                'required' => true,
                'message' => 'Nombre de documento sólo debe contener letras minúsculas, números y guiones.'
            ),
            'uniqueName' => array(
                'rule' => 'isUnique',
                'message' => 'El nombre de documento ya está en uso.'
            ),
            'between' => array(
                'rule' => array('between', 3, 50),
                'message' => 'Entre 3 y 50 caracteres.'
            )
        )
    );
    
    function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[0-9a-z._-]*$|', $value);
    }
    
    public function isOwnedBy($documento, $user) {
        return $this->field($id, array('id' => $documento, 'user_id' => $user)) === $documento;
    }
}
?>

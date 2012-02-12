<?php
class Beca extends AppModel {
    public $name = 'Beca';
    public $belongsTo = 'User';
    
    public $validate = array(
        'type' => array(
            'allowedType' => array(
                'rule' => array('inList', array('pifi', 'cotepabe', 'cofaa','sibe')),
                'message' => 'Por ingresa un tipo de beca válido.',
                'allowEmpty' => false,
                'required' => true
            )
        ),
        'begin_date' => array(
            'beginDate' => array(
                'rule' => array('date', 'ymd'),
                'message' => 'Ingresa una fecha válida en el formato 2012-12-31.'
            )
        ),
        'name' => array(
            'endDate' => array(
                'rule' => array('date', 'ymd'),
                'message' => 'Ingresa una fecha válida en el formato 2012-12-31.'
            )
        )
    );
    
    /*public function isOwnedBy($becaId, $userId) {
        return $this->field('id', array('id' => $becaId, 'user_id' => $userId)) === $becaId;
    }*/
}
?>

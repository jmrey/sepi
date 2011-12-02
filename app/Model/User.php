<?php
class User extends AppModel {
    public $name = 'User';
    
    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        )
    );
}
?>

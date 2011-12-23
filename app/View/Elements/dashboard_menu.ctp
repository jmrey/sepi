<?php 
    echo $this->element('menu', array(
        'menu' => array(
            'Inicio' => array('url' => array('controller' => 'users', 'action' => 'dashboard'), 'matches' => array('/dashboard')),
            'Usuarios' => '/admin/users',
            'Becas' => array('url' => array('controller' => 'becas', 'action' => 'index'), 'matches' => array('/becas')),
            'Documentos' => array('url' => array('controller' => 'becas', 'action' => 'index'), 'matches' => array('/documentos')),
            'Programas' => array('url' => array('controller' => 'becas', 'action' => 'index'), 'matches' => array('/programas')),
        ),
        'class' => 'tabs'
    ));
?>
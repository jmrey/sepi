<?php 
    echo $this->element('menu', array(
        'menu' => array(
            'Inicio' => array('url' => array('controller' => 'users', 'action' => 'dashboard'), 'matches' => array('/dashboard')),
            'Usuarios' => array('url' => array('controller' => 'users', 'action' => 'list', 'admin'=> $isAdmin), 'matches' => array('/users/list'), 'visibleTo' => 'admin'),
            //'Users' => array('url' => '/admin/users', 'matches' => array('/admin/users', '/admin/users/view/')),
            'Becas' => array('url' => array('controller' => 'becas', 'action' => 'index'), 'matches' => array('/becas')),
            'Documentos' => array('url' => array('controller' => 'documentos', 'action' => 'index'), 'matches' => array('/documentos')),
            'Contenidos' => array('url' => array('controller' => 'contenidos', 'action' => 'index'), 'matches' => array('/contenidos'), 'visibleTo' => 'admin'),
            'Notas' => array('url' => array('controller' => 'notas', 'action' => 'index'), 'matches' => array('/notas'), 'visibleTo' => 'admin'),
        ),
        'class' => 'tabs'
    ));
?>
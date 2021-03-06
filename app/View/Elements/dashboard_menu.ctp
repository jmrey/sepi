<?php 
    echo $this->element('menu', array(
        'menu' => array(
            'Inicio' => array('url' => '/dashboard', 'matches' => array('/dashboard', '/admin/dashboard')),
            'Usuarios' => array('url' => array('controller' => 'users', 'action' => 'index', 'admin'=> $isAdmin), 'matches' => array('/users'), 'visibleTo' => 'admin'),
            //'Users' => array('url' => '/admin/users', 'matches' => array('/admin/users', '/admin/users/view/')),
            'Becas' => array('url' => array('controller' => 'becas', 'action' => 'index', 'admin'=> $isAdmin), 'matches' => array('/becas')),
            'Documentos' => array('url' => array('controller' => 'documentos', 'action' => 'index', 'admin'=> $isAdmin), 'matches' => array('/documentos')),
            'Contenidos' => array('url' => array('controller' => 'contenidos', 'action' => 'index', 'admin'=> $isAdmin), 'matches' => array('/contenidos'), 'visibleTo' => 'admin'),
            'Notas' => array('url' => array('controller' => 'notas', 'action' => 'index', 'admin'=> $isAdmin), 'matches' => array('/notas')),
        ),
        'class' => 'nav-tabs'
    ));
?>
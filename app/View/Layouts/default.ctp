<?php
$sepiDescription = __d('sepi_desc', 'Sección de Estudios de Posgrado e Investigación');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>
        <?php echo $sepiDescription ?>: <?php echo $title_for_layout; ?>
    </title>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('bootstrap', 'main'));
        echo $scripts_for_layout;
    ?>
</head>
<body>
    <div class="topbar">
        <div class="topbar-inner">
            <div class="container-fluid max-width">
                <?php echo $this->Html->link('SEPI', array('controller' => 'pages', 'action' => 'display', 'welcome', 'admin' => 0), array('class' => 'brand')); ?>
                <?php 
                    echo $this->element('menu', array(
                        'menu' => array(
                            'Inicio' => '/',
                            'Dashboard' => array('url' => '/dashboard', 'matches' => array('/dashboard', '/admin'), 'visibleTo' => 'auth'),
                            'Acerca' => '/acerca',
                            'Contacto' => '/contacto'                            
                        ),
                        'class' => 'nav'
                    ));
                    
                    echo $this->element('menu', array(
                        'menu' => array(
                            'Registrar' => array('url' => '/signup', 'visibleTo' => 'guests'),
                            'Iniciar Sesión' => array('url' => '/login', 'visibleTo' => 'guests'),
                            $authUser['name'] => array('url' => '/dashboard', 'visibleTo' => 'auth'),
                            'Cerrar Sesión' => array('url' => '/logout', 'visibleTo' => 'auth')
                        ),
                        'class' => 'nav right'
                    ));
                ?>
            </div>
        </div>
    </div>
    <div class="container-fluid max-width">
        <div class="sidebar">
            <div class="well">
                <?php if ($isAdmin) { ?>
                    <h5>
                        <?php echo $this->Html->link('Usuarios',
                                array('controller' => 'users', 'action' => 'list')); ?>
                    </h5>
                    <ul>
                        <li><a href="#">Link</a></li>
                    </ul>
                    <h5>
                        <?php echo $this->Html->link('Contenidos',
                                array('controller' => 'contents', 'action' => 'index')); ?>
                    </h5>
                    <ul>
                        <li><a href="#">Link</a></li>
                    </ul>
                <?php } ?>
                <h5>
                    <?php echo ($authUser) ? $this->Html->link('Becas',
                            array('controller' => 'becas', 'action' => 'index',
                                'admin' => $isAdmin)) : 'Becas'; ?>
                </h5>
                <ul>
                    <li><a href="#">Informaci&oacuten</a></li>
                </ul>
                <h5><?php echo $this->Html->link('Convocatorias', '/convocatorias'); ?></h5>
            </div>
        </div>
        <div class="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_layout ?>
            <hr />
        </div>
        <footer>
            <?php echo $this->element('sql_dump_alert'); ?>
            <?php echo $this->element('footer'); ?>
        </footer>
    </div>
    <?php
        $scripts_array = array('jquery-1.7.1', 'bootstrap-alerts', 'bootstrap-tabs');
        if (isset($requireEditor) && $requireEditor == true) {
            echo $this->Html->scriptBlock('var useCKeditor = true;');
            array_push($scripts_array, 'ckeditor/ckeditor','ckeditor/adapters/jquery');
        }
        array_push($scripts_array,'sepi');
        
        echo $this->Html->script($scripts_array);
    ?>
</body>
</html>
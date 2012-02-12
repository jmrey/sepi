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
        echo $this->Html->css(array('bootstrap', 'main', 'flick/jquery-ui-1.8.17.custom'));
        echo $scripts_for_layout;
    ?>
</head>
<body>
    
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <?php echo $this->Html->link('SEPI', array('controller' => 'pages', 'action' => 'display', 'welcome', 'admin' => 0), array('class' => 'brand')); ?>
                <?php 
                    echo $this->element('menu', array(
                        'menu' => array(
                            'Inicio' => '/',
                            'Dashboard' => array('url' => '/dashboard', 'matches' => array('/dashboard', '/admin', '/becas', '/documentos', '/notas'), 'visibleTo' => 'auth'),
                            'Acerca' => '/acerca',
                            'Contacto' => '/contacto'                            
                        ),
                        'class' => ''
                    ));
                    
                    echo $this->element('menu', array(
                        'menu' => array(
                            'Registrar' => array('url' => '/signup', 'visibleTo' => 'guests'),
                            'Iniciar Sesión' => array('url' => '/login', 'visibleTo' => 'guests'),
                            $authUser['username'] => array('url' => '/dashboard', 'visibleTo' => 'auth'),
                            'Cerrar Sesión' => array('url' => '/logout', 'visibleTo' => 'auth')
                        ),
                        'class' => 'right'
                    ));
                ?>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <?php echo $this->element('sidebar'); ?>
                </div>
            </div>
            <div class="span10">
                <?php echo $this->Session->flash(); ?>
                <div id="dashboard" class="content">
                    <header>
                        <?php echo $this->element('dashboard_menu'); ?>
                        <div class="breadcrumb">
                            <?php echo $this->element('subnav'); ?>
                        </div>
                    </header>
                    <?php echo $content_for_layout ?>
                </div>
                <hr />
            </div>
        </div>
    </div>
    <footer>
            <?php echo $this->element('sql_dump_alert'); ?>
            <?php echo $this->element('footer'); ?>
        </footer>
    <?php
        $scripts_array = array('jquery-1.7.1', 'bootstrap-alerts', 'bootstrap-tabs', 'jquery-ui-1.8.17.custom.min', 'jquery.ui.datepicker-es');
        if (isset($requireEditor) && $requireEditor == true) {
            echo $this->Html->scriptBlock('var useCKeditor = true;');
            array_push($scripts_array, 'ckeditor/ckeditor','ckeditor/adapters/jquery');
        }
        array_push($scripts_array,'sepi');
        
        echo $this->Html->script($scripts_array);
    ?>
</body>
</html>
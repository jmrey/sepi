<?php
$sepiDescription = __d('sepi_desc', 'Sección de Estudios de Posgrado e Investigación');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>
        <?php echo $sepiDescription ?>:
        <?php echo $title_for_layout; ?>
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
            <div class="container-fluid">
                <?php echo $this->Html->link('SEPI', array('controller' => 'pages', 'action' => 'display', 'welcome'), array('class' => 'brand')); ?>
                <ul class="nav">
                    <li <?php echo ($this->here === '/') ? 'class="active"' : ''; ?>>
                        <?php echo $this->Html->link('Inicio', array('controller' => 'pages', 'action' => 'display', 'welcome', 'admin' => 0), array()); ?>
                    </li>
                    <?php if($authUser) { ?>
                    <li <?php echo (strpos($this->here,'/dashboard')) ? 'class="active"' : ''; ?>>
                        <?php echo $this->Html->link('Dashboard', '/dashboard', array()); ?>
                    </li>
                    <?php } ?>
                    <li <?php echo ($this->here === '/about') ? 'class="active"' : ''; ?>>
                        <?php echo $this->Html->link('Acerca', '/about', array()); ?>
                    </li>
                    <li <?php echo ($this->here === '/contact') ? 'class="active"' : ''; ?>>
                        <?php echo $this->Html->link('Contacto', '/contact', array()); ?>
                    </li>
                </ul>
                <p class="pull-right u_actions">
                    <?php
                        if (!$authUser) {
                            echo $this->Html->link('Registrar', '/signup');
                            echo $this->Html->link('Iniciar Sesión', '/login');
                        } else {
                            echo $this->Html->link($authUser['name'], '/dashboard');
                            echo $this->Html->link('Cerrar Sesión', '/logout'); 
                        }
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="sidebar">
            <div class="well">
                <h5><?php echo $this->Html->link('Usuarios', array('controller' => 'users', 'action' => 'index'), array()); ?></h5>
                <ul>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
                <h5><?php echo $this->Html->link('Becas', array('controller' => 'becas', 'action' => 'index'), array()); ?></h5>
                <ul>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
                <h5><?php echo $this->Html->link('Contents', array('controller' => 'contents', 'action' => 'index'), array()); ?></h5>
            </div>
        </div>
        <div class="content">
            <?php
                echo $this->Session->flash(null, array(
                    'params' => array('type' => 'success'),
                    'element' => 'alert'
                ));
            ?>
            <?php
                if (isset($smtperrors)) {
                    pr($smtperrors);
                    
                } 
             ?>
            <?php echo $content_for_layout ?>
            <hr>
            <footer>
                <?php echo $this->element('footer'); ?>
            </footer>
        </div>
    </div>
    <?php
        $scripts_array = array('jquery-1.7.1', 'bootstrap-alerts', 'bootstrap-tabs');
        if (isset($requireEditor) && $requireEditor == true) {
            array_push($scripts_array, 'ckeditor/ckeditor','ckeditor/adapters/jquery');
        }
        array_push($scripts_array,'sepi');
        
        echo $this->Html->script($scripts_array);
    ?>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>
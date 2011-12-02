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
                    <li class="active">
                        <?php echo $this->Html->link('Inicio', array('controller' => 'pages', 'action' => 'display', 'welcome'), array()); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Acerca', array('controller' => 'pages', 'action' => 'display', 'about'), array()); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Contacto', array('controller' => 'pages', 'action' => 'display', 'contact'), array()); ?>
                    </li>
                </ul>
                <p class="pull-right"><a href="#">Iniciar Sesi&oacute;n</a></p>
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
                <h5>Sidebar</h5>
                <ul>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <?php echo $content_for_layout ?>
            <hr>
            <footer>
                <?php echo $this->element('footer'); ?>
            </footer>
        </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>
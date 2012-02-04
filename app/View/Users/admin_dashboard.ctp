<div class="users content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
    ?>
    <?php echo $this->Html->link('Agregar Convocatoria', array('controller' => 'contenidos', 'action' => 'add_convocatory', 'admin' => 1),
                array('class' => 'btn btn-large btn-primary')); ?>
    <?php echo $this->Html->link('Agregar Contenido', array('controller' => 'contenidos', 'action' => 'add'),
                array('class' => 'btn btn-large btn-primary')); ?>
    <a class="btn btn-primary btn-large">Agregar Contenido</a>
</div>

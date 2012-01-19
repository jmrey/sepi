<?php echo $this->Session->flash(); ?>
<div class="dashboard">
    <h1>Dashboard</h1>
    <?php echo $this->element('dashboard_menu'); ?>
    <div class="pill-content">
        <?php echo $this->Html->link('Agregar Convocatoria', array('controller' => 'contenidos', 'action' => 'add_convocatory', 'admin' => 1),
                    array('class' => 'btn large primary')); ?>
        <?php echo $this->Html->link('Agregar Contenido', array('controller' => 'contenidos', 'action' => 'add'),
                    array('class' => 'btn large primary')); ?>
        <a class="btn primary large">Agregar Contenido</a>
    </div>
</div>
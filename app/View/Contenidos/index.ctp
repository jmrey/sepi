<?php echo $this->Session->flash(); ?>
<div class="dashboard">
<h1>Contenidos</h1>
<?php echo $this->element('dashboard_menu'); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Titulo</th>
        <th>Nombre</th>
        <th>Contenido</th>
        <th>Creado</th>
        <th>Modificado</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($contenidos as $c): ?>
    <?php  $contenido = $c['Contenido']?>
    <tr>
        <td><?php echo $contenido['id']; ?></td>
        <td>
            <?php echo $this->Html->link($contenido['user_id'],
                array('controller' => 'users', 'action' => 'view', $contenido['user_id'])); ?>
        </td>
        <td><?php echo $this->Html->link($contenido['type'],
                array('controller' => 'contenidos', 'action' => 'display','admin' => 0, 'type', $contenido['type'])); ?>
        </td>
        <td><?php echo $contenido['title']; ?></td>
        <td><?php echo $this->Html->link($contenido['name'],
                array('controller' => 'contenidos', 'action' => 'view', $contenido['id'])); ?></td>
        <td><?php echo $contenido['content']; ?></td>
        <td><?php echo $contenido['created']; ?></td>
        <td><?php echo $contenido['modified']; ?></td>
        <td>
            <?php 
                echo $this->Html->link('Editar', array('action' => 'edit', $contenido['id']));
                echo ' ';
                echo $this->Form->postLink('Borrar',
                    array('action' => 'delete', $contenido['id']),
                    array('confirm' => '¿Está seguro?', 'class' => 'danger'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="actions">
    <?php echo $this->Html->link('Agregar contenido', array('controller' => 'contenidos', 'action' => 'add', 'admin' => 1),
            array('class' => 'btn primary')); ?>
</div>
</div>
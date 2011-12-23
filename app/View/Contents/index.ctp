<?php if ($authUser['role'] != 'admin') {
    echo $this->Session->flash();
 } else { 
?>
<h1>Contents</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Titulo</th>
        <th>Nombre</th>
        <th>Content</th>
        <th>Creado</th>
        <th>Modificado</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($contents as $c): ?>
    <?php  $content = $c['Content']?>
    <tr>
        <td><?php echo $content['id']; ?></td>
        <td>
            <?php echo $this->Html->link($content['user_id'],
                array('controller' => 'users', 'action' => 'view', $content['user_id'])); ?>
        </td>
        <td><?php echo $this->Html->link($content['type'],
                array('controller' => 'contents', 'action' => 'display','admin' => 0, 'type', $content['type'])); ?>
        </td>
        <td><?php echo $content['title']; ?></td>
        <td><?php echo $this->Html->link($content['name'],
                array('controller' => 'contents', 'action' => 'view', $content['id'])); ?></td>
        <td><?php echo $content['content']; ?></td>
        <td><?php echo $content['created']; ?></td>
        <td><?php echo $content['modified']; ?></td>
        <td>
            <?php 
                echo $this->Html->link('Editar', array('action' => 'edit', $content['id']));
                echo ' ';
                echo $this->Form->postLink('Borrar',
                    array('action' => 'delete', $content['id']),
                    array('confirm' => '¿Está seguro?', 'class' => 'danger'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php 
    echo $this->Html->link('Agregar Content', array('controller' => 'contents', 'action' => 'add', 'admin' => 1)); 
}
?>
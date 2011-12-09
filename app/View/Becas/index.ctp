<h1>Becas</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Empieza</th>
        <th>Termina</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($becas as $b): ?>
    <?php  $beca = $b['Beca']?>
    <tr>
        <td><?php echo $beca['id']; ?></td>
        <td>
            <?php echo $this->Html->link($beca['user_id'],
                array('controller' => 'users', 'action' => 'view', $beca['user_id'])); ?>
        </td>
        <td><?php echo $beca['type']; ?></td>
        <td><?php echo $beca['begin_date']; ?></td>
        <td><?php echo $beca['end_date']; ?></td>
        <td>
            <?php echo $this->Form->postLink('Delete',
                array('action' => 'delete', 'admin' => 0, $beca['id']),
                array('confirm' => '¿Está seguro?'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Html->link('Agregar Beca', array('controller' => 'becas', 'action' => 'add')); ?>
<?php
    echo $this->Session->flash();
?>

<h1>Usuarios</h1>
<?php echo $this->element('dashboard_menu'); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Alias</th>
        <th>Email</th>
        <th>Permisos</th>
        <th>CURP</th>
        <th>Acciones</th>
        <th>Registrado</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $u): ?>
    <?php  $user = $u['User']?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['name']; ?></td>
        <td>
            <?php echo $this->Html->link($user['username'],
                array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
        </td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo ucwords($user['role']); ?></td>
        <td><?php echo $user['curp']; ?></td>
        <td>
            <?php echo $this->Html->link('Enviar correo',
                array('action' => 'email', $user['id']),
                array('class' => 'success'));
            ?>
            <?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'edit', $user['id']));?>
            <?php echo $this->Form->postLink('Borrar',
                array('action' => 'delete', $user['id']),
                array('confirm' => '¿Estás seguro?', 'class' => 'danger'));
            ?>
        </td>
        <td><?php echo $user['created']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
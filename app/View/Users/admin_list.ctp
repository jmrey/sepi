<?php echo $this->Session->flash(); ?>
<div class="dashboard">
    <h1>Usuarios</h1>
    <?php echo $this->element('dashboard_menu'); ?>
    <table class="users">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Alias</th>
            <th>Email</th>
            <th>Rol</th>
            <th>CURP</th>
            <th>RFC</th>
            <th>Registrado</th>
            <th>Acciones</th>
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
            <td>
                <?php echo $user['email']; ?>
                <?php echo $this->Html->link('Enviar correo', array('action' => 'email', $user['id']), array('class' => 'success')); ?>
            </td>
            <td><?php echo ucwords($user['role']); ?></td>
            <td><?php echo ($user['curp'] == NULL)?'---':$user['curp']; ?></td>
            <td><?php echo ($user['rfc'] == NULL)?'---':$user['rfc']; ?></td>
            <td><?php echo $this->Time->niceShort($user['created']); ?></td>
            <td>
                <?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'edit', $user['id'], 'admin' => 0)); ?>
                <?php echo $this->Form->postLink('Borrar', array('action' => 'delete', $user['id']), array('confirm' => '¿Estás seguro?', 'class' => 'danger')); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
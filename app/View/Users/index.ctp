<?php
    echo $this->Session->flash();
?>

<h1>User posts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $u): ?>
    <?php  $user = $u['User']?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['name'],
                array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink('Delete',
                array('action' => 'delete', $user['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit', $user['id']));?>
        </td>
        <td><?php echo $user['created']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add')); ?>
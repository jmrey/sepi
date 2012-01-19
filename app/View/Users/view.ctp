<?php $u = $user['User']; ?>
<h1 class="s_title">Perfil de Usuario</h1>
<?php echo $this->element('dashboard_menu'); ?>
<h1><?php echo $u['name']?></h1>
<p><small>Created: <?php echo $u['created']?></small></p>
<p><?php echo $u['username']?></p>

<div class="actions">
    <?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'edit', $u['id'], 'admin' => 0),
            array('class' => 'btn large primary')); ?>
</div>
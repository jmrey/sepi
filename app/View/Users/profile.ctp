<div class="users content">
    <?php 
        $u = $user['User']; 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'users', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Perfil de ' . $u['name'], array('controller' => 'users', 'action' => 'view', $u['id']));
    ?>
    <div class="well">
        <h1><?php echo $u['name']?></h1>
        <p><small>Created: <?php echo $u['created']?></small></p>
        <p><?php echo $u['username']?></p>

        <div class="form-actions">
            <?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'edit', $u['id'], 'admin' => $isAdmin),
                    array('class' => 'btn btn-large btn-primary')); ?>
        </div>
    </div>
</div>
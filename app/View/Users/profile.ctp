<div class="users content">
    <?php 
        $doc = $user['User']; 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        if ($isAdmin) {
            $this->Crumb->add($title_for_layout, array('controller' => 'users', 'action' => 'index', 'admin' => $isAdmin));
            $this->Crumb->add(($doc['username'] === $authUser['username'] ? 'Mi Perfil' : 'Perfil de '. $doc['username']),
                    array('controller' => 'users', 'action' => 'view', $doc['id'], 'admin' => $isAdmin));
        } else {
            $this->Crumb->add('Mi Perfil', array('controller' => 'users', 'action' => 'profile'));
        }
    ?>
    <div class="well">
        <h1><?php echo $doc['fullname']?></h1>
        <p><small>Created: <?php echo $doc['created']?></small></p>
        <p><?php echo $doc['username']?></p>

        <div class="form-actions">
            <?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'edit', ($isAdmin ? $doc['id'] : null), 'admin' => $isAdmin),
                    array('class' => 'btn btn-large btn-primary')); ?>
        </div>
    </div>
</div>
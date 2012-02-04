<ul class="nav nav-list">
    <?php if ($isAdmin) : ?>
    <li class="nav-header"><?php echo $this->Html->link('Usuarios',
                array('controller' => 'users', 'action' => 'index', 'admin' => $isAdmin)); ?></li>
    <li><a href="#">Link</a></li>
    <li class="nav-header"><?php echo $this->Html->link('Contenidos',
                array('controller' => 'contenidos', 'action' => 'index', 'admin' => $isAdmin)); ?></li>
    <li><a href="#">Link</a></li>
    <?php endif; ?>
     <li class="nav-header">
        <?php echo ($authUser) ? $this->Html->link('Becas',
            array('controller' => 'becas', 'action' => 'index',
                'admin' => $isAdmin)) : 'Becas'; ?>
    </li>
    <li><a href="#">Informaci&oacuten</a></li>
    <li class="nav-header"><?php echo $this->Html->link('Convocatorias', '/convocatorias'); ?></li>
</ul>
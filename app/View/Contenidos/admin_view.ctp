<div class="contenidos content">
    <?php
        $c = $contenido['Contenido'];
    
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'contenidos', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add($c['name'], array('controller' => 'contenidos', 'action' => 'view',$c['id'] , 'admin' => $isAdmin));
        
    ?>
    <div class="well">
        <h1><?php echo $c['title']?></h1>
        <h3><?php echo $c['type']?></h3>

        <p><small>Created: <?php echo $c['created']?></small></p>

        <div><?php echo $c['content']?></div>
        <div class="form-actions">
            <?php 
                echo $this->Html->link('Editar' , array('action' => 'edit', $c['id']), array('class' => 'btn btn-large btn-primary', 'div' => false));
                echo '  ';
                echo $this->Form->postLink('Borrar',
                            array('action' => 'delete', $c['id']),
                            array('confirm' => '¿Está seguro?', 'class' => 'btn btn-large btn-danger', 'div' => false));
            ?>
        </div>
    </div>
</div>
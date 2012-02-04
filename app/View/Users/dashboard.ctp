<div class="notas content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
    ?>
    <?php
        if (isset($notas)) {
            foreach ($notas as $nota) :
                $n = $nota['Nota'];
    ?>
    <div class="alert alert-success nota fade in" data-alert="alert">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        <?php echo $this->Html->link($n['type'], array('controller' => 'becas', 'action' => 'view', $n['type_id'])); ?>
        <span>Enviada por: <?php echo $n['user_id']; ?></span>
        <p><?php echo $n['text']; ?></p>
        <?php   echo $this->Form->postLink('Marcar como leída',
                array('controller' => 'notas', 'action' => 'change', $n['id'], 'read', 'admin' => 0),
                array('confirm' => '¿Está seguro?', 'class' => 'btn btn-success'));
         ?>
    </div>
    <?php 
            endforeach;
        }
    ?>
    <div class="form-actions">
        <?php 
            if (isset($authUser) && $authUser['role'] === 'profesor') {
                echo $this->Html->link('Agregar articulo a Revista', array('controller' => 'documentos', 'action'=> 'upload'),
                        array('class' => 'btn btn-large btn-primary'));
            }
            echo $this->Html->link('Solicitar beca.', array('controller' => 'becas', 'action' => 'add'),
                    array('class' => 'btn btn-large btn-primary'));
        ?>
    </div>
</div>

<div class="notas content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
    ?>
    <?php echo $this->element('list_notes', array('notas' => $notas)); ?>
    
    <div class="form-actions">
        <?php 
            echo $this->Html->link('Ver mi perfil.', array('controller' => 'users', 'action' => 'profile'),
                    array('class' => 'btn btn-large btn-primary'));
        ?>
        <?php
            if (isset($authUser) && $authUser['role'] === 'profesor') {
                echo $this->Html->link('Agregar articulo a Revista', array('controller' => 'documentos', 'action'=> 'upload'),
                        array('class' => 'btn btn-large btn-primary'));
            }
        ?>
        <?php
            echo $this->Html->link('Registrar beca.', array('controller' => 'becas', 'action' => 'add'),
                    array('class' => 'btn btn-large btn-primary'));
        ?>
    </div>
</div>

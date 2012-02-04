<div class="contenidos form">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'contenidos', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Editando ' . $this->request->data['Contenido']['name'], 
                array('controller' => 'contenidos', 'action' => 'edit', $this->request->data['Contenido']['id'], 'admin' => $isAdmin));
    ?>
    <div class="well">    
    <?php echo $this->Form->create('Contenido', array('action' => 'edit', 'class' => 'form-inline'));?>
        <fieldset>
            <legend><?php echo 'Editar Contenido'; ?></legend>
        <?php
            echo $this->Form->input('title', array(
                    'label' => 'Titulo'
                ));
            echo $this->Form->textarea('content', array(
                    'label' => 'Texto',
                    'class' => 'editor'
                ));
            echo $this->Form->input('id', array('type' => 'hidden'));
        ?>
        </fieldset>
        <div class="form-actions">
            <?php 
                echo $this->Form->end(array('label' => 'Guardar', 'class' => 'btn btn-large btn-success', 'div' => false));
            ?>
        </div>
    </div>
</div>
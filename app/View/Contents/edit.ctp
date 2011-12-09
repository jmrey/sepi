<div class="contents form">
<h1>Edit User</h1>
<?php echo $this->Form->create('Content', array('action' => 'edit'));?>
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
<div class="actions">
    <?php 
        echo $this->Form->end(array('label' => 'Guardar', 'class' => 'btn large success', 'div' => false));
    ?>
</div>
</div>
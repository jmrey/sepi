<div class="convocatories form">
<?php echo $this->Form->create('Contenido'); ?>
<fieldset>
    <legend><?php echo 'Agregar Convocatoria'; ?></legend>
    <?php
        echo $this->Form->input('title', array(
            'label' => 'Titulo'
        ));
        
        echo $this->Form->input('name', array(
            'label' => 'Nombre'
        ));
        //date('Y-m-d H:i:s')
        echo $this->Form->textarea('content', array(
            'label' => 'Texto',
            'class' => 'editor'
        ));
        echo $this->Form->hidden('type', array(
            'default' => 'convocatoria'
        ));
        
        echo $this->Form->input('created', array(
            'label' => 'Inicia',
            'default' => date('Y-m-d H:i:s')
        ));
        echo $this->Form->input('modified', array(
            'label' => 'Termina',
            'default' => date('Y-m-d H:i:s')
        ));
        //echo $this->Form->input('user_id', array('type' => 'hidden'));
    ?>
</fieldset>
<div class="actions">
    <?php 
        echo $this->Form->end(array('label' => 'Continuar', 'class' => 'btn large success', 'div' => false));
        echo $this->Form->button('Limpiar', array('type' => 'reset', 'class' => 'btn large'));
    ?>
</div>
</div>
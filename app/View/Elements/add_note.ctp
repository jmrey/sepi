<div class="notas form in-table">
<div class="flash-message"></div>
<?php echo $this->Form->create('Nota', array('controller' => 'notas', 'action' => 'add', 'admin' => 1, 'id' => 'NotaAddForm' . $type_id)); ?>
<fieldset>
    <legend><?php echo 'Agregar Nota'; ?></legend>
    <?php
        //echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $to_user_id));
        echo $this->Form->input('to_user_id', array('type' => 'hidden', 'value' => $to_user_id));
        echo $this->Form->input('type', array('type' => 'hidden', 'value' => $type));
        echo $this->Form->input('type_id', array('type' => 'hidden', 'value' => $type_id));
        echo $this->Form->input('text', array(
            'label' => 'Nota:',
            'placeholder' => 'Nota'
        ));
        //echo $this->Form->input('user_id', array('type' => 'hidden'));
    ?>
</fieldset>
<div class="actions">
    <?php 
        echo $this->Form->end(array('label' => 'Agregar', 'class' => 'btn success', 'div' => false));
        echo $this->Html->link('Cerrar', '#close', array('class' => 'btn'));
        echo $this->Html->link('Ver todas las notas.', array('controller' => 'notas', 'action' => 'list', $type, $type_id ));
    ?>
</div>
</div>
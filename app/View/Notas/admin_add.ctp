<div class="becas form">
<?php echo $this->Form->create('Nota'); ?>
<fieldset>
    <legend><?php echo 'Agregar Nota'; ?></legend>
    <?php
        echo $this->Form->input('user_id', array('type' => 'hidden'));
        echo $this->Form->input('to_user_id', array('type' => 'hidden'));
        echo $this->Form->input('text', array(
            'label' => 'Nota:'
        ));
        //echo $this->Form->input('user_id', array('type' => 'hidden'));
    ?>
</fieldset>
<div class="actions">
    <?php 
        echo $this->Form->end(array('label' => 'Continuar', 'class' => 'btn large success', 'div' => false));
        echo $this->Html->link('Cancelar', '#close');
    ?>
</div>
</div>
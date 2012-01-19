<div class="email form">
<?php echo $this->Form->create(false, array('action' => 'send')); ?>
<fieldset>
    <legend>Correo Electr&oacute;nico</legend>
    <?php
        echo $this->Form->input('to', array(
            'label' => 'Para:',
            'value' => $user['User']['email']
        ));
        
        echo $this->Form->input('subject', array(
            'label' => 'Asunto:'
        ));
        //date('Y-m-d H:i:s')
        echo $this->Form->textarea('message', array(
            'label' => 'Texto',
            'class' => 'editor'
        ));
        //echo $this->Form->input('user_id', array('type' => 'hidden'));
    ?>
</fieldset>
<div class="actions">
    <?php 
        echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn large success', 'div' => false));
        echo $this->Form->button('Limpiar', array('type' => 'reset', 'class' => 'btn large'));
    ?>
</div>
</div>
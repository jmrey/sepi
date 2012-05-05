<div class="users content">
<?php    
    echo $this->Session->flash('auth', array(
        'params' => array('type' => 'warning'),
        'element' => 'alert'
    ));
?>
<?php echo $this->Form->create('User', array('class' => 'well form-inline'));?>
<fieldset>
    <legend><?php echo __('Ingresa tu nombre de User y contraseña.'); ?></legend>
    <?php
        echo $this->Session->flash();
        echo $this->Form->input('username', array(
            'label' => 'Nombre de Usuario:'
        ));
        echo $this->Form->input('password', array(
            'label' => 'Contraseña:'
        ));
    ?>
</fieldset>
<div class="form-actions">
        <?php 
            echo $this->Form->submit('Iniciar Sesión', array('class' => 'btn btn-large btn-success', 'div' => false));
            echo $this->Html->link('Registrarme', '/signup');
            echo $this->Html->link('¿Olvidaste tu constraseña?', '/');
        ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
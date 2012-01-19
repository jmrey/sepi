<div class="users form">
<?php    
    echo $this->Session->flash('auth', array(
        'params' => array('type' => 'warning'),
        'element' => 'alert'
    ));
?>
<?php echo $this->Form->create('User');?>
<fieldset>
    <legend><?php echo __('Ingresa tu nombre de User y contraseña.'); ?></legend>
    <?php
        echo $this->Session->flash();
        echo $this->Form->input('username', array(
            'label' => 'Nombre de User'
        ));
        echo $this->Form->input('password', array(
            'label' => 'Contraseña'
        ));
    ?>
</fieldset>
<div class="actions">
        <?php 
            echo $this->Form->end(array('label' => 'Iniciar Sesión', 'class' => 'btn large success', 'div' => false));
            echo $this->Html->link('Registrarme', '/signup');
            echo $this->Html->link('¿Olvidaste tu constraseña?', '/');
        ?>
    </div>
</div>
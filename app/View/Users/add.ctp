
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo 'Datos de Sesión'; ?></legend>
        <?php
            echo $this->Form->input('username', array(
                'label' => 'Nombre de User'
            ));
            echo $this->Form->input('email', array(
                'label' => 'Correo Electrónico'
            ));
            echo $this->Form->input('password', array(
                'label' => 'Contraseña'
            ));
        ?>
    </fieldset>
    <fieldset>
        <legend><?php echo 'Perfil'; ?></legend>
        <?php
            echo $this->Form->input('name', array(
                'label' => 'Nombre Completo'
            ));
            echo $this->Form->input('role', array(
                'label' => 'Rol',
                'options' => array( 
                    'alumno' => 'Alumno',
                    'profesor' => 'Profesor',
                    'administrativo' => 'Administrativo'
                )
            ));
        ?>
    </fieldset>
    <div class="actions">
        <?php 
            echo $this->Form->end(array('label' => 'Registrar', 'class' => 'btn large success', 'div' => false));
            echo $this->Form->button('Limpiar', array('type' => 'reset', 'class' => 'btn large'));
        ?>
    </div>
</div>
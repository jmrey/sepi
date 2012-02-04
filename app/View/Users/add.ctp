<div class="users form well">
<?php echo $this->Form->create('User', array('class' => 'form-inline')); ?>
    <fieldset>
        <legend><?php echo 'Datos de Sesión'; ?></legend>
        <?php
            echo $this->Form->input('username', array(
                'label' => 'Nombre de Usuario:'
            ));
            echo $this->Form->input('email', array(
                'label' => 'Correo Electrónico:'
            ));
            echo $this->Form->input('password', array(
                'label' => 'Contraseña:'
            ));
        ?>
    </fieldset>
    <fieldset>
        <legend><?php echo 'Perfil'; ?></legend>
        <?php
            echo $this->Form->input('name', array(
                'label' => 'Nombre Completo:'
            ));
            echo $this->Form->input('role', array(
                'label' => 'Soy:',
                'options' => array( 
                    'alumno' => 'Alumno',
                    'profesor' => 'Profesor',
                    'administrativo' => 'Administrativo'
                )
            ));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php 
            echo $this->Form->end(array('label' => 'Registrar', 'class' => 'btn btn-success btn-large', 'div' => false));
            echo $this->Form->button('Limpiar', array('type' => 'reset', 'class' => 'btn btn-large'));
            echo $this->Html->link('Iniciar Sesión', '/login');
        ?>
    </div>
</div>
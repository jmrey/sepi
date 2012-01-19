<h1>Usuarios</h1>
<?php echo $this->element('dashboard_menu'); ?>
<div class="form">
<?php echo $this->Form->create('User', array('action' => 'edit')); ?>
    <fieldset>
        <legend>Editar Perfil</legend>
        <?php echo $this->Session->flash(); ?>
        <?php   
            echo $this->Form->input('id', array('type' => 'hidden'));
            echo $this->Form->input('username', array(
                'label' => 'Nombre de Usuario'
            ));
            echo $this->Form->input('email', array(
                'label' => 'Correo Electrónico'
            ));
            echo $this->Form->input('rfc', array(
                'label' => 'RFC'
            ));
            echo $this->Form->input('curp', array(
                'label' => 'CURP'
            ));
            echo $this->Form->input('name', array(
                'label' => 'Nombre Completo'
            ));
            echo $this->Form->input('role', array(
                'label' => 'Soy'));
        ?>
    </fieldset>
    <div class="actions">
        <?php echo $this->Form->end(array('label' => 'Guardar Cambios', 'class' => 'btn large success', 'div' => false)); ?>
    </div>
</div>

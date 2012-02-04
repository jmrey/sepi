<div class="users content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'users', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Editar', array('controller' => 'users', 'action' => 'edit', $this->request->data['User']['id'], 'admin' => $isAdmin));
    ?>
    <div class="form">
    <?php echo $this->Form->create('User', array('action' => 'edit', 'class' => 'well form-inline')); ?>
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
        <div class="form-actions">
            <?php echo $this->Form->end(array('label' => 'Guardar Cambios', 'class' => 'btn btn-large btn-success', 'div' => false)); ?>
        </div>
    </div>
</div>

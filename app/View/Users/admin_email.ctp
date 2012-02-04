<div class="email form">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'users', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Email', array('controller' => 'users', 'action' => 'email', $user['User']['id'], 'admin' => $isAdmin));
    ?>
    <?php echo $this->Form->create(false, array('action' => 'send', 'class' => 'form-inline')); ?>
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
    <div class="form-actions">
        <?php 
            echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-large btn-success', 'div' => false));
            echo $this->Form->button('Limpiar', array('type' => 'reset', 'class' => 'btn btn-large'));
        ?>
    </div>
</div>
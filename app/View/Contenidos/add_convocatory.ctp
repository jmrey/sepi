<div class="convocatories form">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'contenidos', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Nueva Convocatoria', array('controller' => 'contenidos', 'action' => 'add_convocatory', 'admin' => $isAdmin));
    ?>
    <?php echo $this->Form->create('Contenido', array('class' => 'form-inline')); ?>
    <fieldset>
        <legend><?php echo 'Agregar Convocatoria'; ?></legend>
        <?php
            echo $this->Form->input('title', array(
                'label' => 'Titulo'
            ));

            echo $this->Form->input('name', array(
                'label' => 'Nombre'
            ));
            //date('Y-m-d H:i:s')
            echo $this->Form->textarea('content', array(
                'label' => 'Texto',
                'class' => 'editor'
            ));
            echo $this->Form->hidden('type', array(
                'default' => 'convocatoria'
            ));
            echo $this->Form->input('created', array(
                'label' => 'Inicia',
                'class' => 'datepicker',
                'type' => 'text', 
                'after' => '<input type="text" class="alternate">'
            ));
            echo $this->Form->input('modified', array(
                'label' => 'Termina',
                'class' => 'datepicker',
                'type' => 'text',
                'after' => '<input type="text" class="alternate">'
            ));
            //echo $this->Form->input('user_id', array('type' => 'hidden'));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php 
            echo $this->Form->end(array('label' => 'Continuar', 'class' => 'btn btn-large btn-success', 'div' => false));
            echo $this->Form->button('Limpiar', array('type' => 'reset', 'class' => 'btn btn-large'));
        ?>
    </div>
</div>
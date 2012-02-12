<div class="contenidos form">
<?php echo $this->Form->create('Contenido', array('class' => 'form-inline')); ?>
<fieldset>
    <legend><?php echo 'Agregar contenido'; ?></legend>
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
        echo $this->Form->input('type', array(
            'label' => 'Tipo',
            'options' => array(
                'acerca' => 'Acerca', 
                'contacto' => 'Contacto',
                'info' => 'Información',
                'post' => 'Post'
            ),
            'default' => $type
        ));
        /*echo $this->Form->input('begin_date', array(
            'label' => 'Inicia',
            'class' => 'datepicker',
            'type' => 'text', 
            'after' => '<input type="text" class="alternate">'
        ));
        echo $this->Form->input('end_date', array(
            'label' => 'Termina',
            'class' => 'datepicker',
            'type' => 'text',
            'after' => '<input type="text" class="alternate">'
        ));*/
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
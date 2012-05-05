<div class="becas content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'becas', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Nueva', array('controller' => 'becas', 'action' => 'add'));
    ?>
    
    <?php echo $this->Form->create('Beca', array('class' => 'well form-inline')); ?>
        <fieldset>
            <legend><?php echo 'Registrar Beca'; ?></legend>
            <?php
                //date('Y-m-d H:i:s')
                echo $this->Form->input('type', array(
                    'label' => 'Tipo de Beca',
                    'options' => array(
                        'pifi' => 'PIFI', 
                        'cotepabe' => 'COTEPABE',
                        'cofaa' => 'Beca de Estudios COFAA',
                        'sibe' => 'SIBE'
                    )
                ));
                echo $this->Form->input('begin_date', array(
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
    <?php //Termina el Form ?> 
</div>

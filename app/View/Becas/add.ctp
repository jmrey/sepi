<div class="becas form">
<?php echo $this->Form->create('Beca'); ?>
<fieldset>
    <legend><?php echo 'Registrar Beca'; ?></legend>
    <?php
        //date('Y-m-d H:i:s')
        echo $this->Form->input('type', array(
            'label' => 'Tipo de Beca',
            'options' => array(
                'pifi' => 'PIFI', 
                'cotepabe' => 'COTEPABE',
                'cofaa' => 'COFAA',
                'sibe' => 'SIBE'
            )
        ));
        echo $this->Form->input('begin_date', array(
            'label' => 'Inicia',
            'default' => date('Y-m-d H:i:s')
        ));
        echo $this->Form->input('end_date', array(
            'label' => 'Termina',
            'default' => date('Y-m-d H:i:s')
        ));
        //echo $this->Form->input('user_id', array('type' => 'hidden'));
    ?>
</fieldset>
<div class="actions">
    <?php 
        echo $this->Form->end(array('label' => 'Continuar', 'class' => 'btn large success', 'div' => false));
        echo $this->Form->button('Limpiar', array('type' => 'reset', 'class' => 'btn large'));
    ?>
</div>
</div>
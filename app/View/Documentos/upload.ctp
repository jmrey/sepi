<h1>Subir Archivo</h1>
<?php echo $this->element('dashboard_menu'); ?>
<?php
    echo $this->Session->flash();
?>
<div class="documentos form">
    <?php echo $this->Form->create('Documento', array('type' => 'file', 'action' => 'upload')); ?>
    <fieldset>
        <?php echo $this->Form->input('Documento.submittedfile', array('between'=>'<br />','type'=>'file')); ?>
    </fieldset>
    <div class="actions">
    <?php 
        echo $this->Form->end(array('label' => 'Subir', 'class' => 'btn large success', 'div' => false));
    ?>
</div>
</div>
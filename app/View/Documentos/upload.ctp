<div class="documentos content">
    <?php
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'documentos', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Subir archivo', array('controller' => 'documentos', 'action' => 'upload', 'admin' => $isAdmin));
        
    
        echo $this->Session->flash();
    ?>
    <div class="well form">
        <?php echo $this->Form->create('Documento', array('type' => 'file', 'action' => 'upload', 'class' => 'form-inline')); ?>
        <fieldset>
            <legend>Subir Archivo</legend>
            <?php echo $this->Form->input('Documento.submittedfile',
                    array(
                        'between'=>'<br />',
                        'type'=>'file', 
                        'label' => 'Archivo'
                        )); ?>
        </fieldset>
        <div class="form-actions">
            <?php 
                echo $this->Form->end(array('label' => 'Subir', 'class' => 'btn btn-large btn-success', 'div' => false));
            ?>
        </div>
    </div>
    
</div>
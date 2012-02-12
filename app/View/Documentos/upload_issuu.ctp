<div class="documentos content">
    <?php
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'documentos', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Subir archivo', array('controller' => 'documentos', 'action' => 'upload', 'admin' => $isAdmin));
        
    
        echo $this->Session->flash();
    ?>
    <div class="well form">
        <?php echo $this->Form->create(null, array('type' => 'file', 'action' => 'upload_issuu', 'class' => 'form-inline')); ?>
        <fieldset>
            <legend>Subir Archivo</legend>
            <?php /*echo $this->Form->input('Documento.submittedfile',
                    array('type'=>'file', 'label' => 'Archivo'));*/
            echo $this->Form->input('action', array(
                'type' => 'hidden',
                'name' => 'action',
                'value' => 'issuu.document.upload'
            ));
            
            /*echo $this->Form->input('apiKey', array(
                'type' => 'hidden',
                'name' => 'apiKey',
                'value' => $apiKey
            ));
            
            echo $this->Form->input('signature', array(
                'type' => 'hidden',
                'name' => 'signature',
                'value' => $signature
            ));*/
            
            /*echo $this->Form->input('format', array(
                'type' => 'hidden',
                'name' => 'format',
                'value' => 'json'
            ));*/
            
            /*echo $this->Form->input('Titulo', array(
                'name' => 'title'
            ));
            
            echo $this->Form->textarea('Descripcion', array(
                'name' => 'description'
            ));*/
            
            echo $this->Form->input('file', array(
                    'type' => 'file',
                    'label' => 'Artículo'
                ));
            
            ?>
        </fieldset>
        <div class="form-actions">
            <?php 
                echo $this->Form->end(array('label' => 'Subir', 'name' => '_upload', 'class' => 'btn btn-large btn-success', 'div' => false));
            ?>
        </div>
    </div>
    
</div>
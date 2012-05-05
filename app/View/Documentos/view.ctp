<div class="documentos content">
    <?php 
        $doc = $documento['Documento'];
        $documentId = $doc['documentId'];
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'documentos', 'action' => 'index', 'admin' => $isAdmin));    
        $this->Crumb->add('Viendo Documento: ' . $doc['name'], array('controller' => 'documentos', 'action' => 'view', $doc['id'], 'admin' => 0));
    ?>
    <div class="well">
        <div>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" style="width:700px;height:500px" id="00506c9c-8a98-f0a8-9f8c-58b5f7c912eb" >
                <param name="movie" value="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf?mode=mini&amp;shareMenuEnabled=false&amp;shareButtonEnabled=false&amp;searchButtonEnabled=false&amp;backgroundColor=%23222222&amp;documentId=<?php echo $documentId; ?>" />
                <param name="allowfullscreen" value="true"/>
                <param name="menu" value="false"/>
                <param name="wmode" value="transparent"/>
                <embed src="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf" type="application/x-shockwave-flash" allowfullscreen="true" menu="false" wmode="transparent" style="width:700px;height:500px" flashvars="mode=mini&amp;shareMenuEnabled=false&amp;shareButtonEnabled=false&amp;searchButtonEnabled=false&amp;backgroundColor=%23222222&amp;documentId=<?php echo $documentId; ?>" />
            </object>
        <div>
        <?php echo $this->element('add_note', 
            array('to_user_id' => $doc['user_id'],
                'type' => 'documento',
                'type_id' => $doc['id'])
            );
        ?>
        <div class="form-actions">
            <?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'edit', ($isAdmin ? $doc['id'] : null), 'admin' => $isAdmin),
                    array('class' => 'btn btn-large btn-primary')); ?>
        </div>
    </div>
</div>

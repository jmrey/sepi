<div class="documentos content">
    <?php
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'documentos', 'action' => 'index', 'admin' => $isAdmin));
        $this->Crumb->add('Subir archivo', array('controller' => 'documentos', 'action' => 'upload', 'admin' => 0));
        
    
        echo $this->Session->flash();
    ?>
    <div class="well form">
        <div id="demo1"></div>
    </div>
</div>
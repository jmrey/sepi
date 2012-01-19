<div class="dashboard">
    <h1>Dashboard</h1>
    <?php echo $this->element('dashboard_menu'); ?>
    <div class="actions">
        <?php 
            if (isset($authUser) && $authUser['role'] === 'profesor') {
                echo $this->Html->link('Agregar articulo a Revista', array('controller' => 'documentos', 'action'=> 'upload'),
                        array('class' => 'btn large primary'));
            }
            echo $this->Html->link('Solicitar beca.', array('controller' => 'becas', 'action' => 'add'),
                    array('class' => 'btn large primary'));
        ?>
    </div>
</div>
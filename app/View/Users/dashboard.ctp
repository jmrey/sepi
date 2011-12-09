<div class="form">
<h1>Dashboard</h1>
<div class="actions">
    <?php 
        echo $this->Html->link('Agregar articulo a Revista', '/');
        echo $this->Html->link('Solicitar beca.', array('controller' => 'becas', 'action' => 'add'));
    ?>
</div>
</div>
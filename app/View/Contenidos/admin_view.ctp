<?php 
    $c = $contenido['Contenido'];
?>

<h1><?php echo $c['title']?></h1>
<h3><?php echo $c['type']?></h3>

<p><small>Created: <?php echo $c['created']?></small></p>

<div><?php echo $c['content']?></div>
<div class="actions">
    <?php 
        echo $this->Html->link('Editar' , array('action' => 'edit', $c['id']), array('class' => 'btn large primary', 'div' => false));
        echo '  ';
        echo $this->Form->postLink('Borrar',
                    array('action' => 'delete', $c['id']),
                    array('confirm' => '¿Está seguro?', 'class' => 'btn large danger', 'div' => false));
    ?>
</div>
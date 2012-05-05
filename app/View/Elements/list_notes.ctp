<?php
    if (isset($notas)) {
        foreach ($notas as $beca) :
            $n = $beca['Nota'];
?>
    <div class="alert alert-success nota fade in" data-alert="alert">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        <?php echo $this->Html->link($n['type'], array('controller' => $n['type'] . 's', 'action' => 'view', $n['type_id'])); ?>
        <span>Enviada por: <?php echo $n['user_id']; ?></span>
        <p><?php echo $n['text']; ?></p>
        <?php   echo $this->Form->postLink('Marcar como leída',
                array('controller' => 'notas', 'action' => 'change', $n['id'], 'read', 'admin' => 0),
                array('confirm' => '¿Está seguro?', 'class' => 'btn btn-success'));
            ?>
    </div>
<?php 
        endforeach;
    }
?>
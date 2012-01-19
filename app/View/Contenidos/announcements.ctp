<h1>Convocatorias</h1>
<div class="convocatories">
    <?php if (count($convocatorias) <= 0) { ?>
        <h3>Lo sentimos, no existen convocatorias.</h3>
    <?php } else {
        foreach ($convocatorias as $c):
            $convocatoria = $c['Convocatoria'] ?>
        <h3><?php echo $convocatoria['title']; ?></h3>
        <div class="convocatoria" id="<?php echo $convocatoria['name'];?>">
            <?php echo $convocatoria['content']; ?>
        </div>
        <?php endforeach; ?>
        <div class="actions">
            <?php 
                if (isset($authUser) && $authUser['role'] === 'admin') {
                    echo $this->Html->link('Agregar Convocatoria', array('controller' => 'contenidos', 'action' => 'add_convocatory', 'admin' => 1),
                        array('class' => 'btn large primary')); 
                }
            ?>
        </div>
    <?php } ?>
</div>
<div class="convocatorias display content">
    <h1>Convocatorias</h1>
    <?php if (count($convocatorias) <= 0) { ?>
        <h3>Lo sentimos, no existen convocatorias.</h3>
    <?php } else {
        foreach ($convocatorias as $c):
            $convocatoria = $c['Contenido'] ?>
        <div class="well">
            <h3><?php echo $convocatoria['title']; ?></h3>
            <div class="convocatoria" id="<?php echo $convocatoria['name'];?>">
                <?php echo $convocatoria['content']; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="form-actions">
            <?php 
                if (isset($authUser) && $authUser['role'] === 'admin') {
                    echo $this->Html->link('Agregar Convocatoria', array('controller' => 'contenidos', 'action' => 'add_convocatory', 'admin' => 1),
                        array('class' => 'btn btn-large btn-primary')); 
                }
            ?>
        </div>
    <?php } ?>
</div>
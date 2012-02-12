<div class="contenidos display content">
    <?php 
        $firstPost = true;
        $totalContenidos = count($contenidos);
    ?>
    <h1><?php echo $title; ?></h1>
    <?php if ($totalContenidos > 0) :?>
        <ul class="nav nav-tabs" data-tabs="tabs">
            <?php foreach ($contenidos as $c):
                    $contenido = $c['Contenido'] ?>
            <li<?php echo ($firstPost == true ? ' class="active"': ''); ?>><a href="<?php echo '#' . $contenido['name'];?>" data-toggle="tab"><?php echo $contenido['title'];?></a></li>
            <?php $firstPost = false; ?>
            <?php endforeach; ?>
        </ul>
        <?php $firstPost = true; ?>
        <div class="tab-content">
            <?php foreach ($contenidos as $c):
                    $contenido = $c['Contenido'] ?>
            <div class="tab-pane <?php echo ($firstPost == true ? 'active': ''); ?>" id="<?php echo $contenido['name'];?>">
                <?php echo $contenido['content'];?>
                <?php if ($isAdmin) : ?>
                    <div class="form-actions">
                        <?php 
                            echo $this->Html->link('Agregar Contenido', array('controller' => 'contenidos', 'action' => 'add', $contenido['type'], 'admin' => $isAdmin),
                                array('class' => 'btn btn-large btn-success'));

                            echo $this->Html->link('Edit', array('controller' => 'contenidos', 'action' => 'edit', 'admin' => 1, $contenido['id'], 'admin' => $isAdmin),
                                array('class' => 'btn btn-large btn-primary'));
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php $firstPost = false; ?>
            <?php endforeach; ?>
        </div>
    <?php endif;?>
    <?php if ($isAdmin && $totalContenidos == 0) : ?>
        <div class="form-actions">
            <?php 
                echo $this->Html->link('Agregar Contenido', array('controller' => 'contenidos', 'action' => 'add'),
                    array('class' => 'btn btn-large btn-success'));
            ?>
        </div>
    <?php endif; ?>
</div>
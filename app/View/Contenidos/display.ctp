<div class="contenidos display content">
    <?php $first = true; ?>
    <h1><?php echo $title; ?></h1>
    <ul class="nav nav-tabs" data-tabs="tabs">
        <?php foreach ($contenidos as $c):
                $contenido = $c['Contenido'] ?>
        <li<?php echo ($first) ? ' class="active"': ''; ?>><a href="<?php echo '#' . $contenido['name'];?>" data-toggle="tab"><?php echo $contenido['title'];?></a></li>
        <?php $first = false; ?>
        <?php endforeach; ?>
    </ul>
    <?php $first = true; ?>
    <div class="tab-content">
        <?php foreach ($contenidos as $c):
                $contenido = $c['Contenido'] ?>
        <div class="tab-pane <?php echo ($first) ? 'active': ''; ?>" id="<?php echo $contenido['name'];?>">
            <?php echo $contenido['content'];?>
            <?php if (isset($authUser) && $authUser['role'] === 'admin') { ?>
            <div class="form-actions">
                <?php 
                    echo $this->Html->link('Agregar Contenido', array('controller' => 'contenidos', 'action' => 'add'),
                        array('class' => 'btn btn-large btn-success'));

                    echo $this->Html->link('Edit', array('controller' => 'contenidos', 'action' => 'edit', 'admin' => 1, $contenido['id']),
                        array('class' => 'btn btn-large btn-primary'));
                ?>
            </div>
            <?php } ?>
        </div>

        <?php $first = false; ?>
        <?php endforeach; ?>
    </div>
</div>
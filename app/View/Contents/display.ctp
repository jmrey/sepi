<?php $first = true; ?>
<h1><?php echo $title; ?></h1>
<ul class="tabs" data-tabs="tabs">
    <?php foreach ($contents as $c):
            $content = $c['Content'] ?>
    <li<?php echo ($first) ? ' class="active"': ''; ?>><a href="<?php echo '#' . $content['name'];?>"><?php echo $content['title'];?></a></li>
    <?php $first = false; ?>
    <?php endforeach; ?>
</ul>
<?php $first = true; ?>
<div class="pill-content">
    <?php foreach ($contents as $c):
            $content = $c['Content'] ?>
    <div<?php echo ($first) ? ' class="active"': ''; ?> id="<?php echo $content['name'];?>">
        <?php echo $content['content'];?>
        <hr />
        <?php if (isset($authUser) && $authUser['role'] === 'admin') { ?>
        <div>
            <?php 
                echo $this->Html->link('Agregar Content', array('controller' => 'contents', 'action' => 'add'),
                    array('class' => 'btn large success'));
            
                echo $this->Html->link('Edit', array('controller' => 'contents', 'action' => 'edit', 'admin' => 1, $content['id']),
                    array('class' => 'btn large primary'));
            ?>
        </div>
        <?php } ?>
    </div>

    <?php $first = false; ?>
    <?php endforeach; ?>
</div>
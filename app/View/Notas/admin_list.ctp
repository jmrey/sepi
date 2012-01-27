<div class="dashboard">
<h1>Becas</h1>
<?php echo $this->element('dashboard_menu'); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Tipo id</th>
        <th>Nota</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($notas as $b): ?>
    <?php  $beca = $b['Nota']; ?>
    <?php  //$user = $b['User']; ?>
    <tr class="no-border">
        <td><?php echo $beca['id']; ?></td>
        <td>
            <?php echo 'user';//$this->Html->link($user['username'],
                //array('controller' => 'users', 'action' => 'view', $beca['user_id'])); ?>
        </td>
        <td><?php echo $this->Html->link($beca['type'], array('controller' => 'notas', 'action' => 'list', $beca['type'], 'admin' => '1')); ?></td>
        <td><?php echo $beca['type_id']; ?></td>
        <td><?php echo $beca['text']; ?></td>
        <td><?php echo $beca['status']; ?></td>
        <td>
            <ul>
                <?php 
                    if(isset($authUser) && $authUser['role'] === 'admin') {
                ?>
                <li>            
                     <?php   echo $this->Form->postLink('Aprobar',
                            array('action' => 'delete', 'admin' => 0, $beca['id']),
                            array('confirm' => '¿Está seguro?', 'class' => 'success'));
                     ?>
                </li>
                <?php
                    }
                ?>
                <li>
                    <?php echo $this->Form->postLink('Cancelar',
                        array('action' => 'delete', 'admin' => 0, $beca['id']),
                        array('confirm' => '¿Está seguro?', 'class' => 'danger'));
                    ?>
                </li>
            <ul>
        </td>
    </tr>
    <tr class="tr-notes">
        <td colspan="7">
            <div class="hide">
                <?php
                    echo 'HOLa mundol';
                ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="actions">
    <?php echo $this->Html->link('Agregar Nota', array('controller' => 'becas', 'action' => 'add', 'admin' => '0'),
            array('class' => 'btn primary')); ?>
    <?php echo $this->Html->link($title, array('controller' => 'becas', 'action' => 'add', 'admin' => '0'),
            array('class' => 'btn primary')); ?>
</div>
</div>
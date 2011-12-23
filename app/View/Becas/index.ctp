<h1>Becas</h1>
<?php echo $this->element('dashboard_menu'); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Empieza</th>
        <th>Termina</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($becas as $b): ?>
    <?php  $beca = $b['Beca']?>
    <tr>
        <td><?php echo $beca['id']; ?></td>
        <td>
            <?php echo $this->Html->link($beca['user_id'],
                array('controller' => 'users', 'action' => 'view', $beca['user_id'])); ?>
        </td>
        <td><?php echo strtoupper($beca['type']); ?></td>
        <td><?php echo $beca['status']; ?></td>
        <td><?php echo $beca['begin_date']; ?></td>
        <td><?php echo $beca['end_date']; ?></td>
        <td>
            <?php 
                if(isset($authUser) && $authUser['role'] === 'admin') {
                    echo $this->Form->postLink('Aprobar',
                        array('action' => 'delete', 'admin' => 0, $beca['id']),
                        array('confirm' => '¿Está seguro?', 'class' => 'success'));
                }
            ?>
            <?php echo $this->Form->postLink('Observaciones',
                array('action' => 'delete', 'admin' => 0, $beca['id']),
                array('confirm' => '¿Está seguro?'));
            ?>
            <?php echo $this->Form->postLink('Cancelar',
                array('action' => 'delete', 'admin' => 0, $beca['id']),
                array('confirm' => '¿Está seguro?', 'class' => 'danger'));
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="actions">
    <?php echo $this->Html->link('Agregar Beca', array('controller' => 'becas', 'action' => 'add', 'admin' => '0')); ?>
</div>
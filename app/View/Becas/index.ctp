<div class="dashboard">
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
    <?php  $beca = $b['Beca']; ?>
    <?php  $user = $b['User']; ?>
    <tr>
        <td><?php echo $beca['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['username'],
                array('controller' => 'users', 'action' => 'view', $beca['user_id'])); ?>
        </td>
        <td><?php echo strtoupper($beca['type']); ?></td>
        <td><?php echo $beca['status']; ?></td>
        <td><?php echo $beca['begin_date']; ?></td>
        <td><?php echo $beca['end_date']; ?></td>
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
                    <?php echo $this->Form->postLink('Observaciones',
                        array('action' => 'delete', 'admin' => 0, $beca['id']),
                        array('confirm' => '¿Está seguro?'));
                    ?>
                </li>
                <li>
                    <?php echo $this->Form->postLink('Cancelar',
                        array('action' => 'delete', 'admin' => 0, $beca['id']),
                        array('confirm' => '¿Está seguro?', 'class' => 'danger'));
                    ?>
                </li>
            <ul>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="actions">
    <?php echo $this->Html->link('Agregar Beca', array('controller' => 'becas', 'action' => 'add', 'admin' => '0'),
            array('class' => 'btn primary')); ?>
</div>
</div>
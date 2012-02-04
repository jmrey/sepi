<?php 
    $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
    $this->Crumb->add($title_for_layout, array('controller' => 'becas', 'action' => 'index', 'admin' => $isAdmin));
?>
<div class="becas content">
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Empieza</th>
                <th>Termina</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($becas as $b):
                    $beca = $b['Beca'];
                    $user = $b['User']; ?>
            <tr class="no-border">
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
                                    array('action' => 'change', $beca['id'], 'aprobada', 'admin' => 0),
                                    array('confirm' => '¿Está seguro?', 'class' => 'success'));
                             ?>
                        </li>
                        <?php
                            }
                        ?>
                        <li>
                            <?php echo $this->Html->link('Notas', '#',
                                    array('class' => 'toggle-notes')); ?>
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
            <tr class="tr-notes">
                <td colspan="7">
                    <div class="hide">
                        <?php echo $this->element('add_note', 
                                array('to_user_id' => $beca['user_id'],
                                    'type' => 'beca',
                                    'type_id' => $beca['id'])
                                ); ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="form-actions">
        <?php echo $this->Html->link('Agregar Beca', array('controller' => 'becas', 'action' => 'add', 'admin' => '0'),
                array('class' => 'btn btn-primary btn-large')); ?>
    </div>
</div>
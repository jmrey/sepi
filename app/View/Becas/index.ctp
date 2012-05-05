<?php 
    $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
    $this->Crumb->add($title_for_layout, array('controller' => 'becas', 'action' => 'index', 'admin' => $isAdmin));
?>
<div class="becas content">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <?php if ($isAdmin): ?>
                <th>Usuario</th>
                <?php endif; ?>
                <th>Tipo</th>
                <th>Empieza</th>
                <th>Termina</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $count = 0;
                foreach ($becas as $b):
                    $beca = $b['Beca'];
                    if($isAdmin) $user = $b['User']; 
                ?>
            <tr class="no-border">
                <td><?php echo ($isAdmin) ? $beca['id'] : ++$count; ?></td>
                <?php if ($isAdmin) :?>
                <td>
                    <?php echo $this->Html->link($user['username'],
                        array('controller' => 'users', 'action' => 'view', $beca['user_id'])); ?>
                </td>
                <?php endif; ?>
                <td><?php echo strtoupper($beca['type']); ?></td>
                <td><?php echo $this->Time->format('F j, Y', $beca['begin_date']); ?></td>
                <td><?php echo $this->Time->format('F j, Y', $beca['end_date']); ?></td>
                <td>
                    <?php 
                        /*echo $nota['status'] ? 'Aprobada' : 'En revisón';*/ 
                        if ($isAdmin) {
                            $status_opts = array('En revisión', 'Aprobada', 'Cancelada');
                            echo $this->Form->input('status', array(
                                'options' => $status_opts,
                                'label' => false,
                                'default' => $beca['status'],
                                'class' => 'dk',
                                'name' => 'dk' . $beca['id'],
                                'id' => 'dk_status' . $beca['id'],
                                'div' => false
                            ));
                        } else {
                            echo $beca['status'] ? 'Aprobada' : 'En revisón';
                        }
                    ?>
                </td>
                <td>
                    <?php 
                        if($isAdmin && !$beca['status']) {
                            echo $this->Form->postLink('Aprobar',
                                array('action' => 'change', $beca['id'], 'aprobada', 'admin' => $isAdmin),
                                array('confirm' => '¿Está seguro?', 'class' => 'success'));

                        }
                    ?>
                    <?php
                        echo $this->Html->link('Notas', '#',
                                array('class' => 'toggle-notes'));
                    ?>
                    <?php
                        echo $this->Form->postLink('Cancelar',
                            array('action' => 'delete', $beca['id'], 'admin' => 0),
                            array('confirm' => '¿Está seguro?', 'class' => 'danger'));
                    ?>
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
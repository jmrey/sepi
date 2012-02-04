<div id="notas content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'notas', 'action' => 'index', 'admin' => $isAdmin));
        if ($type_title != 'all') {
            $this->Crumb->add($type_title, array('controller' => 'notas', 'action' => 'index', $type_title, 'admin' => $isAdmin));
        }
    ?>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Para</th>
            <th>Tipo</th>
            <th>Tipo id</th>
            <th>Nota</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($notas as $n): ?>
        <?php  $beca = $n['Nota']; ?>
        <?php  $controller_type = ($beca['type'] === 'documento')?'documentos':'becas' ;?>
        <tr class="no-border">
            <td><?php echo $beca['id']; ?></td>
            <td>
                <?php echo $beca['to_user_id'];//$this->Html->link($user['username'],
                    //array('controller' => 'users', 'action' => 'view', $beca['user_id'])); ?>
            </td>
            <td><?php echo $this->Html->link($beca['type'], array('controller' => 'notas', $beca['type'], 'admin' => $isAdmin)); ?></td>
            <td><?php echo $this->Html->link($beca['type_id'], array('controller' => $controller_type, 'action' => 'view', $beca['type_id'], 'admin' => $isAdmin)); ?></td>
            <td><?php echo $beca['text']; ?></td>
            <td><?php echo $status[$beca['status']]; ?></td>
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
    <div class="form-actions">
        <?php echo $this->Html->link('Agregar Nota', array('controller' => 'notas', 'action' => 'index', 'admin' => $isAdmin),
                array('class' => 'btn btn-primary btn-large')); ?>
        <?php echo $this->Html->link($type_title, array('controller' => 'notas', 'action' => 'index', 'admin' => $isAdmin),
                array('class' => 'btn btn-primary btn-large')); ?>
    </div>
</div>
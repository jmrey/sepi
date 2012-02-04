<div class="documentos content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'documentos', 'action' => 'index', 'admin' => $isAdmin));
    ?>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Tamaño</th>
            <th>Subido por:</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($documentos as $d): ?>
        <?php  $documento = $d['Documento']; ?>
        <?php  $user = $d['User']; ?>
        <tr>
            <td><?php echo $documento['id']; ?></td>
            <td><?php echo $this->Html->link($documento['name'],
                    '/' . $documento['url'], array('target' => '_blank')); ?></td>
            <td><?php echo $documento['type']; ?></td>
            <td><?php echo $this->Number->toReadableSize($documento['size']); ?></td>
            <td>
                <?php echo $this->Html->link($user['username'],
                    array('controller' => 'users', 'action' => 'view', $documento['user_id'])); ?>
            </td>
            <td>
                <ul>
                    <?php 
                        if(isset($authUser) && $authUser['role'] === 'admin') {
                    ?>
                    <li>            
                         <?php   echo $this->Form->postLink('Aprobar',
                                array('action' => 'delete', 'admin' => 0, $documento['id']),
                                array('confirm' => '¿Está seguro?', 'class' => 'success'));
                         ?>
                    </li>
                    <?php
                        }
                    ?>
                    <li>
                        <?php echo $this->Html->link('Observaciones', '#',
                            array('class' => 'toggle-notes'));
                        ?>
                    </li>
                    <li>
                        <?php echo $this->Form->postLink('Borrar',
                            array('action' => 'delete', 'admin' => 0, $documento['id']),
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
                                array('to_user_id' => $documento['user_id'],
                                    'type' => 'documento',
                                    'type_id' => $documento['id'])
                                ); ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="form-actions">
        <?php echo $this->Html->link('Subir Archivo', array('controller' => 'documentos', 'action' => 'upload', 'admin' => '0'),
                array('class' => 'btn btn-primary btn-large')); ?>
    </div>
</div>
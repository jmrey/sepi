<div class="documentos content">
    <?php 
        $this->Crumb->add('Inicio', array('controller' => 'users', 'action' => 'dashboard', 'admin' => $isAdmin));
        $this->Crumb->add($title_for_layout, array('controller' => 'documentos', 'action' => 'index', 'admin' => $isAdmin));
    ?>
    <table class="table">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Tamaño</th>
            <th>Estado</th>
            <?php if ($isAdmin) :?>
            <th>Subido por:</th>
            <?php endif; ?>
            <th>Acciones</th>
        </tr>
        <?php 
        $count = 0;
        foreach ($documentos as $d) :
            $documento = $d['Documento'];
            $user = $d['User']; ?>
        <tr>
            <td><?php echo ($isAdmin) ? $documento['id'] : ++$count; ?></td>
            <td><?php echo $this->Html->link($documento['name'],
                    '/' . $documento['url'], array('target' => '_blank')); ?></td>
            <td><?php echo $documento['type']; ?></td>
            <td><?php echo $this->Number->toReadableSize($documento['size']); ?></td>
            <td><?php echo $documento['status'] ? 'Aprobado' : 'En revisón'; ?></td>
            <?php if ($isAdmin) : ?>
            <td>
                <?php echo $this->Html->link($user['username'],
                    array('controller' => 'users', 'action' => 'view', $documento['user_id'], 'admin' => $isAdmin)); ?>
            </td>
            <?php endif; ?>
            <td>
                <?php 
                    if($isAdmin && !$documento['status']) {
                            echo $this->Form->postLink('Aprobar',
                            array('action' => 'change', $documento['id'], 'aprobada', 'admin' => 1),
                            array('confirm' => '¿Está seguro?', 'class' => 'success'));

                    }
                    echo $this->Html->link('Observaciones', '#',
                        array('class' => 'toggle-notes'));
                    
                    echo $this->Form->postLink('Borrar',
                        array('action' => 'delete', 'admin' => 0, $documento['id']),
                        array('confirm' => '¿Está seguro?', 'class' => 'danger'));
                ?>
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
        <?php echo $this->Html->link('Subir Archivo', array('controller' => 'documentos', 'action' => 'upload_issuu', 'admin' => '0'),
                array('class' => 'btn btn-primary btn-large')); ?>
    </div>
</div>
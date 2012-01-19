<?php
    echo $this->Session->flash();
    //echo pr($documentos);
?>
<div class="dashboard">
<h1>Documentos</h1>
<?php echo $this->element('dashboard_menu'); ?>

<table>
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
                    <?php echo $this->Form->postLink('Observaciones',
                        array('action' => 'delete', 'admin' => 0, $documento['id']),
                        array('confirm' => '¿Está seguro?'));
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
    <?php endforeach; ?>
</table>
<div class="actions">
    <?php echo $this->Html->link('Subir Archivo', array('controller' => 'documentos', 'action' => 'upload', 'admin' => '0'),
            array('class' => 'btn primary')); ?>
</div>
</div>
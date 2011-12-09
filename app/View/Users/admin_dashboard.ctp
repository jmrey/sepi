<div class="form">
    <h1>Dashboard</h1>
    <ul class="tabs" data-tabs="tabs">
        <li class="active"><a href="#inicio">Inicio</a></li>
        <li><a href="#becas">Becas</a></li>
        <li><a href="#documentos">Documentos</a></li>
        <li><a href="#programas">Programas</a></li>
    </ul>

    <div class="pill-content">
        <div class="active" id="inicio">...</div>
        <div id="becas">
            <div>
                <div class="actions">
                    <?php echo $this->Form->postLink('Enviar',
                        array('controller' => 'users' ,'action' => 'admin_send', $user['id']),
                        array('confirm' => 'Are you sure?'));
                    ?>
                </div>
            </div>
      </div>
      <div id="documentos">...</div>
      <div id="programas">...</div>
    </div>
</div>
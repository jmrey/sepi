<div class="ipn-header">
    <div class="left">
        <?php echo $this->Html->image('logo-IPN.png', array('alt' => 'Instituto Politecnico Nacional','class' => 'left', 'height' => '80')); ?>
        <h2>Instituto Polit&eacute;cnico Nacional</h2>
        <span>"La Técnica al Servicio de la Patria"</span>
    </div>
    <div class="right">
        <?php echo $this->Html->image('escom.png', array('alt' => 'Escuela Superior de Cómputo', 'class' => 'right' ,'width' => '80')); ?>
        <h4>Secretaria de Investigaci&oacute;n y Posgrado</h4>
        <h3>Secci&oacute;n de Estudios de Posgrado e Investigaci&oacute;n</h3>
    </div>
    <div class="clear"><br /></div>
</div>
<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
    <h1>Bienvenidos</h1>
    <p>Les damos la más cordial bienvenida a la Sección de Estudios de Posgrado e Investigación (SEPI) de la Escuela Superior de Cómputo (ESCOM) que acorde a la tradición del Instituto Politécnico Nacional de ser una Institución rectora de la educación tecnológica pública en México y líder en la generación, aplicación, difusión y la transferencia de conocimiento científico y tecnológico; propone como parte de su crecimiento natural en el año 2009 la Maestría en Ciencias en Sistemas  computacionales Móviles, con el objetivo de formar personal altamente calificado y competitivo a nivel internacional, que contribuya a generar, innovar y aplicar la computación móvil en la resolución de las diferentes necesidades del país.</p>
    <p><?php echo $this->Html->link('Leer más »', '/acerca', array('class' => 'btn btn-primary btn-large')); ?>
</div>
<div class="row-fluid">
    <div class="span4">
        <?php foreach ($convocatorias as $c):
            $convocatoria = $c['Contenido'] ?>
            <div>
                <h3><?php echo $convocatoria['title']; ?></h3>
                <div class="convocatoria" id="<?php echo $convocatoria['name'];?>">
                    <?php echo $convocatoria['content']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="span4">
        <h2>Titulo 2</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn" href="#">View details &raquo;</a></p>
    </div>
</div>

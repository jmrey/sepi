<?php
    echo $this->Html->para(null, "Av. Juan de Dios Bátiz S/N. Casi esquina Miguel Othón de Mendizábal, 
        Unidad Profesional, Adolfo López Mateos. Colonia, Lindavista; Código Postal, 07738
        Delegación Gustavo A. Madero; México, D.F. Teléfono: 57-29-60-00 Extensión: 52028");

    echo $this->Html->link(
        $this->Html->image('cake.power.gif', array('alt'=> 'CakePHP', 'border' => '0')),
        'http://www.cakephp.org/',
        array('target' => '_blank', 'escape' => false)
    );
?>

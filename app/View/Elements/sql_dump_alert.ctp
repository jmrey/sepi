<?php 
$sql_dump = $this->element('sql_dump');
if($sql_dump):
?>
    <div class="alert-message debug fade in sql_alert" data-alert="alert">
        <a class="close" href="#">×</a>
        <p><?php echo $sql_dump; ?></p>
    </div>
<?php
endif;
?>
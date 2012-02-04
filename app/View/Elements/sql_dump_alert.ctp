<?php 
$sql_dump = $this->element('sql_dump');
if($sql_dump):
?>
    <div class="alert debug fade in sql_alert">
        <a class="close" href="#" data-dismiss="alert">×</a>
        <?php echo $sql_dump; ?>
    </div>
<?php
endif;
?>
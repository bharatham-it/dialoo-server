<?php
$defargs= array('flid' => '','flname' => '', 'label' => '', 'flclass' => '', 'fields' => array()  );
$args = array_merge($defargs, $args);
extract($args);
?>
<?php foreach ($fields as $fieldname => $fieldvalue) : ?>
<div class="row <?php echo $flclass; ?>" id="<?php echo $flid; ?>" name="<?php echo $flname; ?>">
    <div class="col-md-6" >
        <label><?php echo $fieldname ?></label>
    </div>
    <div class="col-md-6">
        <label><?php echo $fieldvalue ?></label>
    </div>
</div>
<?php endforeach; ?>
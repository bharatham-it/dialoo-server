<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group form-floating-label">
    <input type="file" class="form-control input-border-bottom <?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php echo $required; ?>>
    <label class="placeholder" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
</div>
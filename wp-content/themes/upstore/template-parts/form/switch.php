<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group form-floating-label">
  <div class="form-check form-switch">
    <input class="shadow form-check-input m-1 <?php echo $class; ?>" type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php echo $required; ?>>
    <label class="placeholder form-check-label" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
  </div>
</div>
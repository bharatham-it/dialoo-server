<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => '', 'value' => '','type' => '' );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group form-floating-label">
    <input type="<?php echo $type ?>" class="form-control form-control-plaintext input-border-bottom <?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php echo $required; ?> value="<?php echo $value ?>" >
    <label class="placeholder" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
</div>
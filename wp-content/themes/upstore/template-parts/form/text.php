<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => '', 'value' => '','datainvalidmessage' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group form-floating-label">
    <input autocomplete="off" type="text" class="form-control form-control-plaintext input-border-bottom <?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php echo $required; ?> value="<?php echo $value ?>" data-invalidmessage ="<?php echo $datainvalidmessage; ?>" >
    <label class="placeholder" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
</div>
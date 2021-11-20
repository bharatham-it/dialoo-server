<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '','class' => '', 'value' => '','datainvalidmessage' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group ">
    <label class="" style="font-weight:500" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
    <input autocomplete="off" type="text" class="form-control form-control-plaintext input-border-bottom <?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php echo $required; ?> value="<?php echo $value ?>" data-invalidmessage ="<?php echo $datainvalidmessage; ?>" disabled >
    
</div>
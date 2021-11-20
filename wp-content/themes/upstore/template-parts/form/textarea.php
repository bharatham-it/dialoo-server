<?php
$defargs= array('id' => '','name' => '', 'label' => '','text'=>'', 'required' => '', 'class' => '', 'value' => '','datainvalidmessage' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group form-floating-label">
    <textarea  autocomplete="off"  class="form-control form-control-plaintext input-border-bottom <?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php echo $required; ?> data-invalidmessage ="<?php echo $datainvalidmessage; ?>" ><?php echo $value;?></textarea>
    <label class="placeholder" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
</div>
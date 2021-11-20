<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => '', 'value' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<input type="hidden" class="<?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" >
<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'class' => '', 'value' => '','datainvalidmessage' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="alert alert-primary" role="alert">
  Not found any Farms. 
  Create New Farm <a href="#" class="alert-link">an example link</a>.
</div>
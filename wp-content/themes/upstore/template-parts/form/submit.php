<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => ''  );
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group form-floating-label text-center">
    <input type="submit" class="shadow  btn btn-primary btn-rounded btn-sm d-inline <?php echo $class; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $label; ?>">
    <div class="progress m-5 my-1 d-none">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
    </div>
</div>
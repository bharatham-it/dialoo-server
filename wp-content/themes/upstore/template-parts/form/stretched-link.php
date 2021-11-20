<?php
$defargs = array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => ''  );
$defargs = array_merge($defargs, array('aid' => '', 'aname' => '', 'alabel' => '','aclass' => '','alink' => '', 'dclass' =>'', 'lclass' => '' ));
$args = array_merge($defargs, $args);
extract($args);
?>
<div class="form-group form-floating-label d-inline  text-center <?php echo $dclass; ?>">
    <h5 class="mt-0 d-inline <?php echo $lclass; ?>"><?php echo $label; ?></h5>
    <a class="shadow-sm stretched-link d-inline <?php echo $aclass; ?>" href="<?php echo $alink; ?>" id="<?php echo $aid; ?>" name="<?php echo $aname; ?>"><?php echo $alabel; ?></a>
</div>
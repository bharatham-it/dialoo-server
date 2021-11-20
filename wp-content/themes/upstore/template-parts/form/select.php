<?php
$defargs= array('id' => '','name' => '', 'label' => '', 'required' => '', 'class' => ''  );
$defargs = array_merge($defargs, array('multiple' => '','default' => '', 'items' => '', 'sid' => '','alink' => '' ));
$args = array_merge($defargs, $args);
extract($args);
$selected = '';
?>
<div class="form-floating">
    <select class="form-select form-select-sm my-3 <?php echo $class; ?>" aria-label=".form-select-sm" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php echo $multiple; ?> >
        <?php if(!empty($default)) : ?> <option selected><?php echo $default; ?></option> <?php endif; ?>
        <?php
        foreach ($items as $pkey => $pvalue) :
            if ($sid == $pkey) {
                $selected = 'selected';
            }
            echo '<option value="' . $pkey . '" ' . $selected . '>' . $pvalue . '</option>';
            $selected = '';
        endforeach;
        ?>
    </select>
    <label class="placeholder" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
</div>
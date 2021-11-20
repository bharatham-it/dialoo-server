<!-- Standard fields -->
<?php echo $args['id']; ?>
<?php echo $args['name']; ?>
<?php echo $args['label']; ?>
<?php echo $args['class']; ?>
<?php echo strtolower($args['name']); ?>

<!-- Vaildation fields -->
<?php echo $args['required']; ?>

<!-- Anchor fields -->
<?php echo $args['aid']; ?>
<?php echo $args['aname']; ?>
<?php echo $args['alabel']; ?>
<?php echo $args['alink']; ?>

<!-- Select fields -->
<?php echo $args['default']; ?>
<?php echo $args['items']; ?>
<?php echo $args['sid']; ?>
<?php
/**
 * <?php echo $class; ?>" 
 * id="<?php echo $id; ?>" name="<?php echo $name; ?>" 
 * <label class="placeholder" for="<?php echo strtolower($name); ?>" ><?php echo $label; ?></label>
 * 
 */
?>


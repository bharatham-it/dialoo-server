<?php
/**
* The template for displaying the login
*
* Template Name: Cusomer-Home Template
*
* @package WordPress
* @subpackage Poultry
* @since Poultry 1.0
*/
?>
<?php
authorization_check( true );
authorization_user( array('integrator','supervisor','farmer') );
get_header();
?>
<?php
	$category = get_child_of('shop_categories', 23, array('fields' => 'id=>name'));
	$cat_image = get_field('category_image',25);
	$term = get_queried_object();
	
?>

<form id="batch-request" data-form="ajaxform" action="<?php echo $action; ?>" method="post"  class="validate">
	<div class='card'>
		<div class=' wrapper'>
			<div class='shadow container animated fadeIn card-body'>
			<!-- 	<h3 class='text-center card-title'>Batch Request - <?php echo $name; ?></h3> -->


				
				<?php
				$args = array('id' => 'status', 'name' => 'status', 'value' => 'publish');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'type', 'name' => 'type', 'value' => 'batch');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'id', 'name' => 'id', 'value' =>'');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				//$args = array('id' => 'agree', 'name' => 'agree', 'label' => 'I Agree the terms and conditions.', 'required' => 'required');
				//echo get_template_part('template-parts/form/switch', '', $args);
				?>
				<?php
				//$args = array('id' => 'submit', 'name' => 'submit', 'label' => 'Submit', 'required' => '');
				//echo get_template_part('template-parts/form/submit', '', $args);
				?>
			</div>
		</div>
	</div>
</form>
<?php
get_footer();
?>
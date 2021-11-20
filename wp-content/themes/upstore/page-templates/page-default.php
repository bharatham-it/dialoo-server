<?php
/**
* The template for displaying the login
*
* Template Name: Add-Default Template
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
$name = $action = $fdid = "";
if (isset($_REQUEST['fdid'])) {
	$fdid = $_REQUEST['fdid'];
}
if (empty($fdid)) {
	$action = "submit_function_add_batch";
}else {
	$action = "submit_function_update_batch";
}
?>

<form id="batch-request" data-form="ajaxform" action="<?php echo $action; ?>" method="post"  class="validate">
	<div class='card'>
		<div class=' wrapper'>
			<div class='shadow container animated fadeIn card-body'>
				<h3 class='text-center card-title'>Batch Request - <?php echo $name; ?></h3>


				
				<?php
				$args = array('id' => 'status', 'name' => 'status', 'value' => 'publish');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'type', 'name' => 'type', 'value' => 'batch');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'id', 'name' => 'id', 'value' => $bid);
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'agree', 'name' => 'agree', 'label' => 'I Agree the terms and conditions.', 'required' => 'required');
				echo get_template_part('template-parts/form/switch', '', $args);
				?>
				<?php
				$args = array('id' => 'submit', 'name' => 'submit', 'label' => 'Submit', 'required' => '');
				echo get_template_part('template-parts/form/submit', '', $args);
				?>
			</div>
		</div>
	</div>
</form>
<?php
get_footer();
?>
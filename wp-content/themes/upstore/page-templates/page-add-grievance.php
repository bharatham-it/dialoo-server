<?php
/**
* The template for displaying the login
*
* Template Name: Add Grievance Template
*
* @package WordPress
* @subpackage Poultry
* @since Poultry 1.0
*/
?>
<?php
authorization_check( true );
authorization_user( array('shop','customer') );
get_header();
?>
<?php
$name = $action = $fdid = $bid =$district_id =$address =$town_name = $pincode =   "";
$name='test_grievance';
if (isset($_REQUEST['id'])) {
	$fdid = $_REQUEST['id'];
}


if (empty($fdid)) { 
	$action = "submit_function_add_grievance";
}else {
	$action = "submit_function_update_grievance";
}
?>
<form id="add-grievance" data-form="ajaxform" action="<?php echo $action; ?>" method="post"  class="validate">
	<div class='card'>
		<div class=' wrapper'>
			<div class='shadow container animated fadeIn card-body'>
				<h3 class='text-center card-title'>Add Grievance <?php //echo $name; ?></h3>

					<?php
					$args = array('id' => 'title', 'name' => 'title', 'label' => 'Subject', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
					echo get_template_part('template-parts/form/text', '', $args);
					?>

					<?php
					$args = array('id' => 'content', 'name' => 'content', 'label' => 'Message', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
					echo get_template_part('template-parts/form/textarea', '', $args);
					?>

                    <?php
					$args = array('id' => 'type', 'name' => 'type', 'value' => 'message');
					echo get_template_part('template-parts/form/hidden', '', $args);
					?>
				  	<?php
					$args = array('id' => 'status', 'name' => 'status', 'value' => 'publish');
					echo get_template_part('template-parts/form/hidden', '', $args);
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
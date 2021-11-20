<?php

/**
 * The template for displaying the login
 *
 * Template Name: registration Template
 *
 * @package WordPress
 * @subpackage Poultry
 * @since Poultry 1.0
 */
?>
<?php
/* authorization_check(true);
authorization_user(array('customer', 'shop', 'farmer')); */
get_header();
?>
<?php
$name = $action = $fdid = $bid = $district_id = $address = $town_name = $pincode =   "";


 if (isset($_REQUEST['scode'])) {
	$scode = $_REQUEST['scode'];
}
else if(isset($_REQUEST['id'])){
	$user_id=$_REQUEST['id'];
}

if (!empty($scode)) {	
	$user_id = get_user_id_by_sponser_code($scode);
	print_r($user_id);
	$user_data = get_userdata($user_id);
	print_r($user_data);

$action = "submit_function_customer_registration";
}
else if(!empty($user_id)){

$action="submit_function_update_customer_registration";
}
?>
<form id="customer-registration" enctype="multipart/form-data" data-form="ajaxform" action="<?php echo $action; ?>" method="post" class="validate">
	<div class='card'>
		<div class=' wrapper'>
			<div class='shadow container animated fadeIn card-body'>
				<h3 class='text-center card-title'>Register Yourself - <?php echo $name; ?></h3>

				<?php
				$args = array('id' => 'profile_pic', 'name' => 'profile_pic', 'label' => 'Upload Profile Picture', 'required' => '');
				echo get_template_part('template-parts/form/file', '', $args);
				?>
				
				<?php
				$args = array('id' => 'sponser_id_display', 'name' => 'sponser_id_display', 'label' => 'Sponser code', 'required' => 'required','class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' =>$scode);
				echo get_template_part('template-parts/form/disabled-text', '', $args);
				?>
				<?php
				$args = array('id' => 'sponser_name', 'name' => 'sponser_name','label' => 'Sponser name', 'required' => 'required','class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $user_data->display_name);
				echo get_template_part('template-parts/form/disabled-text', '', $args);
				?>
			 <!-- <?php
						$args = array('id' => 'country', 'name' => 'country', 'label' => 'Select Country', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
						echo get_template_part('template-parts/form/select', '', $args);
						?>  -->
				<!--  <?php
						$args = array('id' => 'state', 'name' => 'state', 'label' => 'State/Provience', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
						echo get_template_part('template-parts/form/select', '', $args);
						?> -->
				<?php
				$args = array('id' => 'mobile', 'name' => 'mobile', 'label' => 'Mobile Number', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'alt_mobile', 'name' => 'alt_mobile', 'label' => 'Alternative Mobile Number', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'display_name', 'name' => 'display_name', 'label' => 'Name', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'user_email', 'name' => 'user_email', 'label' => 'Email ID', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/email', '', $args);
				?>
				<?php
				$args = array('address' => $address, 'town_name' => $town_name, 'pincode' => $pincode, 'district_id' => $district_id);
				echo get_template_part('template-parts/form/location', '', $args);
				?>
				<?php
				$args = array('id' => 'street_name', 'name' => 'street_name', 'label' => 'Street Name', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'postoffice', 'name' => 'postoffice', 'label' => 'Postoffice', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'landmark', 'name' => 'landmark', 'label' => 'Landmark', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				
				<h3 class='text-center card-title'>Login Details - <?php echo $name; ?></h3>

				<?php
				$args = array('id' => 'user_login', 'name' => 'user_login', 'label' => 'User Name', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'user_pass', 'name' => 'user_pass', 'label' => 'Password', 'value' => $name);
				echo get_template_part('template-parts/form/password', '', $args);
				?>
				<?php
				$args = array('id' => 'id', 'name' => 'id', 'value' => $bid);
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'custom_status', 'name' => 'custom_status', 'value' => 202);
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'role', 'name' => 'role', 'value' => 'customer');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'sponser_code', 'name' => 'sponser_code', 'value' => $scode);
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
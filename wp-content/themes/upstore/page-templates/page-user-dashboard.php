<?php

/**
 * The template for displaying the login
 *
 * Template Name: User-Dashboard Template
 *
 * @package WordPress
 * @subpackage Poultry
 * @since Poultry 1.0
 */
?>
<?php
authorization_check(true);
authorization_user(array('customer','shop'));
get_header();
?>
<?php
$name = $action = $fdid = "";
if (isset($_REQUEST['fdid'])) {
	$fdid = $_REQUEST['fdid'];
}
if (empty($fdid)) {
	$action = "submit_function_add_batch";
} else {
	$action = "submit_function_update_batch";
}
$user_data = wp_get_current_user();
$u_role=$user_data->roles[0];
if($u_role=='customer')
{
	$user_add_data = get_custom_single_row($wpdb->prefix . 'user_data', 'ID=' . $user_data->ID);
}
else if($u_role=='shop')
{
	$user_add_data = get_custom_single_row($wpdb->prefix . 'shops', 'owner_id=' . $user_data->ID);
}

$sponser_code = $user_add_data->sponser_code;
$res=get_post_thumbnail_id($user_add_data->shop_id);
print_r($res);
/* print_r($user_add_data->address); */

?>



<div class="container pt-3">
	<div class="row">
		<div class="col-md-4 mx-auto">
			<div class="card card-profile">
				<div class="card-header bg-secondary">
					<div class="profile-picture">
						<div class="avatar avatar-xl">

							<img src="<?php echo get_image_src($user_add_data->profile_pic) ?>" alt="..." class="avatar-img rounded-circle">
						</div>
					</div>
				</div>
			
				<div class="card-body">
				
					<div class="user-profile text-center">
						<div class="name"><?php echo $user_data->display_name ?></div>
						<div class="job">User Name: <?php echo $user_data->display_name ?> </div>
						<div class="desc"><?php echo $user_data->user_email ?></div>
						<input type="text" class="form-control" value="<?php echo get_site_url().'/registration/?scode='.$user_add_data->sponser_code?>" id="name" >
						
					
						
						<!-- <div class="social-media">
							<a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
								<span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
							</a>
							<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
								<span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span>
							</a>
							<a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
								<span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
							</a>
							<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
								<span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
							</a>
						</div> -->
						<div class="view-profile pt-2">
							<a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row user-stats text-center">
						<div class="col">
							<div class="number"><i class="fas fa-qrcode fa-2x"></i></div>
							<div class="title"><a onclick="open_qr_function('<?php echo $sponser_code;?>')">View QR</a></div>
						</div>
						<div class="col">
							<div class="number"><i class="fas fa-print fa-2x"></i></div>
							<div class="title">Print</div>
						</div>
						<!-- 	<div class="col">
											<div class="number">134</div>
											<div class="title">Following</div>
										</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<div id="qrcode"></div>
<div class="container pb-5">
	<div class="row">
		<div class="col-md-4 mx-auto">
			<div class="card card-dark bg-secondary-gradient">
				<div class="card-body bubble-shadow">
					<img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.jpeg" width="80px" alt="Upstore Logo">
					<h2 class="py-4 mb-0">Upstore ID : <?php echo $user_add_data->sponser_code ?></h2>
					<div class="row">
						<div class="col-8 pr-0">
							<h3 class="fw-bold mb-1"><?php echo $user_add_data->display_name ?></h3>
							<div class="text-small text-uppercase fw-bold op-8"><?php echo $user_add_data->address ?></div>
							<div class="text-small text-uppercase fw-bold op-8"><?php echo $user_add_data->town_name ?></div>
							<div class="text-small text-uppercase fw-bold op-8"><?php echo $user_add_data->street_name ?></div>
							<div class="text-small text-uppercase fw-bold op-8"><?php echo $user_add_data->pincode ?></div>
						</div>
						<div class="col-4 pl-0 text-right">
							<h3 class="fw-bold mb-1">4/26</h3>
							<div class="text-small text-uppercase fw-bold op-8">Expired</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>


<?php
get_footer();
?>
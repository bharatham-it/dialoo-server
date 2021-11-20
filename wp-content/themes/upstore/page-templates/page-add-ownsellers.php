<?php
/**
* The template for displaying the login
*
* Template Name: add ownseller Template
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
$name = $action = $fdid = $bid =$district_id =$address =$town_name = $pincode = $category_id  ="";
$name='test_ownseller';
if (isset($_REQUEST['id'])) {
	$fdid = $_REQUEST['id'];
}
if (empty($fdid)) {
	$action = "submit_function_add_ownsellers";
}else {
	$action = "submit_function_update_ownsellers";
}
$category = get_child_of('own-seller_categories', 49, array('fields' => 'id=>name'));
?>
<form id="add-ownsellers" data-form="ajaxform" action="<?php echo $action; ?>" method="post"  class="validate">
<div class='card h-100'>
		<div class='wrapper'>
			<div class='shadow container animated fadeIn card-body'>
				<h3 class='text-center card-title'>Add Ownsellers <?php //echo $name; 
																?></h3>
				<?php
				$args = array('id' => 'profile_pic', 'name' => 'profile_pic', 'label' => 'Upload Profile Picture', 'required' => '');
				echo get_template_part('template-parts/form/file', '', $args);
				?>												
				<?php
				$args = array('id' => 'title', 'name' => 'title', 'label' => 'Name', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'ownseller_email', 'name' => 'ownseller_email', 'label' => 'Email ID', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/email', '', $args);
				?>
				<?php
				$args = array('id' => 'ownseller_mobile', 'name' => 'ownseller_mobile', 'label' => 'Mobile No', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'ownseller_alt_mobile', 'name' => 'ownseller_alt_mobile', 'label' => 'Alternative Mobile Number', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
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
				$args = array('id' => 'landmark', 'name' => 'landmark', 'label' => 'Landmark', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'user_login', 'name' => 'user_login', 'label' => 'Username', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/text', '', $args);
				?>
				<?php
				$args = array('id' => 'user_pass', 'name' => 'user_pass', 'label' => 'User password', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
				echo get_template_part('template-parts/form/password', '', $args);
				?>
				<!-- item category-->
				<!-- <?php
						$category = get_child_of('own-seller_categories', 49, array('fields' => 'id=>name'));
						$args = array('id' => 'own-seller_category_id', 'name' => "category_percentage[category][]", 'label' => 'Own-Seller Category', 'required' => 'required', 'items' => $category, 'sid' => $category_id, 'default' => 'Select Category');
						echo get_template_part('template-parts/form/select', '', $args);
						?> -->
				<div class="input-field">
					<table class="table table-borderd" id="table-weight">
						<tr>
							<th>Category</th>
							<th>Percentage</th>
						</tr>
						<tr>
							<td style="width:100%;">

								<?php
								$category = get_child_of('own-seller_categories', 49, array('fields' => 'id=>name'));
								$args = array('id' => 'own-seller_category_id', 'name' => "category_percentage[category][]", 'label' => 'Own Seller Category', 'required' => 'required', 'items' => $category, 'sid' => $category_id, 'default' => 'Select Category');
								echo get_template_part('template-parts/form/select', '', $args);
								?>

							</td>
							<td>
								<input type="text" name="category_percentage[percentage][]" class="form-control" />
							</td>
							<td>
								<button type="button" id="add" name="add" value="add" class="btn btn-success" />+</button>
							</td>
						</tr>
					</table>
				</div>
				<?php
				$args = array('id' => 'type', 'name' => 'type', 'value' => 'ownseller');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
                <?php
				$args = array('id' => 'rating', 'name' => 'rating', 'value' => '5');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'status', 'name' => 'status', 'value' => 'publish');
				echo get_template_part('template-parts/form/hidden', '', $args);
				?>
				<?php
				$args = array('id' => 'role', 'name' => 'role', 'value' => 'ownseller');
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
<?php
/**
* The template for displaying the login
*
* Template Name: Add-Item Template
*
* @package WordPress
* @subpackage Poultry
* @since Poultry 1.0
*/
?>
<?php
authorization_check( true );
authorization_user( array('shop','farmer') );
get_header();
?>
<?php
$name = $action = $fdid = $bid =$district_id =$address =$town_name = $pincode =   "";
$name='test_item';
if (isset($_REQUEST['id'])) {
	$fdid = $_REQUEST['id'];
}


if (empty($fdid)) { 
	$action = "submit_function_add_items";
}else {
	$action = "submit_function_update_add_items";
}
?>
<form id="add-items" data-form="ajaxform" action="<?php echo $action; ?>" method="post"  class="validate">
	<div class='card'>
		<div class=' wrapper'>
			<div class='shadow container animated fadeIn card-body'>
				<h3 class='text-center card-title'>Add Items <?php //echo $name; ?></h3>

              
					
					<?php
					$args = array('id' => 'title', 'name' => 'title', 'label' => 'Name', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
					echo get_template_part('template-parts/form/text', '', $args);
					?>

					<?php
					$args = array('id' => 'item_price', 'name' => 'item_price', 'label' => 'Price', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
					echo get_template_part('template-parts/form/text', '', $args);
					?>

					<?php
					$args = array('id' => 'item_hsncode', 'name' => 'item_hsncode', 'label' => 'HSN Code', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => $name);
					echo get_template_part('template-parts/form/text', '', $args);
					?>

                    <?php
					$args = array('id' => 'type', 'name' => 'type', 'value' => 'item');
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
					<input type="file" id="image_upload">

				<?php	print_r(get_the_post_thumbnail_url(105)); ?>
		<!-- 				<button id="btnadd" type="button">Add</button> -->
			</div>
		</div>
	</div>
</form>
<?php
get_footer();
?>
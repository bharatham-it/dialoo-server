<?php
/**
* The template for displaying the login
*
* Template Name: add-purchase Template
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
$name = $action = $fdid = $bid =$district_id =$address =$town_name = $pincode = $category_id=$user_id="";
$name='test';
if (isset($_REQUEST['id'])) {
	$fdid = $_REQUEST['id'];
}
if (empty($fdid)) { 
	$action = "submit_function_add_purchases";
 }else {
	$action = "submit_function_update_add_purchases";
}

//print_r($shop_det);
?>
<form id="add-purchase" data-form="ajaxform" action="<?php echo $action; ?>" method="post"  class="validate">
	<div class='card'>
		<div class=' wrapper'>
			<div class='shadow container animated fadeIn card-body'>
				<h3 class='text-center card-title'>Add Shops <?php //echo $name; ?></h3>


					<?php
    				$args= build_posts_args('shop',-1,'publish');

					$shop_det= get_shops_for_select($args);
    				$args= array('id' => 'shop_id','name' => 'shop_id', 'label' => 'Shop ', 'required' => 'required', 'items' =>$shop_det,'sid'=>$category_id, 'default'=> 'Select Shop' );
    				echo get_template_part( 'template-parts/form/select', '', $args);
					?>
					 <div class="input-field">
                    <table class="table table-borderd" id="table-weight">
                      <tr>
                        <th>Category</th>
                        <th>Percentage</th>
                      </tr>
                      <tr>
                        <td style="width:100%;">

                         <select class="form-control category_all_class" name="category_percentage['category'][]">
                            
                         </select>

                        </td>
                        <td>
                          <input
                            type="text"
                            name="category_percentage['percentage'][]"
                            class="form-control"
                          />
                        </td>
                        <td>
                          <input
                            type="submit"
                            id="add"
                            name="add"
                            value="add"
                            class="btn btn-success"
                          />
                        </td>
                      </tr>
                    </table>
                  </div>

              
					<?php
    				$category = get_child_of('shop_categories', 23, array('fields' => 'id=>name'));
    				$args= array('id' => 'shop_category_id','name' => 'shop_category_id', 'label' => 'Shop Category', 'required' => 'required', 'items' =>$category,'sid'=>$category_id, 'default'=> 'Select Category' );
    				echo get_template_part( 'template-parts/form/select', '', $args);
					?>
					
					<?php
					$args = array('id' => 'pay_amount', 'name' => 'pay_amount', 'label' => 'Payment Amount', 'required' => 'required', 'class' => 'obg', 'datainvalidmessage' => "Please select this field", 'value' => '');
					echo get_template_part('template-parts/form/text', '', $args);
					?>
                    <?php
					$args = array('id' => 'type', 'name' => 'type', 'value' => 'purchase');
					echo get_template_part('template-parts/form/hidden', '', $args);
					?>
				  	<?php
					$args = array('id' => 'status', 'name' => 'status', 'value' => 'publish');
					echo get_template_part('template-parts/form/hidden', '', $args);
					?>
					 <input name="category_data['id'][]" >
                  <input name="category_data['percentage'][]"><br>
                  <input name="category_data['id'][]">
                  <input name="category_data['percentage'][]"><br>
                  <input name="category_data['id'][]">
                  <input name="category_data['percentage'][]">
                
                
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
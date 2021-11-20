<?php

/**
 * The template for displaying the login
 *
 * Template Name: User Summary Template
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


?>
<form id="customer-registration" enctype="multipart/form-data" data-form="ajaxform" action="<?php echo $action; ?>" method="post" class="validate">
	<div class='card'>
		<div class=' wrapper'>
			<div class='shadow container animated fadeIn card-body'>
				<h3 class='text-center card-title'>Shop Summary</h3>
        
				<?php $detail_array= get_the_shop_summary(239,'shop');
                
                var_dump($detail_array);
                foreach($detail_array as $key=>$value)
                {
                    echo $key."-".$value;
                    echo "<hr>";
                }
                ?>
			</div>
		</div>
	</div>
</form>
<?php
get_footer();
?>
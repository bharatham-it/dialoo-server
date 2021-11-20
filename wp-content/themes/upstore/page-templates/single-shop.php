<?php

/**
 * The template for displaying the Farms
 *
 * Template Name: Shops Template
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
if(isset($_REQUEST['id']))
{
$shop_id=$_REQUEST['id'];
}

global $post;
$fid = $post->ID;
$shop = get_post($fid);
$name = $shop->post_title;
$custom_data = (array)get_custom_single_row($wpdb->prefix . 'shops', ' shop_id = ' . $shop_id);
?>
<div class="container-fluid">
    <div class="row">
    <?php
    $args = array('cid'=>$shop_id,'name' => $shop->post_title, 'label' => $shop->post_content, 'post_type' => $shop->post_type, 'fields' => $custom_data);
    echo get_template_part('template-parts/shops/one-shop', '', $args);
    ?>
    </div>
</div>
<?php
  get_footer();
?>
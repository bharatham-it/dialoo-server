<?php

/**
 * The template for displaying the Farms
 *
 * Template Name: Services-List Template
 *
 * @package WordPress
 * @subpackage Poultry
 * @since Poultry 1.0
 */
?>

<?php
authorization_check( true );
authorization_user( array() );
get_header();
?>
<?php
$args = array(
  'numberposts' => 10,
  'post_type'   => 'service'
);

$shops = get_posts($args);
$custom_shop_data = get_all_custom_table($wpdb->prefix.'services');
  

?>
<div class="container-fluid">
    <div class="row">
    <?php
    if($custom_shop_data)
    {
      foreach ($shops as $shop) :
        $args = array('cid'=>$shop->ID,'name' => $shop->post_title, 'label' => '', 'type' => 'service');
        echo get_template_part('template-parts/shops/card-shop', '', $args);
      endforeach; 
    }
    else
    {
      echo"No Shops Available";
    }
    ?>
    </div>
</div>


<?php
  get_footer();
?>
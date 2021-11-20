<?php

/**
 * The template for displaying the Farms
 *
 * Template Name: User-List Template
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

$users = remove_administrator(get_users());
$custom_user_data = get_all_custom_table($wpdb->prefix.'user_data');


?>
<div class="container-fluid">
    <div class="row">
    <?php
    if($custom_user_data)
    {
      foreach ($users as $user) :
        $args = array('cid'=>$user->ID,'name' => $user->display_name, 'label' => '', 'post_type' => '');
        echo get_template_part('template-parts/card-view/card-user', '', $args);
      endforeach; 
    }
    else
    {
      echo"No Users Available";
    }
    ?>
    </div>
</div>


<?php
  get_footer();
?>
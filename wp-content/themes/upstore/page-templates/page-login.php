<?php
/**
* The template for displaying the login
*
* Template Name: Login Template
*
* @package WordPress
* @subpackage Poultry
* @since Poultry 1.0
*/
?>
<?php
get_header();
?>
<div class = 'login card'>
<div class = ' wrapper wrapper-login '>
<div class = 'shadow container container-login animated fadeIn card-body'>
<h3 class = 'text-center card-title'>Login Yourself</h3>
<?php
echo get_template_part( 'template-parts/user/sign-in', '', array() );
?>
</div>
<div class = 'shadow container container-signup animated fadeIn card-body'>
<h3 class = 'text-center card-title'>Register Yourself</h3>
<?php
echo get_template_part( 'template-parts/user/sign-up', '', array() );
?>
</div>
</div>
</div>
<script src="<?php echo get_template_directory_uri();?>/assets/js/user.js"></script>
<?php
get_footer();
?>

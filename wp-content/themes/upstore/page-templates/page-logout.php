<?php
/**
* The template for displaying the login
*
* Template Name: Logout Template
*
* @package WordPress
* @subpackage Poultry
* @since Poultry 1.0
*/
?>
<?php
get_header();
?>
<?php

wp_destroy_current_session();
wp_clear_auth_cookie();
wp_set_current_user( 0 );
wp_redirect(home_url(). '/login/');

?>
<?php
get_footer();
?>
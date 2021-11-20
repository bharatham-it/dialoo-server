<?php

/**
 * The template for displaying the login
 *
 * Template Name: Test Template
 *
 * @package WordPress
 * @subpackage Poultry
 * @since Poultry 1.0
 */
?>

<?php
/*  welcome_email('manish.bharathamitsolutions@gmail.com','Manish Mohan'); */
$shop_data = get_custom_table('us_shops','shop_id !=""');
echo json_encode($shop_data);


?>

<?php
/**
 * Used to set up and fix common variables and include
 * the WordPress procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see default-constants.php)
 *
 * @package WordPress
 */
/**
 * Stores the location of the WordPress directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
$includefiles = glob(TEMPLATEDIR . '/includes/*.php');
foreach($includefiles as $file){
    require_once $file; 
}

add_filter( 'single_template', 'get_custom_post_type_template' );
function get_custom_post_type_template( $single_template ) {
    global $post;
    $single_post_template = TEMPLATEDIR . '/page-templates/' . 'single-'.$post->post_type.'.php';
    if (file_exists( $single_post_template ) ) {
        return $single_post_template;
    } 
    return $single_template;
}

// add_filter( 'single_template', 'add_postType_slug_template', 10, 1 );
 
// function add_posttype_slug_template( $single_template ) {
//     $object  = get_queried_object();
//     $single_posttype_postname_template = locate_template( "single-{$object->post_type}-{$object->post_name}.php" );
 
//     if ( file_exists( $single_posttype_postname_template ) ) {
//         return $single_posttype_postname_template;
//     } else {
//         return $single_template;
//     }
// }

/**
 * Enqueue custom scripts and styles.
 *
 * @since Poultry 1.0
 *
 * @return void
 */
function custom_theme_scripts() {
}
add_action( 'wp_enqueue_scripts', 'custom_theme_scripts' );
?>
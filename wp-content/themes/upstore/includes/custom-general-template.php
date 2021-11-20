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
function get_custom_page_template() {
    $id = get_queried_object_id();
    $template = get_page_template_slug();
    $pagename = get_query_var('pagename');
    if ( ! $pagename && $id ) {
        // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
        $post = get_queried_object();
        if ( $post )
            $pagename = $post->post_name;
    }
    $templates = array();
    if ( $template && 0 === validate_file( $template ) )
        $templates[] = $template;
    // if there's a custom template then still give that priority
    if ( $pagename ){
        $templates[] = "page-templates/page-$pagename.php";
        $templates[] = "page-templates/template-$pagename.php";
    }
    // change the default search for the page-$slug template to use our directory
    // you could also look in the theme root directory either before or after this
    if ( $id ){
        $templates[] = "page-templates/page-$id.php";
        $templates[] = "page-templates/template-$id.php";
    }
    $templates[] = 'page.php';
    /* Don't call get_query_template again!!!
       // return get_query_template( 'page', $templates );
       We also reproduce the key code of get_query_template() - we don't want to call it or we'll get stuck in a loop .
       We can remove lines of code that we know won't apply for pages, leaving us with...
    */
    //print_r($templates);
    $template = locate_template( $templates );
    return $template;
}
add_filter( 'page_template', 'get_custom_page_template' );
/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
* Filter function used to remove the tinymce emoji plugin.
* 
* @param array $plugins 
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce( $plugins ) {
if ( is_array( $plugins ) ) {
return array_diff( $plugins, array( 'wpemoji' ) );
} else {
return array();
}
}
/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
if ( 'dns-prefetch' == $relation_type ) {
/** This filter is documented in wp-includes/formatting.php */
$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
$urls = array_diff( $urls, array( $emoji_svg_url ) );
}
return $urls;
}

// Remove junk from head
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
function my_deregister_scripts(){
    wp_dequeue_script( 'wp-embed' );
   }
   add_action( 'wp_footer', 'my_deregister_scripts' );
if(!is_admin()){
    function custom_theme_remove_wp_block_library_css(){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    } 
    add_action( 'wp_enqueue_scripts', 'custom_theme_remove_wp_block_library_css', 100 );
}

function add_login_check()
{
    global $post;
    if ($post) {
        $page_slug = $post->post_name;
        if (is_user_logged_in() && $page_slug == 'login') {
            if (!current_user_can('administrator')) {
                wp_redirect(home_url().'/user-dashboard/');
            } else {
                wp_redirect(admin_url());
            }
            exit;
        }
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }
}
add_action('wp', 'add_login_check');

function authorization_check($authorize){
    if ($authorize && !is_user_logged_in() ) {
        wp_redirect(home_url().'/login/');
    } 
}

function authorization_user($authroles){
    $loggedinuser = get_current_user_data();
    $user_roles = $loggedinuser['roles'];
    if (!current_user_can('administrator') && !array_intersect($user_roles, $authroles) ) {
        wp_redirect(home_url().'/user-dashboard/');
    } 
}

global $pagenow;
if ($pagenow == 'wp-login.php') {
    redirect_logged_in_user();
}
function redirect_logged_in_user() 
{
    if( is_user_logged_in() ) {
        wp_redirect(home_url().'/login/');
    }
}
?>
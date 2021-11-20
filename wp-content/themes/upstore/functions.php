<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Upstore
 * @since Upstore 1.0
 */
?>
<?php
if ( ! defined( 'TEMPLATEDIRURI' ) ) {
	define( 'TEMPLATEDIRURI', get_template_directory_uri() );
}
if ( ! defined( 'STYLESHEETDIRURI' ) ) {
	define( 'STYLESHEETDIRURI', get_stylesheet_directory_uri() );
}
if ( ! defined( 'TEMPLATEDIR' ) ) {
	define( 'TEMPLATEDIR', get_template_directory() );
}
if ( ! defined( 'STYLESHEETDIR' ) ) {
	define( 'STYLESHEETDIR', get_stylesheet_directory() );
}
if ( ! function_exists( 'Upstore_setup' ) ) {
    	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Upstore 1.0
	 *
	 * @return void
	 */
	function Upstore_setup() {
        /*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );
		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
        );
        	/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support( 'post-thumbnails' );
        register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'Upstore' ),
				'secondary' => esc_html__( 'Secondary menu', 'Upstore' ),
				'loggedin' => esc_html__( 'Logged In menu', 'Upstore' ),
				'admin' => esc_html__( 'Admin menu', 'Upstore' ),
				'footer'  => __( 'Footer menu', 'Upstore' ),
			)
        );
        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);
        /**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;
		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );
		// Add support for full and wide align images.
        add_theme_support( 'align-wide' );
        // Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
        );
        		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );
		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );
		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );
		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );
    }
}
add_action( 'after_setup_theme', 'Upstore_setup' );
/**
 * Register widget area.
 *
 * @since Upstore 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function Upstore_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'Upstore_widgets_init' );
/**
 * Enqueue scripts and styles.
 *
 * @since Upstore 1.0
 *
 * @return void
 */
function Upstore_scripts() {
}
add_action( 'wp_enqueue_scripts', 'Upstore_scripts' );
/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Upstore 1.0
 *
 * @return void
 */
function Upstore_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'Upstore_add_ie_class' );

add_action('wp_head', 'ajaxurl');
function ajaxurl()
{
    echo '<script type="text/javascript">
            var ajaxurl = "' . admin_url('admin-ajax.php') . '";
          </script>';
}

/* 
    Dont delete anything on above 
    Start writing custom functions below
*/
/** Sets up theme vars and included files. */
require_once TEMPLATEDIR . '/includes/' . 'custom-settings.php';


// show wp_mail() errors
add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function onMailError( $wp_error ) {
 /*    echo "<pre>";
   // print_r($wp_error);
    echo "</pre>"; */
}

/**
 * Disable sending of the password change email
 */
add_filter( 'send_password_change_email', '__return_false' );


add_action('rest_api_init', function() {
    remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
}, 15);


function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');




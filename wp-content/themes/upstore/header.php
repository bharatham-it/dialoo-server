<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Poultry
 * @since Poultry 1.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head class="d-flex flex-column h-100">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="<?php echo TEMPLATEDIRURI; ?>/assets/css/atlantis.min.css">
	<!-- <link rel="stylesheet" href="<?php echo TEMPLATEDIRURI; ?>/assets/css/atlantis.css"> -->
	<link rel="stylesheet" href="<?php echo TEMPLATEDIRURI; ?>/style.css">
	<!-- Fonts and icons -->
	<script src="<?php echo get_template_directory_uri();?>/assets/js/webfont.min.js"></script>
	<script>
		WebFont.load({
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo get_template_directory_uri();?>/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	<nav class="navbar navbar-dark sticky-top  bg-light text-center">
	<!-- Navbar content -->
	<?php 
		$menuitems = wp_get_menu_array('Top Menu');
		foreach ($menuitems as $menuitem) {
			$args= array('aid' => strtolower($menuitem['title']),'aname' => strtolower($menuitem['title']), 'alabel' => $menuitem['title'],'label' => '', 'alink' => $menuitem['url'], 'aclass' => 'btn btn-sm btn-outline-success me-2 dropdown'  );
			echo get_template_part( 'template-parts/form/stretched', 'link', $args);
		}
		if(is_user_logged_in()){
			$args= array('aid' => 'logout','aname' => 'logout', 'alabel' => 'logout','label' => '', 'alink' => wp_logout_url(get_home_url().'/login/'), 'aclass' => 'btn btn-sm btn-outline-success me-2 dropdown'  );
			echo get_template_part( 'template-parts/form/stretched', 'link', $args);
		}

		
	?>
	</nav>
	

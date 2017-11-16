<?php

/**
	* Include external files
	*/
require_once('inc/color_themes.php');
require_once('inc/theme_settings.php');
require_once('widgets/class-wp-widget-archives.php');
require_once('widgets/class-widget-social.php');
require_once('inc/mdb_navwalker.php');
require_once('inc/mdb_pagination.php'); 
require_once('inc/hero.php');
require_once('inc/social_buttons.php');

/**
 * Include CSS/JS dependencies 
 */
function theme_enqueue_scripts() {
	wp_enqueue_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'Bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'MDB', get_template_directory_uri() . '/css/mdb.min.css' );
	wp_enqueue_style( 'Style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script( 'jQuery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', array(), '3.2.1', true );
	wp_enqueue_script( 'Tether', get_template_directory_uri() . '/js/popper.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'Bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'MDB', get_template_directory_uri() . '/js/mdb.min.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

/**
 * Setup Theme
 */
function MDB_setup() {
	// Navigation Menus
	register_nav_menus(array(
		'navbar' => __( 'Navbar Menu'),
		'footer' => __( 'Footer Menu')
	));
	// Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('main-full', 1078, 516, false); // main post image in full width
}
add_action('after_setup_theme', 'MDB_setup');

function posts_link_attributes() {
	return 'class="page-link"';
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');



/* Load custom CSS based on the selected color theme and settings */
function seabadgermd_customize_css()
{
	$colorTheme = get_theme_mod('color_theme');
	if (!colorThemeExists($colortheme)) {
		$colorTheme = 'mdb_dark';
	}
	$colorThemeConf = getColorTheme($colorTheme);
	wp_enqueue_style( 'ColorTheme_css', get_template_directory_uri() . $colorThemeConf['css'] );
	if (get_theme_mod('navbar_transparent')) {
		add_action('wp_head', 'transparent_navbar_css');
	}
}
add_action( 'wp_enqueue_scripts', 'seabadgermd_customize_css');

function transparent_navbar_css() {
?>
	<style type="text/css">
		.top-nav-collapse {
				opacity: 0.5;
		}
		.top-nav-collapse:hover {
			opacity: 1;
		}
	</style>
<?php
}

/**
 * Register sidebars and widgetized areas.
 */

function seabadgermd_widgets_init() {

	register_sidebar( array(
		'name'			=> 'Sidebar',
		'id'			=> 'sidebar',
		'description'	=> 'Main sidebar',
		'before_widget' => '<div id="%1$s" class="card widget %2$s"><div class="card-body">',
		'after_widget'	=> '</div></div>',
		'before_title'	=> '<div class="card-title widget-title themecolor">',
		'after_title'	 => '</div>',
	) );

	unregister_widget('WP_Widget_Archives');
	register_widget('WP_Widget_ArchivesMD');
	register_widget('SBMD_Widget_Social');
}

add_action( 'widgets_init', 'seabadgermd_widgets_init' );

?>

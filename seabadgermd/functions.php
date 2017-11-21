<?php

// Theme Constants
define( "SBMD_THEME_DIR", get_template_directory() );
define( "SBMD_THEME_DIR_URI", get_template_directory_uri() );
define( "SBMD_STYLESHEET_DIR", get_stylesheet_directory() );
define( "SBMD_STYLESHEET_DIR_URI", get_stylesheet_directory_uri() );
$sbmd_theme = wp_get_theme();
define( "SBMD_THEME_VERSION", $sbmd_theme->get( 'Version' ) );

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
	wp_enqueue_style( 'Bootstrap_css', SBMD_THEME_DIR_URI . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'MDB', SBMD_THEME_DIR_URI . '/css/mdb.min.css' );
	wp_enqueue_style( 'Style', SBMD_THEME_DIR_URI . '/style.css', array(), SBMD_THEME_VERSION );
	wp_enqueue_script( 'jQuery', SBMD_THEME_DIR_URI . '/js/jquery-3.2.1.min.js', array(), '3.2.1', true );
	wp_enqueue_script( 'Tether', SBMD_THEME_DIR_URI . '/js/popper.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'Bootstrap', SBMD_THEME_DIR_URI . '/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'MDB', SBMD_THEME_DIR_URI . '/js/mdb.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'SBMDJS', SBMD_THEME_DIR_URI . '/js/site.js', array(), SBMD_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

/**
 * Setup Theme
 */
function seabadgermd_setup() {
	// Add text domain
	load_theme_textdomain( 'seabadgermd', SBMD_THEME_DIR . '/languages' );
	// Navigation Menus
	register_nav_menus(array(
		'navbar' => __( 'Navbar Menu', 'seabadgermd'),
		'footer' => __( 'Footer Menu', 'seabadgermd')
	));
	// Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('main-full', 1078, 516, false); // main post image in full width
}
add_action('after_setup_theme', 'seabadgermd_setup');

function seabadgermd_posts_link_attributes() {
	return 'class="page-link"';
}

add_filter('next_posts_link_attributes', 'seabadgermd_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'seabadgermd_posts_link_attributes');



/* Load custom CSS based on the selected color theme and settings */
function seabadgermd_customize_css()
{
	$colorTheme = get_theme_mod('seabadgermd_color_theme');
	if (!seabadgermd_color_theme_exists($colorTheme)) {
		$colorTheme = 'mdb_dark';
	}
	$colorThemeConf = seabadgermd_get_color_theme($colorTheme);
	wp_enqueue_style( 'ColorTheme_css', get_template_directory_uri() . $colorThemeConf['css'] );
}
add_action( 'wp_enqueue_scripts', 'seabadgermd_customize_css');

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

function seabadgermd_post_navigation(){
	if ( "" != get_adjacent_post( false, "", false ) || "" != get_adjacent_post( false, "", true ) ):
?>
	<div class="row post-navigation">
		<div class="col-6 post-navigation-next">
<?php
	if ( "" != get_adjacent_post( false, "", false ) ):
		next_post_link( '%link', __( 'Next post', 'seabadgermd') );
	endif;
?>
		</div>
		<div class="col-6 post-navigation-prev">
<?php
	if ( "" != get_adjacent_post( false, "", true ) ):
		previous_post_link( '%link', __( 'Previous post', 'seabadgermd' ) );
	endif;
?>
		</div>
	</div>
<?php
endif;
}

/** https://justinklemm.com/add-class-to-wordpress-next_post_link-and-previous_post_link-links/ **/ 
add_filter('next_post_link', 'seabadgermd_post_navlink_attributes');
add_filter('previous_post_link', 'seabadgermd_post_navlink_attributes');

function seabadgermd_post_navlink_attributes($output) {
    $class = 'class="btn themecolor"';
    return str_replace('<a href=', '<a ' . $class . ' href=', $output);
}

?>

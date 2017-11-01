<?php

/**
  * Include external files
  */
require_once('inc/mdb_navwalker.php');

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
    'navbar' => __( 'Navbar Menu')
  ));
  // Add featured image support
  add_theme_support('post-thumbnails');
  add_image_size('main-full', 1078, 516, false); // main post image in full width
}
add_action('after_setup_theme', 'MDB_setup');

/**
 * Register sidebars and widgetized areas.
 */
function exowellmd_widgets_init() {

  register_sidebar( array(
    'name'          => 'Sidebar',
    'id'            => 'sidebar',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  ) );

}
add_action( 'widgets_init', 'exowellmd_widgets_init' );

?>

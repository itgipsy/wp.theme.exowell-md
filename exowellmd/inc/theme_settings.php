<?php
//Based on https://gist.github.com/ajskelton/8ae331406bd99254874b42c69ff0aa48
require_once('color_themes.php');

function exowellmd_customize_register( $wp_customize ) {
  /* Color theme selector */
  $wp_customize->add_setting('color_theme', array(
    'default' => 'mdb_dark',
	'type' => 'theme_mod'
  ));
  $wp_customize->add_control('color_theme', array(
    'type' => 'select',
	'priority' => 10,
	'section' => 'colors',
	'label' => __('Color theme'),
	'description' => __('Defines tone of the theme'),
	'choices' => getColorThemeNames(), 
    'sanitize_callback' => 'exowellmd_sanitize_select'
  ));

  $wp_customize->add_section('navbar', array(
    'title' => __('Navigation bar'),
	'priority' => 20
  ));
  /* Display/remove navigation bar */
  $wp_customize->add_setting('navbar_remove', array(
    'default' => false,
	'type' => 'theme_mod'
  ));
  $wp_customize->add_control('navbar_remove', array(
    'type' => 'checkbox',
	'section' => 'navbar',
	'label' => __('Hide navigation bar'),
	'description' => __('Hide top navigation bar')
  ));
  /* Search form in navigation bar */
  $wp_customize->add_setting('navbar_search', array(
    'default' => 'show',
	'type' => 'theme_mod'
  ));
  $wp_customize->add_control('navbar_search', array(
    'type' => 'radio',
	'section' => 'navbar',
	'label' => __('Search bar'),
	'description' => __('Show search form in navigation bar'),
	'choices' => array(
	  'show' => __('Show'),
	  'hide' => __('Hide')
	)
  ));
  /* Navbar fix on top */
  $wp_customize->add_setting('navbar_fixing', array(
  	'default' => 'scroll',
	'type' => 'theme_mod'
  ));
  $wp_customize->add_control('navbar_fixing', array(
  	'type' => 'radio',
	'section' => 'navbar',
	'label' => __('Navbar fixed on top'),
	'description' => __('Fix the navigation bar on the top of the screen'),
	'choices' => array(
	  'fix' => __('Fixed'),
	  'scroll' => __('Scrolling')
	)
  ));
  /* Transparent navbar on scroll*/
  $wp_customize->add_setting('navbar_transparent', array(
  	'default' => false,
	'type' => 'theme_mod'
  ));
  $wp_customize->add_control('navbar_transparent', array(
  	'type' => 'checkbox',
	'section' => 'navbar',
	'label' => __('Transparent navbar'),
	'description' => __('Transparent navigation bar on scroll (when fixed)')
  ));
}

function exowellmd_sanitize_select( $input, $setting ) {
  // Ensure input is a slug.
  $input = sanitize_key( $input );
  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;
  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

add_action( 'customize_register', 'exowellmd_customize_register' );
?>

<?php
//Based on https://gist.github.com/ajskelton/8ae331406bd99254874b42c69ff0aa48

function exowellmd_customize_register( $wp_customize ) {
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
	'choices' => array(
	  'mdb_dark' => __('MDB Dark'),
	  'mdb_light' => __('MDB Light')
	),
    'sanitize_callback' => 'exowellmd_sanitize_select'
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

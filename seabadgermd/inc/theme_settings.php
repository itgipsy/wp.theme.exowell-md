<?php
//Based on https://gist.github.com/ajskelton/8ae331406bd99254874b42c69ff0aa48
require_once('color_themes.php');

function seabadgermd_customize_register( $wp_customize ) {
	/* Color theme selector */
	$wp_customize->add_setting('seabadgermd_color_theme', array(
		'default' => 'mdb_dark',
		'sanitize_callback' => 'seabadgermd_sanitize_select'
	));
	$wp_customize->add_control('seabadgermd_color_theme', array(
		'type' => 'select',
		'priority' => 10,
		'section' => 'colors',
		'label' => __('Color theme', 'seabadgermd'),
		'description' => __('Defines tone of the theme', 'seabadgermd'),
		'choices' => seabadgermd_get_color_theme_names(), 
	));

	$wp_customize->add_section('navbar', array(
		'title' => __('Navigation bar', 'seabadgermd'),
		'priority' => 20
	));
	/* Display/remove navigation bar */
	$wp_customize->add_setting('seabadgermd_navbar_remove', array(
		'default' => false,
		'sanitize_callback' => 'seabadgermd_sanitize_checkbox'
	));
	$wp_customize->add_control('seabadgermd_navbar_remove', array(
		'type' => 'checkbox',
		'section' => 'navbar',
		'label' => __('Hide navigation bar', 'seabadgermd'),
		'description' => __('Hide top navigation bar', 'seabadgermd')
	));
	/* Search form in navigation bar */
	$wp_customize->add_setting('seabadgermd_navbar_search', array(
		'default' => 'show',
		'sanitize_callback' => 'seabadgermd_sanitize_showhide'
	));
	$wp_customize->add_control('seabadgermd_navbar_search', array(
		'type' => 'radio',
		'section' => 'navbar',
		'label' => __('Search bar', 'seabadgermd'),
		'description' => __('Show search form in navigation bar', 'seabadgermd'),
		'choices' => array(
			'show' => __('Show', 'seabadgermd'),
			'hide' => __('Hide', 'seabadgermd')
		)
	));
	/* Navbar fix on top */
	$wp_customize->add_setting('seabadgermd_navbar_fixing', array(
		'default' => 'scroll',
		'sanitize_callback' => 'seabadgermd_sanitize_onoff'
	));
	$wp_customize->add_control('seabadgermd_navbar_fixing', array(
		'type' => 'radio',
		'section' => 'navbar',
		'label' => __('Navbar fixed on top', 'seabadgermd'),
		'description' => __('Fix the navigation bar on the top of the screen', 'seabadgermd'),
		'choices' => array(
			'on' => __('Fixed', 'seabadgermd'),
			'off' => __('Scrolling', 'seabadgermd')
		)
	));
	/* Hide/show navbar on scroll*/
	$wp_customize->add_setting('seabadgermd_navbar_transparent', array(
		'default' => false,
		'sanitize_callback' => 'seabadgermd_sanitize_checkbox'
	));
	$wp_customize->add_control('seabadgermd_navbar_transparent', array(
		'type' => 'checkbox',
		'section' => 'navbar',
		'label' => __('Transparent navbar', 'seabadgermd'),
		'description' => __('Hide/show the main navigation bar on scroll (when fixed)', 'seabadgermd')
	));
	/* Hero section */
	$wp_customize->add_section('seabadgermd_hero', array(
		'title' => __('Hero', 'seabadgermd'),
		'priority' => 20
	));
	$wp_customize->add_setting('seabadgermd_hero_show', array(
		'default' => false,
		'sanitize_callback' => 'seabadgermd_sanitize_checkbox'
	));
	$wp_customize->add_control('seabadgermd_hero_show', array(
		'type' => 'checkbox',
		'section' => 'seabadgermd_hero',
		'label' => __('Display Hero header', 'seabadgermd'),
		'description' => __('Display a configurable header section', 'seabadgermd')
	));
	$wp_customize->add_setting('seabadgermd_hero_title', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('seabadgermd_hero_title', array(
		'type' => 'text',
		'section' => 'seabadgermd_hero',
		'label' => __('Hero title', 'seabadgermd'),
		'description' => __('Header title, title is hidden when empty', 'seabadgermd')
	));
	$wp_customize->add_setting('seabadgermd_hero_title_url', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('seabadgermd_hero_title_url', array(
		'type' => 'text',
		'section' => 'seabadgermd_hero',
		'label' => __('Hero title URL', 'seabadgermd'),
		'description' => __('Adds link to the hero title if not empty', 'seabadgermd')
	));
	$wp_customize->add_setting('seabadgermd_hero_description', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('seabadgermd_hero_description', array(
		'type' => 'text',
		'section' => 'seabadgermd_hero',
		'label' => __('Hero text', 'seabadgermd'),
		'description' => __('Header text, text block is hidden when empty', 'seabadgermd')
	));
	$wp_customize->add_setting('seabadgermd_hero_image', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'seabadgermd_hero_background',
		array(
			'label' => __('Header background image', 'seabadgermd'),
			'description' => __('Recommended width 1140px', 'seabadgermd'),
			'settings' => 'seabadgermd_hero_image',
			'section' => 'seabadgermd_hero'
		)
	));
    $wp_customize->add_setting('seabadgermd_hero_logo', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'seabadgermd_hero_logo',
        array(
            'label' => __('Custom page logo', 'seabadgermd'),
            'description' => __('Logo image to show in header', 'seabadgermd'),
            'settings' => 'seabadgermd_hero_logo',
            'section' => 'seabadgermd_hero'
        )
    ));
	$wp_customize->add_setting('seabadgermd_hero_button_text', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('seabadgermd_hero_button_text', array(
		'type' => 'text',
		'section' => 'seabadgermd_hero',
		'label' => __('Button text', 'seabadgermd'),
		'description' => __('Hero button text, button is removed if empty', 'seabadgermd') 
	));
	$wp_customize->add_setting('seabadgermd_hero_button_href', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('seabadgermd_hero_button_href', array(
		'type' => 'text',
		'section' => 'seabadgermd_hero',
		'label' => __('Button URL', 'seabadgermd'),
		'description' => __('Target URL of the button, button is removed if empty', 'seabadgermd') 
	));
	$wp_customize->add_setting('seabadgermd_hero_position', array(
		'default' => 'full',
		'sanitize_callback' => 'seabadgermd_sanitize_hero_position'
	));
	$wp_customize->add_control('seabadgermd_hero_position', array(
		'type' => 'select',
		'section' => 'seabadgermd_hero',
		'label' => __('Position', 'seabadgermd'),
		'description' => __('Position and width of hero text and control container', 'seabadgermd'),
		'choices' => array(
			'full' => __('Full width (left)', 'seabadgermd'),
			'left' => __('Left narrow', 'seabadgermd'),
			'center' => __('Center narrow', 'seabadgermd'),
			'right' => __('Right narrow', 'seabadgermd')
		)
	));
	$wp_customize->add_setting('seabadgermd_hero_bgcolor', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'seabadgermd_hero_bgcolor',
		array(
			'label' => __('Hero background color', 'seabadgermd'),
			'section' => 'seabadgermd_hero',
			'settings' => 'seabadgermd_hero_bgcolor'
		)
	));
	$wp_customize->add_setting('seabadgermd_hero_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'seabadgermd_hero_color',
		array(
			'label' => __('Hero text color', 'seabadgermd'),
			'section' => 'seabadgermd_hero',
			'settings' => 'seabadgermd_hero_color'
		)
	));
	$wp_customize->add_setting('seabadgermd_hero_button_bgcolor', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'seabadgermd_hero_button_bgcolor',
		array(
			'label' => __('Hero button color', 'seabadgermd'),
			'section' => 'seabadgermd_hero',
			'settings' => 'seabadgermd_hero_button_bgcolor'
		)
	));
	$wp_customize->add_setting('seabadgermd_hero_button_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'seabadgermd_hero_button_color',
		array(
			'label' => __('Hero button text color', 'seabadgermd'),
			'section' => 'seabadgermd_hero',
			'settings' => 'seabadgermd_hero_button_color'
		)
	));
	/* /Hero section */
	/* Breadcrumb section */
    $wp_customize->add_section('seabadgermd_breadcrumb', array(
        'title' => __('Breadcrumb', 'seabadgermd'),
        'priority' => 20
    ));
    $wp_customize->add_setting('seabadgermd_breadcrumb_show', array(
        'default' => false,
        'sanitize_callback' => 'seabadgermd_sanitize_checkbox'
    ));
    $wp_customize->add_control('seabadgermd_breadcrumb_show', array(
        'type' => 'checkbox',
        'section' => 'seabadgermd_breadcrumb',
        'label' => __('Display breadcrumb', 'seabadgermd'),
    ));
	$wp_customize->add_setting('seabadgermd_breadcrumb_home', array(
		'default' => 'Homepage',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('seabadgermd_breadcrumb_home', array(
		'type' => 'text',
		'section' => 'seabadgermd_breadcrumb',
		'label' => __('Homepage text', 'seabadgermd'),
		'description' => __('Text of the link pointing to the homepage', 'seabadgermd') 
	));
	/* /Breadcrumb section */
}

function seabadgermd_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function seabadgermd_sanitize_checkbox( $input ) {
	if (is_bool($input)) return $input;
	return false;
}

function seabadgermd_sanitize_showhide( $input ) {
	$choices = array( 'show', 'hide' );
	if ( in_array( $input, $choices ) ) {
		return $input;
	} else {
		return '';
	}
}

function seabadgermd_sanitize_onoff( $input ) {
	$choices = array( 'on', 'off' );
	if ( in_array( $input, $choices ) ) {
		return $input;
	} else {
		return '';
	}
}

function seabadgermd_sanitize_hero_position ( $input ) {
	$choices = array( 'full', 'left', 'center', 'right' );
	if ( in_array( $input, $choices ) ) {
		return $input;
	} else {
		return '';
	}
}

add_action( 'customize_register', 'seabadgermd_customize_register' );
?>

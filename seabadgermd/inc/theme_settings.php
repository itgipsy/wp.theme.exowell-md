<?php
//Based on https://gist.github.com/ajskelton/8ae331406bd99254874b42c69ff0aa48
require_once('color_themes.php');

function seabadgermd_customize_register( $wp_customize ) {
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
		'sanitize_callback' => 'seabadgermd_sanitize_select'
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
	/* Hero section */
	$wp_customize->add_section('hero', array(
		title => __('Hero'),
		priority => __(20)
	));
	$wp_customize->add_setting('hero_show', array(
		'default' => false,
		'type' => 'theme_mod'
	));
	$wp_customize->add_control('hero_show', array(
		'type' => 'checkbox',
		'section' => 'hero',
		'label' => __('Display Hero header'),
		'description' => __('Display a configurable header section')
	));
	$wp_customize->add_setting('hero_title', array(
		'default' => '',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control('hero_title', array(
		'type' => 'text',
		'section' => 'hero',
		'label' => __('Hero title'),
		'description' => __('Header title, title is hidden when empty')
	));
	$wp_customize->add_setting('hero_title_url', array(
		'default' => '',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control('hero_title_url', array(
		'type' => 'text',
		'section' => 'hero',
		'label' => __('Hero title URL'),
		'description' => __('Adds link to the hero title if not empty')
	));
	$wp_customize->add_setting('hero_description', array(
		'default' => '',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control('hero_description', array(
		'type' => 'text',
		'section' => 'hero',
		'label' => __('Hero text'),
		'description' => __('Header text, text block is hidden when empty')
	));
	$wp_customize->add_setting('hero_image', array(
		'default' => '',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'hero_background',
		array(
			'label' => __('Header background image'),
			'description' => __('Recommended width 1140px'),
			'settings' => 'hero_image',
			'section' => 'hero'
		)
	));
    $wp_customize->add_setting('hero_logo', array(
        'default' => '',
        'type' => 'theme_mod'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hero_logo',
        array(
            'label' => __('Custom page logo'),
            'description' => __('Logo image to show in header'),
            'settings' => 'hero_logo',
            'section' => 'hero'
        )
    ));
	$wp_customize->add_setting('hero_button_text', array(
		'default' => 'About',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control('hero_button_text', array(
		'type' => 'text',
		'section' => 'hero',
		'label' => __('Button text'),
		'description' => __('Hero button text, button is removed if empty') 
	));
	$wp_customize->add_setting('hero_button_href', array(
		'default' => '/about',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control('hero_button_href', array(
		'type' => 'text',
		'section' => 'hero',
		'label' => __('Button URL'),
		'description' => __('Target URL of the button, button is removed if empty') 
	));
	$wp_customize->add_setting('hero_position', array(
		'default' => 'full',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control('hero_position', array(
		'type' => 'select',
		'section' => 'hero',
		'label' => __('Position'),
		'description' => __('Position and width of hero text and control container'),
		'choices' => array(
			'full' => __('Full width (left)'),
			'left' => __('Left narrow'),
			'center' => __('Center narrow'),
			'right' => __('Right narrow')
		)
	));
	$wp_customize->add_setting('hero_bgcolor', array(
		'default' => '#000',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'hero_bgcolor',
		array(
			'label' => __('Hero background color'),
			'section' => 'hero',
			'settings' => 'hero_bgcolor'
		)
	));
	$wp_customize->add_setting('hero_color', array(
		'default' => '#fff',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'hero_color',
		array(
			'label' => __('Hero text color'),
			'section' => 'hero',
			'settings' => 'hero_color'
		)
	));
	$wp_customize->add_setting('hero_button_bgcolor', array(
		'default' => '#f00',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'hero_button_bgcolor',
		array(
			'label' => __('Hero button color'),
			'section' => 'hero',
			'settings' => 'hero_button_bgcolor'
		)
	));
	$wp_customize->add_setting('hero_button_color', array(
		'default' => '#000',
		'type' => 'theme_mod'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'hero_button_color',
		array(
			'label' => __('Hero button text color'),
			'section' => 'hero',
			'settings' => 'hero_button_color'
		)
	));
	/* /Hero section */
}

function seabadgermd_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

add_action( 'customize_register', 'seabadgermd_customize_register' );
?>

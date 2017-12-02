<?php

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
		'default' => 'on',
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
		'default' => true,
		'sanitize_callback' => 'seabadgermd_sanitize_checkbox'
	));
	$wp_customize->add_control('seabadgermd_navbar_transparent', array(
		'type' => 'checkbox',
		'section' => 'navbar',
		'label' => __('Transparent navbar', 'seabadgermd'),
		'description' => __('Hide/show the main navigation bar on scroll (when fixed)', 'seabadgermd')
	));
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
add_action( 'customize_register', 'seabadgermd_customize_register' );

/* Custom sanitizers */
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

/* /Custom sanitizers */

/* Color theme definition / helper functions */
if (! function_exists('seabadgermd_get_color_themes')) {
	function seabadgermd_get_color_themes() {
		$colorThemes = array(
			'mdb_dark' => array(
				'name' => __('Dark', 'seabadgermd'),
				'css' => '/css/themes/mdb_dark.css',
				'style' => 'dark'
			),
			'mdb_blue' => array(
				'name' => __('Blue', 'seabadgermd'),
				'css' => '/css/themes/mdb_blue.css',
				'style' => 'dark'
			),
			'mdb_light' => array(
				'name' => __('Light', 'seabadgermd'),
				'css' => '/css/themes/mdb_light.css',
				'style' => 'light'
			),
			'mdb_brown' => array(
				'name' => __('Brown', 'seabadgermd'),
				'css' => '/css/themes/mdb_brown.css',
				'style' => 'dark'
			),
			'mdb_red' => array(
				'name' => __('Red', 'seabadgermd'),
				'css' => '/css/themes/mdb_red.css',
				'style' => 'dark'
			),
			'mdb_green' => array(
				'name' => __('Green', 'seabadgermd'),
				'css' => '/css/themes/mdb_green.css',
				'style' => 'dark'
			)
		);
		return $colorThemes;
	}
}

function seabadgermd_get_color_theme($id) {
	$themes = seabadgermd_get_color_themes();
	return $themes[$id];
}

function seabadgermd_get_color_theme_names() {
	$themes = seabadgermd_get_color_themes();
	$theme_names = array();
	foreach ($themes as $id => $theme) {
		$theme_names[$id] = $theme['name'];
	}
	return $theme_names;
}

function seabadgermd_color_theme_exists($key = '') {
	if (!$key) return false;
	return array_key_exists($key, seabadgermd_get_color_themes());
}
/* /Color theme definition / helper functions */

?>

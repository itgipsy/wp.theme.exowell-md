<?php

if (! function_exists('getColorThemes')) {
	function getColorThemes() {
		$colorThemes = array(
			'mdb_dark' => array(
				'name' => __('MDB Dark'),
				'css' => '/css/themes/mdb_dark.css',
				'style' => 'dark'
			),
			'mdb_blue' => array(
				'name' => __('MDB Blue'),
				'css' => '/css/themes/mdb_blue.css',
				'style' => 'blue'
			),
			'mdb_light' => array(
				'name' => __('MDB Light'),
				'css' => '/css/themes/mdb_light.css',
				'style' => 'light'
			)
		);
		return $colorThemes;
	}
}

function getColorTheme($id) {
	$themes = getColorThemes();
	return $themes[$id];
}

function getColorThemeNames() {
	$themes = getColorThemes();
	$theme_names = array();
	foreach ($themes as $id => $theme) {
		$theme_names[$id] = $theme['name'];
	}
	return $theme_names;
}

function colorThemeExists($key) {
	return array_key_exists($key, getColorThemes());
}

?>

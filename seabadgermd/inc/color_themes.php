<?php

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
				'style' => 'blue'
			),
			'mdb_light' => array(
				'name' => __('Light', 'seabadgermd'),
				'css' => '/css/themes/mdb_light.css',
				'style' => 'light'
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

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>

<head>
	<!-- Meta tags first -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header class="<?= $header_class ?>">
		<?php get_template_part( 'template-parts/navbar' ); ?>
<!-- Hero -->
<?php
	if (get_theme_mod('seabadgermd_hero_show', false)) {
		$hero_config = array(
			'title' => get_theme_mod('seabadgermd_hero_title', ''),
			'title_url' => get_theme_mod('seabadgermd_hero_title_url', ''),
			'description' => get_theme_mod('seabadgermd_hero_description', ''),
			'button' => array(
				'text' => get_theme_mod('seabadgermd_hero_button_text', ''),
				'href' => get_theme_mod('seabadgermd_hero_button_href', ''),
				'color' => get_theme_mod('seabadgermd_hero_button_color', ''),
				'bgcolor' => get_theme_mod('seabadgermd_hero_button_bgcolor', '')
			),
			'color' => get_theme_mod('seabadgermd_hero_color', ''),
			'bgcolor' => get_theme_mod('seabadgermd_hero_bgcolor', ''),
			'image' => get_theme_mod('seabadgermd_hero_image', ''),
			'position' => get_theme_mod('seabadgermd_hero_position', ''),
			'logo' => get_theme_mod('seabadgermd_hero_logo', '')
		);
		displayHero($hero_config);
	}
?>
<!--/Hero -->
<?php get_template_part( 'template-parts/breadcrumb' ); ?>
</header>

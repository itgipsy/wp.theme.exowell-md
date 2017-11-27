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
	<header class="<?php echo $header_class ?>">
		<?php get_template_part('template-parts/navbar'); ?>
		<?php get_template_part('template-parts/hero'); ?>
		<?php get_template_part('template-parts/breadcrumb'); ?>
	</header>

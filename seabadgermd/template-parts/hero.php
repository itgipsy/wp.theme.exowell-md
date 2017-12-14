<?php
/**
* Displays a Hero / jumbotron based on the header configuration
*/
$header_image = get_header_image();
$text_color = get_header_textcolor();
// only show header if both header image and text or logo are enabled
if ( ! $header_image || ( 'blank' == $text_color && ! has_custom_logo() ) ) {
	return;
}

$hero_style = '';
$hero_style .= 'color:' . get_header_textcolor() . ';';
$hero_style .= 'background-image: url(\'' . $header_image . '\');';
$hero_style .= 'background-size: cover;';

?>
<div class="container hero">
	<div class="jumbotron row" style="<?php echo $hero_style; ?>">
		<div class="col-xs-12 col-md-10" style="color:#<?php echo $text_color; ?>!important">
			<h1 class="hero-title" style="color:#<?php echo $text_color; ?>">
				<?php bloginfo( 'name' ); ?>
			</h1>
			<p class="lead hero-description"><?php bloginfo( 'description' ); ?></p>
		</div>
		<?php
		if ( has_custom_logo() ) {
		?>
		<div class="col-xs-12 col-md-2 text-center hero-logo">
			<?php
				$custom_logo = get_custom_logo();
			if ( preg_match( '/class=/', $custom_logo ) ) {
				$custom_logo = str_replace( 'class="', 'class="img-fluid ', $custom_logo );
			} else {
				$custom_logo = str_replace( '<img', '<img class="img-fluid"', $custom_logo );
			}
				echo $custom_logo;
				?>
		</div>
		<?php
		}
		?>
	</div>
</div>

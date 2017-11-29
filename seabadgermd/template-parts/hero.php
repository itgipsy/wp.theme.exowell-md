<?php
/** 
* Displays a Hero / jumbotron based on the header configuration
*/
$header_image = get_header_image();
$text_color = get_header_textcolor();
// only show header if both header image and text are enabled
if (!$header_image || $text_color == 'blank') {
	return;
}

$hero_style="";
$hero_style .= 'color:' . get_header_textcolor() . ';';
$hero_style .= 'background-image: url(\'' . $header_image . '\');';
$hero_style .= 'background-size: cover;';
?>
<div class="container hero">
	<div class="jumbotron row" style="<?php echo $hero_style ?>">
<?php /** if ($config['logo']): ?>
	<div class="col-xs-12 col-md-2 text-center hero-logo">
		<a href="/"><img class="logo" aria-label="Logo to homepage" src="<?php echo $config['logo'] ?>"></a>
	</div>
<?php endif; **/?>
		<div class="col-xs-12 col-md-10" style="color:#<?php echo $text_color; ?>!important">
			<h1 class="display-3 hero-title" style="color:#<?php echo $text_color; ?>">
				<?php bloginfo('name'); ?>
			</h1>
			<p class="lead hero-description"><?php bloginfo('description'); ?></p>
		</div>
	</div>
</div>

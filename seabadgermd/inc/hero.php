<?php
/** 
* Displays a Hero / jumbotron based on the configuration
* $config keys : title, description, button[text, href, bgcolor, color], image, bgcolor, color, position
*/
function displayHero($config) {
	$hero_style="";
	if ($config['bgcolor']) $hero_style .= 'background-color:' . $config['bgcolor'] . ';';
	if ($config['color']) $hero_style .= 'color:' . $config['color'] . ';';
	if ($config['image']) {
		$hero_style .= 'background-image: url(\'' . $config['image'] . '\');';
		$hero_style .= 'background-size: cover;';
	}
	switch($config['position']) {
		case 'right': $arrangeclass = 'col-xs-12 col-md-5 offset-md-7';
			break;
		case 'center': $arrangeclass = 'col-xs-12 col-md-5 offset-md-4';
			break;
		case 'left': $arrangeclass = 'col-xs-12 col-md-5';
			break;
		default: //full
			$arrangeclass = 'col-xs-12';
	}
?>
	<div class="container hero">
		<div class="jumbotron" style="<?= $hero_style ?>">
			<div class="<?= $arrangeclass ?>">
	<?php if ($config['title']) : ?>
		<h1 class="display-3 hero-title"><?= $config['title'] ?></h1>
	<?php endif; ?>
	<?php if ($config['description']) : ?>
		<p class="lead hero-description"><?= $config['description'] ?></p>
	<?php endif; ?>
	<?php if (is_array($config['button']) && $config['button']['text'] && $config['button']['href']) {
		$button = $config['button'];
		$btn_style;
		if ($button['bgcolor']) $btn_style .= 'background-color: ' . $button['bgcolor'] . ';';
		if ($button['color']) $btn_style .= 'color: ' . $button['color'] . ';';
	?>
		<p class="lead hero-button-area">
			<a class="btn btn-lg themecolor" style="<?= $btn_style ?>" href="<?= $button['href'] ?>" 
				role="button"><?= $button['text'] ?></a>
		</p>
	<?php } ?>
			</div>
		</div>
	</div>
<?php
}
?>

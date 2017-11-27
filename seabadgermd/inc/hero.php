<?php
/** 
* Displays a Hero / jumbotron based on the configuration
* $config keys : title, title_url, description, button[text, href, bgcolor, color], image, bgcolor, color, position
*/
function displayHero($config) {
	$hero_style="";
	if ($config['bgcolor']) $hero_style .= 'background-color:' . $config['bgcolor'] . ';';
	if ($config['color']) $hero_style .= 'color:' . $config['color'] . ';';
	if ($config['image']) {
		$hero_style .= 'background-image: url(\'' . $config['image'] . '\');';
		$hero_style .= 'background-size: cover;';
	}
	if ($config['logo']) {
		$offset_right = '5';
		$offset_center = '2';
	} else {
		$offset_right = '7';
		$offset_center = '4';
	}
	switch($config['position']) {
		case 'right': $arrangeclass = 'col-xs-12 col-md-5 offset-md-' . $offset_right;
			break;
		case 'center': $arrangeclass = 'col-xs-12 col-md-5 offset-md-' . $offset_center;
			break;
		case 'left': $arrangeclass = 'col-xs-12 col-md-5';
			break;
		default: //full
			$arrangeclass = 'col-xs-12';
			if ($config['logo']) {
				$arrangeclass .= ' col-md-10';
			}
	}
?>
	<div class="container hero">
		<div class="jumbotron row" style="<?php echo $hero_style ?>">
	<?php if ($config['logo']): ?>
		<div class="col-xs-12 col-md-2 text-center hero-logo">
			<a href="/"><img class="logo" aria-label="Logo to homepage" src="<?php echo $config['logo'] ?>"></a>
		</div>
	<?php endif; ?>
			<div class="<?php echo $arrangeclass ?>">
	<?php if ($config['title']) : ?>
		<h1 class="display-3 hero-title">
			<?php
				if ($config['title_url']) {
					$style = '';
					if ($config['color']) {
						$style = sprintf('style="color: %s!important"', $config['color']);
					}
					printf('<a href="%s" %s>%s</a>', $config['title_url'], $style, $config['title']);
				} else {
					echo $config['title'];
				}
			?>
		</h1>
	<?php endif; ?>
	<?php if ($config['description']) : ?>
		<p class="lead hero-description"><?php echo $config['description'] ?></p>
	<?php endif; ?>
	<?php if (is_array($config['button']) && $config['button']['text'] && $config['button']['href']) {
		$button = $config['button'];
		$btn_style;
		if ($button['bgcolor']) $btn_style .= 'background-color: ' . $button['bgcolor'] . ';';
		if ($button['color']) $btn_style .= 'color: ' . $button['color'] . ';';
	?>
		<p class="lead hero-button-area">
			<a class="btn btn-lg" style="<?php echo $btn_style ?>" href="<?php echo $button['href'] ?>" 
				role="button"><?php echo $button['text'] ?></a>
		</p>
	<?php } ?>
			</div>
		</div>
	</div>
<?php
}
?>

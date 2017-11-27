
<?php
	$navbar_class = '';
	if (get_theme_mod('seabadgermd_navbar_fixing', 'off') =='on' && !get_theme_mod('navbar_remove', false)) {
		$navbar_class .= ' fixed-top scrolling-navbar';
		$header_class = 'fixed'; //using this to control main style via sibling selector
		if (get_theme_mod('seabadgermd_navbar_transparent', false)) {
			$navbar_class .= ' autohide';
		}
	}
	$colorThemeConf = seabadgermd_get_color_theme(get_theme_mod('seabadgermd_color_theme'));
	if ($colorThemeConf['style'] == 'dark') {
		$navbar_class .= ' navbar-dark';
	}
?>
<!--Navbar-->
<?php if (! get_theme_mod('seabadgermd_navbar_remove', false)) : ?>
	<nav id="main-navbar" class="navbar navbar-expand-lg themecolor<?php echo $navbar_class ?>">
		<div class="container">
			<!-- Navbar brand -->
			<!-- <a class="navbar-brand" href="#">Navbar</a> -->
			<!-- Collapse button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon themecolor"></span></button>
			<!-- Collapsible content -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<?php
						if ( has_nav_menu( 'navbar' ) ) {
							wp_nav_menu( array(
								'menu'					=> 'navbar',
								'theme_location'		=> 'navbar',
								'depth'					=> 2,
								'menu_class'			=> 'navbar-nav mr-auto',
								'fallback_cb'			=> '__return_false',
								'items_wrap'			=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'container'				=> false,
								'walker'				=> new bootstrap_4_walker_nav_menu())
							);
						} else {
					 		echo "Please assign Navbar Menu in Wordpress Admin -> Appearance -> Menus -> Manage Locations";
						}
					?> 
				</ul>
				<?php if (get_theme_mod('seabadgermd_navbar_search', 'show') == 'show') : ?>
					<form role="search" method="get" id="searchform" class="form-inline" action="">
						<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="s" 
							value="<?php echo htmlspecialchars($_GET['s']) ?>">
					</form>
				<?php endif ?>
				</div>
			</div>
		</div>
	</nav>
<?php endif; ?>
<!--/Navbar-->

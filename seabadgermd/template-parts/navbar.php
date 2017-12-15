<?php
	$navbar_class = '';
if ( get_theme_mod( 'seabadgermd_navbar_fixing', 'on' ) === 'on' &&
! get_theme_mod( 'navbar_remove', false ) ) {
	$navbar_class .= ' fixed-top scrolling-navbar';
	if ( get_theme_mod( 'seabadgermd_navbar_transparent', true ) ) {
		$navbar_class .= ' autohide';
	}
}
	$color_theme_conf = seabadgermd_get_color_theme( get_theme_mod( 'seabadgermd_color_theme' ) );
if ( 'dark' === $color_theme_conf['style'] ) {
	$navbar_class .= ' navbar-dark';
}
?>
<!--Navbar-->
<?php if ( ! get_theme_mod( 'seabadgermd_navbar_remove', false ) ) : ?>
	<nav id="main-navbar" class="navbar navbar-expand-lg themecolor<?php echo $navbar_class; ?>" role="navigation">
		<div class="container">
			<!-- Navbar brand -->
			<!-- <a class="navbar-brand" href="#">Navbar</a> -->
			<!-- Collapse button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle navigation', 'seabadgermd' ); ?>">
			<span class="navbar-toggler-icon themecolor"></span></button>
			<!-- Collapsible content -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<?php
					if ( has_nav_menu( 'navbar' ) ) {
						wp_nav_menu(
							array(
								'menu'                  => 'navbar',
								'theme_location'        => 'navbar',
								'depth'                 => 2,
								'menu_class'            => 'navbar-nav mr-auto',
								'fallback_cb'           => '__return_false',
								'items_wrap'            => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'container'             => false,
								'walker'                => new Seabadgermd_Menuwalker(),
							)
						);
					} else {
						esc_html_e( 'Please assign Navbar Menu in Wordpress Admin -> Appearance -> Menus -> Manage Locations', 'seabadgermd' );
					}
					?>
					 
				</ul>
				<?php
				if ( get_theme_mod( 'seabadgermd_navbar_search', 'show' ) === 'show' ) :
					$s = array_key_exists( 's', $_GET, true ) ? htmlspecialchars( $_GET['s'] ) : '';
				?>
				<form role="search" method="get" id="searchform" class="form-inline" action="">
					<input class="form-control mr-sm-2" type="text"
					placeholder="<?php esc_attr_e( 'Search', 'seabadgermd' ); ?>" 
					aria-label="<?php esc_attr_e( 'Search', 'seabadgermd' ); ?>" name="s" 
					value="<?php echo esc_attr( $s ); ?>">
				</form>
				<?php endif ?>
				</div>
			</div>
		</div>
	</nav>
<?php endif; ?>
<!--/Navbar-->

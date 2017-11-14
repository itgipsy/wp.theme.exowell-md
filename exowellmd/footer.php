
<!--Footer-->
<footer class="container page-footer themecolor">
	<div class="row">
	<div class="footer-social col-xs-6 col-md-3">
		<a href="http://fb.com" class="btn btn-round themecolor"><i class="fa fa-facebook"></i></a>
	</div>

	<!--Footer menu -->
	<?php
		if ( has_nav_menu( 'footer' ) ) {
	?>
	<div class="footer-menu col-xs-6 col-md-5">
		<?php
		wp_nav_menu( array(
			'menu' => 'footer',
			'theme_location' => 'footer',
			'depth' => 1
	 		)
	 	);
		?>
	</div>
	<?php
		}
	?>
	<!--/Footer menu-->

	<!--Copyright-->
	<div class="footer-copyright col-xs-12 col-md-4">
		©2017 Copyright <a href="https://exowell.com"	rel="nofollow">ExoWell.com</a>
	</div>
	<!--/Copyright-->
	</div>
</footer>
<!--/Footer-->
<?php wp_footer(); ?>
</body>
</html>

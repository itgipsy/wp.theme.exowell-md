
<!--Footer-->
<footer class="container page-footer themecolor">
	<div class="row">
	<div class="footer-social col-xs-6 col-md-3">
		<?php
			seabadgermd_display_social_buttons();
		?>
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
		2017 Copyright <a href="https://seabadger.io" rel="nofollow">SeaBadger.io</a>
	</div>
	<!--/Copyright-->
	</div>
</footer>
<!--/Footer-->
<button class="btn themecolor" id="to-the-top" title="Back to the top">
	<i class="fa fa-arrow-circle-up" aria-hidden="true"></i><span class="sr-only">Back to the top</span>
</button>
<?php wp_footer(); ?>
</body>
</html>

<?php get_header(); ?>
<main>
<span id="top" style="display:none"></span>
<!--Main layout-->
<div class="container">
	<div class="row">
		<!--Main column-->
		<div class="col-xs-12 col-md-8">
			<div class="row">
				<div class="card col-xs-12 col-md-8 offset-md-2">
					<img class="img-fluid" src="<?php echo SBMD_THEME_DIR_URI ?>/img/404.png">
					<div class="card-body">
						<h4 class="card-title"><?php echo __('404 - Not found', 'seabadgermd'); ?></h4>
            <p class="card-text"><?php echo __('Sorry, the content you are looking for is not available. Best I can offer you is this search bar. 
            Please feel free to use it and hope you will find what you are looking for.', 'seabadgermd'); ?></p>
						<p class="card-text"><?php get_search_form(); ?></p>
					</div>
				</div>
			</div>
		</div>
		<!--Sidebar-->
		<?php get_sidebar(); ?>
		<!--/Sidebar-->	
	</div>
</div>
<!--/Main layout-->
</main>
<?php get_footer(); ?>

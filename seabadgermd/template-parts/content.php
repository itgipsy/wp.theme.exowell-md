<!--Post data-->
<?php get_template_part('template-parts/content/featuredimage'); ?>
<div class="card-body post-block">
	<?php get_template_part('template-parts/content/title'); ?>
	<?php get_template_part('template-parts/content/meta'); ?>
	<div class="card-text post-content">
		<?php
			// this theme only displays excerpt, if one is explicitly defined
			if (!has_excerpt()) {
				the_content('', false);
			} else {
				the_excerpt();
			}
		?>
		<br class="clear">
		<?php get_template_part('template-parts/content/footer'); ?>
	</div>
</div>

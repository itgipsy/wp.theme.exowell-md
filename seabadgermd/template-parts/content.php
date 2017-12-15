<!--Post data-->
<?php get_template_part( 'template-parts/content/featuredimage' ); ?>
<div class="card-body post-block">
	<?php get_template_part( 'template-parts/content/title' ); ?>
	<?php get_template_part( 'template-parts/content/meta' ); ?>
	<div class="card-text post-content">
		<?php
		if ( ! has_excerpt() || ! post_password_required() ) {
			the_content( '', false );
		} else {
			the_excerpt();
		}
		?>
		<br class="clear">
		<?php get_template_part( 'template-parts/content/footer' ); ?>
	</div>
<?php if ( seabadgermd_has_readmore() ) : ?>
	<!--"Read more" button-->
	<a href="<?php echo esc_url( get_permalink() ); ?>"><button class="btn themecolor">
	<?php esc_attr_e( 'Read more', 'seabadgermd' ); ?></button></a>
<?php endif; ?>
<!-- Comment button -->
<?php
if ( comments_open() || get_comments_number() != 0 ) {
	comments_popup_link(
		__( 'Comment', 'seabadgermd' ),
		__( 'View comment', 'seabadgermd' ),
		__( 'View comments (%)', 'seabadgermd' ),
		'btn themecolor comment-link',
		__( 'Comments off', 'seabadgermd' )
	);
}
?>
</div>

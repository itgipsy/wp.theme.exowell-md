<?php if (seabadgermd_has_readmore()): ?>
	<!--"Read more" button-->
	<a href="<?php echo get_permalink() ?>"><button class="btn themecolor">Read more</button></a>
<?php endif; ?>
<!-- Comment button -->
<?php
	if (comments_open() || get_comments_number()!=0) {
		comments_popup_link( __('Comment', 'seabadgermd'),
			__('View comment', 'seabadgermd'),
			__('View comments (%)', 'seabadgermd'),
			'btn themecolor comment-link',
			__('Comments off', 'seabadgermd'));
	}
?>
<!-- Tags line -->
<?php
	if (has_tag()) {
		echo '<hr><span class="text-muted tagline">' .  __('Tagged with ', 'seabadgermd');
		echo get_the_tag_list('', ' ');
		echo '</span>';
	}
?>

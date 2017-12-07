<!-- Tags line -->
<?php
	if (has_tag()) {
		echo '<hr><span class="text-muted tagline">' .  __('Tagged with ', 'seabadgermd');
		echo get_the_tag_list('', ' ');
		echo '</span>';
	}
?>

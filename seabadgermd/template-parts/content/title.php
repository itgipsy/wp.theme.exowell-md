<?php
	$is_sticky = is_sticky() && is_home() && !is_paged();
?>
<a href="<?php echo get_permalink() ?>">
	<h4 class="card-title post-title <?php echo ($is_sticky) ? 'sticky' : ''; ?>">
		<?php the_title(); ?>
		<?php
			if ($is_sticky) echo '<i class="fa fa-anchor sticky_icon" aria-label="Sticky post"></i>';
		?>
	</h4>
</a>

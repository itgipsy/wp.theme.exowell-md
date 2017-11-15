<!--Post-->
<div class="card post-wrapper">
	<!--Featured image -->
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="view overlay post-image-overlay">
			<?php the_post_thumbnail('large', array('class' => 'card-img-top img-fluid')); ?>
    		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-image"><div class="mask"></div></a>
		</div>
	<?php endif; ?>
	<!--Post data-->
	<div class="card-body post-block">
		<a href="<?php echo get_permalink() ?>"><h4 class="card-title post-title"><?php the_title(); ?></h4></a>
		<div class="card-text post-meta">
			Posted by <?php echo get_the_author_link(); ?> on <?php echo get_the_date(); ?>
			<hr>
		</div>
		<div class="card-text post-content">
			<?php
			if (is_single()){
				the_content();
			} else {
				the_content('', false);
			?>
			<!--"Read more" button-->
			<a href="<?php echo get_permalink() ?>"><button class="btn themecolor">Read more</button></a>
			<?php
			}
			?>
		</div>
	</div>
</div>
<!--/.Post-->

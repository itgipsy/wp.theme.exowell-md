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
			<span class="badge badge-pill post-author themecolor">
				<i class="fa fa-user-circle" aria-hidden="true"></i>
				<span class="sr-only">Author:</span>
				<?php echo get_the_author_link(); ?>
			</span>
			<span class="badge badge-pill post-date themecolor">
				<i class="fa fa-calendar" aria-hidden="true"></i>
				<span class="sr-only">Posted on:</span>
				<?php echo get_the_date(); ?>
			</span>
			<?php
				$categories = array();
				foreach ( (get_the_category()) as $category ){
					$categories[] = '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>';
				}
				$cat_str = implode(', ', $categories);
			?>
			<span class="badge badge-pill post-categories themecolor">
				<i class="fa fa-folder-o" aria-hidden="true"></i>
				<span class="sr-only">Post categories:</span>
				<?php echo $cat_str; ?>
			</span>
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

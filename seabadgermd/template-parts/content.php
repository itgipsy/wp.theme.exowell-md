<!--Post-->
<div class="card post-wrapper <?php post_class(); ?>">
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
		<?php if (get_post_type() == 'post') : ?>
			<div class="card-text post-meta">
				<span class="badge badge-pill post-author themecolor">
					<i class="fa fa-user-circle" aria-hidden="true"></i>
					<span class="sr-only">Author:</span>
					<?php
						printf('<a href="%s" rel="author">%s</a>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							get_the_author());
					?>
				</span>
				<span class="badge badge-pill post-date themecolor">
					<i class="fa fa-calendar" aria-hidden="true"></i>
					<span class="sr-only">Posted on:</span>
					<?php echo get_the_date(); ?>
				</span>
				<?php
					$categories = array();
					foreach ( (get_the_category()) as $category ){
						$categories[] = sprintf('<a href="%s">%s</a>', get_category_link($category->term_id),
											$category->cat_name);
					}
					$cat_str = implode(', ', $categories);
				?>
				<span class="badge badge-pill post-categories themecolor">
					<i class="fa fa-folder-o" aria-hidden="true"></i>
					<span class="sr-only">Post categories:</span>
					<?php echo $cat_str; ?>
				</span>
			</div>
		<?php endif; ?>
		<div class="card-text post-content">
			<?php
			if (is_single()){
				the_content();
				seabadgermd_post_navigation();
				if ( comments_open() || get_comments_number()!=0 ) {
				?><div class="comments" id="comments"><?php
					comments_template( '', true );
				?></div><?php // end comment section
				}
			} else {
				the_content('', false);
			?>
			<!--"Read more" button-->
			<a href="<?php echo get_permalink() ?>"><button class="btn themecolor">Read more</button></a>
			<!-- Comment button -->
			<?php
				if (comments_open() || get_comments_number()!=0) {
					comments_popup_link( __('Comment', 'seabadgermd'),
						__('View comment', 'seabadgermd'),
						__('View comments (%)', 'seabadgermd'),
						'btn themecolor comment-link',
						__('Comments off', 'seabadgermd'));
				}
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
		</div>
	</div>
</div>
<!--/.Post-->

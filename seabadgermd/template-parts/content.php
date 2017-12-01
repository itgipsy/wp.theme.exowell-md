<!--Post-->
<div <?php post_class('card post-wrapper'); ?>>
	<!--Featured image -->
	<?php if ( has_post_thumbnail() ) : ?>
    	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-image">
			<?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
		</a>
	<?php endif; ?>
	<!--Post data-->
	<?php
		$is_sticky = is_sticky() && is_home() && !is_paged();
	?>
	<div class="card-body post-block">
		<a href="<?php echo get_permalink() ?>">
			<h4 class="card-title post-title <?php echo ($is_sticky) ? 'sticky' : ''; ?>">
				<?php the_title(); ?>
				<?php
					if ($is_sticky) echo '<i class="fa fa-anchor sticky_icon"></i>';
				?>
			</h4>
		</a>
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
					foreach ( array_slice((get_the_category()), 0, 5) as $category ){
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
 				$wplink_options = array(
					'before'           => '<div class="row"><div class="post-paging col-12">' . __('Jump to page ', 'seabadgermd'),
					'after'            => '</div></div>',
					'link_before'      => '<span class="post-paging-link themecolor">',
					'link_after'       => '</span>',
					'next_or_number'   => 'number',
					'separator'        => ' ',
					'pagelink'         => '%',
					'echo'             => 1
				);
				wp_link_pages($wplink_options);
				seabadgermd_post_navigation();
				if ( comments_open() || get_comments_number()!=0 ) {
					if (get_option('thread_comments')) {
						wp_enqueue_script('comment-reply');
					}
				?><div class="comments" id="comments"><?php
					comments_template( '', true );
				?></div><?php // end comment section
				}
			} else {
				// this theme only displays excerpt, if one is explicitly defined
				if (!has_excerpt()) {
					the_content('', false);
				} else {
					the_excerpt();
				}
			?>
			<br class="clear">
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

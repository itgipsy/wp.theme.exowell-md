<?php
if ( ! is_active_sidebar( 'sidebar' ) ) {
  return;
}
?>

<aside id="sidebar" class="widget-area col-xs-12 col-md-4" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside>

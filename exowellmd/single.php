<?php get_header(); ?>
<main>
<!--Main layout-->
<div class="container">
  <div class="row">
    <!--Main column-->
    <div class="col-xs-12 col-md-8">
      <?php
      if ( have_posts() ) {
        while ( have_posts() ) {
          the_post();
      ?>
      <!--Post-->
      <?php get_template_part('template-parts/content', get_post_format()); ?>
    </div>
    <!--Sidebar-->
    <div class="col-xs-12 col-md-4">
      <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
      <?php dynamic_sidebar( 'sidebar' ); ?>
      <?php endif; ?>
    </div>
    <!--/Sidebar-->  
  </div>
</div>
<!--/Main layout-->
</main>
<?php get_footer(); ?>

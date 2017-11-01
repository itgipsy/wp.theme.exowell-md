
<!--Footer-->
<footer class="page-footer mdb-color lighten3 center-on-small-only">
  <!--Footer menu -->
  <?php
    if ( has_nav_menu( 'footer' ) ) {
  ?>
  <div class="footer-menu container-fluid">
    <?php
    wp_nav_menu( array(
      'menu' => 'footer',
      'theme_location' => 'footer',
      'depth' => 1
   		)
   	);
    ?>
  </div>
  <?php
    }
  ?>
  <!--/Footer menu-->

  <!--Copyright-->
  <div class="footer-copyright">
    <div class="container-fluid">
      ©2017 Copyright <a href="https://exowell.com"  rel="nofollow">ExoWell.com</a>
    </div>
  </div>
  <!--/Copyright-->

</footer>
<!--/Footer-->
<?php wp_footer(); ?>
</body>
</html>

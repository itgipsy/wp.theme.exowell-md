<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta tags first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
  	<?php bloginfo('name'); ?>
  </title>
  <?php wp_head(); ?>
</head>
<body>

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark mdb-color darken-2">
  <!-- Navbar brand -->
  <a class="navbar-brand" href="#">Navbar</a>
  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php
          if ( has_nav_menu( 'navbar' ) ) {
            wp_nav_menu( array(
              'menu'              => 'navbar',
              'theme_location'    => 'navbar',
              'depth'             => 2,
              'menu_class'        => 'navbar-nav mr-auto',
              'fallback_cb'       => '__return_false',
              'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'container'         => false,
              'walker'            => new bootstrap_4_walker_nav_menu())
        	  );
        	} else {
         	  echo "Please assign Navbar Menu in Wordpress Admin -> Appearance -> Menus -> Manage Locations";
            }
        ?> 
      </ul>
      <form role="search" method="get" id="searchform" class="form-inline" action="">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="s" 
          value="<?= htmlspecialchars($_GET['s']) ?>">
      </form>
    </div>
  </div>
</nav>
<!--/Navbar-->

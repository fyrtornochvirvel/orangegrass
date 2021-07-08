<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="top">
  <a href="<?php echo home_url(); ?>"><img class="blog-logo" src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.png" alt="logo"></a>
  <h1 class="blog-name"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
  <nav id="nav-main">
    <?php

      $args = array(
        'theme_location' => 'primary'
      );

    ?>

    <?php wp_nav_menu( $args ); ?>
  </nav>
  <div id="nav-trigger">
    <span><i class="fa fa-bars"></i></span>
  </div>
  <div class="u-cf"></div>
  <nav id="nav-mobile"></nav>
</header>
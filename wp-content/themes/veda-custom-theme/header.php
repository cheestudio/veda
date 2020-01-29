<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <title><?php wp_title(''); ?></title>
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#00704a">
  <?php wp_head(); ?>
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  
  <?php if ( is_front_page() ) : ?>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
  <?php endif; ?>


  <?php 
  $logo        = get_template_directory_uri() . '/assets/img/logo.png';
  $header_code = get_field('header_code', 'option');
  $post_type   = (get_post_type() == 'article' && $post->post_parent > 0) ? 'article-child-page' : NULL;
  if ( $header_code ) echo $header_code; ?>
</head>

<body <?php body_class(); ?> id="top">

  <header class="main-banner" role="banner">
    <div id="nav-search-form" class="nav-search-form"><?php get_search_form(); ?></div>
    <div class="top-nav">
      <div class="container">
        <nav><?php include( locate_template('partials/navs/nav-desktop-top.php') ); ?></nav>
      </div>
    </div>

    <div class="desktop-nav">
      <div class="container">
        <a class="brand" href="/" title="Home">
          <?php svg( $logo, 'Site Logo' ); ?>
        </a>
        <nav role="navigation">
          <?php include( locate_template('partials/navs/nav-desktop.php') ); ?>
          <?php include( locate_template('partials/navs/nav-mobile.php') ); ?>
        </nav>
      </div>
    </div>

  </header>

  <main role="main" <?php if ($post_type) echo "class='$post_type'"; ?>>

<?php
/* 
 * Template Name: Article Index
 * Template Post Type: article
========================================================= */ ?>
<?php get_header(); ?>


<?php // Hero
$hero = get_field('article_hero_group'); ?>
<?php if ( $hero ) : ?>
  <section class="article-hero">
    <div class="flex">
      <div class="article-hero--heading">
        <div class="inner"><?= $hero['heading']; ?></div>
      </div>

      <div class="article-hero--image" aria-label="Page Title Image" style="background-image: url(<?= $hero['image']['sizes']['large']; ?>);"></div>

      <div class="article-hero--section-nav">
        <div class="toggle">
          <h5><a title="Click to Open/Close">In This Section<span class="close"><i class="las la-plus-circle"></i></span><span class="open"><i class="las la-minus-circle"></i></span></a></h5>
        </div>
        <ul>
          <?php include( locate_template('partials/section-nav-pages.php') ); ?>
        </ul>
      </div>
    </div>
  </section>
<?php endif; ?>


<?php // Main Content
if ( have_posts() ) : ?>
  <section class="article-main">
    <div class="container">
      <div class="article-main--content">
        <?php include( locate_template('partials/breadcrumbs.php') ); ?>
        <div class="inner">
          <?php while ( have_posts() ) : the_post();
            the_content();
          endwhile; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif;?>
<?php wp_reset_query(); ?>


<?php // Banner CTA
include( locate_template('partials/clones/banner-cta.php') ); ?>


<?php // Banner Menu
include( locate_template('partials/banner-menu.php') ); ?>


<?php // Sponsored Ad
include( locate_template('partials/clones/sponsored-ad.php') ); ?>


<?php get_footer(); ?>

<?php get_header(); ?>

<!-- Hero -->
<?php $hero = get_field('article_hero_group'); ?>

<?php if ( $hero ) :?>

  <?php $heading = !empty($hero['heading']) ? $hero['heading'] : get_the_title(); ?>

  <section class="article-hero">
    <div class="flex">
      <div class="article-hero--heading">
        <div class="inner"><h1><?= $heading; ?></h1></div>
      </div>
      <div class="article-hero--image" aria-label="Page Title Image" style="background-image: url(<?= $hero['image']['sizes']['large']; ?>);"></div>
      <?php include( locate_template('partials/section-nav-pages.php') ); ?>
    </div>
  </section>

<?php else : ?>

  <section class="hero-basic">
    <div class="container">
      <div class="hero-basic--heading">
        <div class="inner"><h1><?php single_post_title(); ?></h1></div>
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

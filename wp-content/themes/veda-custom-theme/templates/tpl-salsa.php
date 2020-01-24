<?php
/* Template Name: Salsa Template
========================================================= */ ?>
<?php get_header(); ?>


<?php // Hero
$heading = get_field('salsa_heading'); ?>
<?php if ( $heading ) : ?>
  <section class="hero-basic">
    <div class="container">
      <div class="hero-basic--heading">
        <div class="inner"><h1><?= $heading; ?></h1></div>
      </div>
    </div>
  </section>
<?php endif; ?>


<?php // Intro Image
$image = get_field('salsa_image'); ?>
<?php if ( $image ) : ?>
  <section class="salsa-intro">
    <div class="container">
      <div class="salsa-intro--image"><?php echo wp_get_attachment_image( $image['id'], 'wide-short' ); ?></div>
    </div>
  </section>
<?php endif; ?>


<?php // 
$content = get_field('salsa_content');
$embed   = get_field('salsa_embed');?>
<?php if ( $content || $embed ) : ?>
  <section class="salsa-content">
    <div class="container flex">
      <div class="salsa-content--primary"><?= $content; ?></div>
      <div class="salsa-content--secondary"><?= $embed; ?></div>
    </div>
  </section>
<?php endif; ?>


<?php get_footer(); ?>

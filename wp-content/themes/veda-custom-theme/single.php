<?php get_header(); ?>


<?php 
$tax = get_field('post_article_category'); ?>
<section class="hero-basic">
  <div class="container">
    <div class="hero-basic--heading">
      <div class="inner">
        <?php if ( $tax ) echo "<p>{$tax->name}</p>"; ?>
        <h1>eNews</h1>
      </div>
    </div>
  </div>
</section>


<div class="blog-single">
  <div class="container">
    <div class="blog-single--content">
      <?php while ( have_posts() ) : the_post();?>
        <?php get_template_part('partials/blog/content-single'); ?>
      <?php endwhile; ?>
    </div>
  </div>
</div>


<?php // References
include( locate_template('partials/clones/references.php') ); ?>


<?php // Related Articles
include( locate_template('partials/related-articles.php') ); ?>


<?php // Banner Menu
include( locate_template('partials/banner-menu.php') ); ?>


<?php get_footer(); ?>

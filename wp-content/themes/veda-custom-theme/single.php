<?php get_header(); ?>


<?php // Hero
$tax = get_field('post_article_category'); ?>
<section class="hero-basic">
  <div class="container">
    <div class="hero-basic--heading">
      <div class="inner">
        <?php if ( $tax ) echo "<p>{$tax->name}</p>"; ?>
        <h1><?= $post->post_title; ?></h1>
      </div>
    </div>
  </div>
</section>


<?php // Main Content
while ( have_posts() ) : the_post();?>
  <section class="blog-single">
    <div class="container">
      <div class="blog-single--content">
        <?php get_template_part('partials/blog/content-single'); ?>
      </div>
    </div>
  </section>
<?php endwhile; ?>


<?php // References
include( locate_template('partials/clones/references.php') ); ?>


<?php // Related Articles
include( locate_template('partials/related-articles.php') ); ?>


<?php // Banner Menu
include( locate_template('partials/banner-menu.php') ); ?>


<?php get_footer(); ?>

<?php get_header(); ?>


<?php // Look for a page slug "404"
query_posts(array(
  'post_type' => 'page',
  'name'      => '404-page-not-found'
)); ?>

<section class="hero-basic">
  <div class="container">
    <div class="hero-basic--heading">
      <div class="inner"><h1>404 - Page Not Found</h1></div>
    </div>
  </div>
</section>

<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content();?>
  <?php endwhile; ?>
<?php endif;?>
<?php wp_reset_query(); ?>


<?php get_footer(); ?>

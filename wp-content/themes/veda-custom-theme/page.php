<?php get_header(); ?>


<section class="hero-basic">
  <div class="container">
    <div class="hero-basic--heading">
      <div class="inner"><h1><?php the_title(); ?></h1></div>
    </div>
  </div>
</section>

<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>

    <div class="page-content-wrapper">
      <div class="container">
        <?php the_content();?>
      </div>
    </div>

  <?php endwhile; ?>
<?php endif;?>
<?php wp_reset_query(); ?>


<?php get_footer(); ?>

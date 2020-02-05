<?php 
/* Article & Blog posts Grid
========================================================= */

$i++;
$featured = ( is_home() ) ? true : false; // if is Blog Index page ?>

<article id="post-entry-<?= $i; ?>" class="post-entry<?php if ( $featured && $i == 1 ) echo " featured"; ?>">
  <a href="<?php the_permalink(); ?>" title="Read more about <?php the_title(); ?>">
    <div class="inner">

      <?php // Featured Image
      if ( has_post_thumbnail() ) :
        $image = ( $featured && $i == 1 ) ? get_the_post_thumbnail_url($post->ID, 'large') : get_the_post_thumbnail_url($post->ID, 'blog-thumb'); ?>
        <div 
        class      = "post-entry__image"
        aria-label = "Article Post Image"
        style      = "background-image: url(<?= $image; ?>);"
        ></div>
      <?php endif; ?>

      <div class="post-entry__content">
        <div class="title"><h3><?php the_title(); ?></h3></div>
        <div class="excerpt">
          <?php 
          if ( has_excerpt() ) :
            the_excerpt();
          else :
            $content = wp_trim_words( wpautop( get_the_content() ), 35, '');
            echo "<p>{$content}</p>";
          endif; ?>
        </div>
        <div class="button-wrap">
          <?php $text = ( $featured && $i == 1 ) ? "Continue Reading" : "More"; ?>
          <p class="read-more"><?= $text; ?></p>
        </div>
      </div>

    </div>
  </a>
</article>

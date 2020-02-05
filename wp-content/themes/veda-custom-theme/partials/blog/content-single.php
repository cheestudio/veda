<?php // Single Post

if ( is_singular('post') ) :
  $author_bio = get_the_author_meta('description');

elseif ( is_singular('spotlight') ) :
  $age   = get_field('spotlight_age');
  $diag  = get_field('spotlight_diag');
  $quote = get_field('spotlight_quote');
endif; ?>

<article class="post-entry">

  <div class="post-entry__breadcrumbs">
    <?php include( locate_template('partials/breadcrumbs.php') ); ?>
  </div>

  <div class="post-entry__content">
    <?php if ( is_singular('spotlight') ) : ?>
      <?php if ( $quote ) : ?>
        <div class="quote"><p>"<?= $quote; ?>"</p></div>
      <?php endif; ?>
      <?php if ( $diag || $age ) : ?>
        <div class="meta">
          <?php if ( $age ) echo "<p><strong>Age: </strong>{$age}</p>"; ?>
          <?php if ( $diag ) echo "<p><strong>Diagnosis: </strong>{$diag}</p>"; ?>
        </div>
      <?php endif; ?>

    <?php elseif ( has_excerpt() ) : ?>
      <div class="excerpt"><?php the_excerpt(); ?></div>
    <?php endif; ?>
    
    <div class="inner"><?php the_content(); ?></div>
  </div>

  <?php if ( !empty($author_bio) && is_singular('post') ) : ?>
    <div class="post-entry__author">
      <div class="inner">
        <h4>About the Author</h4>
        <p><?= $author_bio; ?></p>
      </div>
    </div>
  <?php endif; ?>

  <?php if ( has_tag() ) :?>
    <div class="post-entry__tags">
      <div class="tags flex">
        <?php the_tags('', ''); ?>
      </div>
    </div>
  <?php endif; ?>

</article>

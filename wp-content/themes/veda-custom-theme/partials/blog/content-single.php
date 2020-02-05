<?php
$author_bio = get_the_author_meta('description'); ?>

<article class="post-entry">

  <div class="post-entry__breadcrumbs">
    <?php include( locate_template('partials/breadcrumbs.php') ); ?>
  </div>

  <div class="post-entry__content">
    <?php if ( has_excerpt() && !is_singular('spotlight') ) : ?>
      <div class="excerpt"><?php the_excerpt(); ?></div>
    <?php endif; ?>
    <?php the_content(); ?>
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

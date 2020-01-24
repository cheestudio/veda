<?php
$author_bio = get_the_author_meta('description'); ?>

<article class="post-entry">
  <div class="post-entry--breadcrumbs">
    <?php include( locate_template('partials/breadcrumbs.php') ); ?>
  </div>
  <div class="post-entry--excerpt"><?php if ( has_excerpt() ) the_excerpt(); ?></div>
  <div class="post-entry--content"><?php the_content(); ?></div>
  <div class="post-entry--author">
    <?php if ( $author_bio ) : ?>
      <div class="inner">
        <h4>About the Author</h4>
        <p><?= $author_bio; ?></p>
      </div>
    <?php endif; ?>

    <?php if ( has_tag() ) :?>
      <div class="tags flex">
        <?php the_tags('', ''); ?>
      </div>
    <?php endif; ?>
  </div>
</article>

<?php // Related Articles & Posts
$posts = get_field('article_related_picker');

if ( $posts ) : $i = 0; ?>
  <section class="related-articles">
    <div class="container">
      <div class="related-articles--title"><h2>Related Articles</h2></div>
      <div class="related-articles--grid">
        <div class="posts-grid">
          <div class="flex">
            <?php foreach ( $posts as $post ) : ?>
              <?php setup_postdata( $post ); ?>
              <?php include( locate_template('partials/blog/content-index.php') ); ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

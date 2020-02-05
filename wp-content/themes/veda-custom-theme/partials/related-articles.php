
<?php // Related Articles & Posts
$posts = get_field('article_related_picker');
$type  = get_post_type();
$cat   = get_the_terms( get_the_ID(), $type );
$i     = 0; ?>

<section class="related-articles">
  <div class="container">
    <div class="related-articles--title"><h2>Related Articles</h2></div>
    <div class="related-articles--grid">
      <div class="posts-grid">
        <div class="flex">
          <?php
          if ( $posts ) :
            foreach ( $posts as $post ) :
              setup_postdata( $post );
              include( locate_template('partials/blog/content-index.php') );
            endforeach;
            wp_reset_postdata();

          else :

            $posts = new WP_Query(array( 
             'post_type'      => $type,
             'category_name ' => $cat,
             'orderby'        => 'date',
             'order'          => 'DESC',
             'posts_per_page' => 3
           ));
            if ( $posts->have_posts() ) :
              while ( $posts->have_posts() ) : $posts->the_post();
                include( locate_template('partials/blog/content-index.php') );
              endwhile;
            endif;
            wp_reset_query();

          endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
/**
 * Single article template.
 *
 * This template is used for all posts of type "article".
 *
 * It includes a different template part for "top level" and "sub" articles.
 */
?>

<?php get_header(); ?>

<?php
// Display Article Index (if page has no parent)
if ( $post->post_parent === 0 ) :
  get_template_part('templates/tpl-article-index');

// Display Child/Single View (page has a parent)
else :

  get_template_part('templates/tpl-article-single');

endif; ?>


<?php get_footer(); ?>

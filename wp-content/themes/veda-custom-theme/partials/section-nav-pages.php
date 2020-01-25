<?php

if ( $post->post_parent ) :
  $ancestors = get_post_ancestors( $post->ID );
  $root      = count($ancestors) - 1;
  $parent    = $ancestors[$root];
else :
  $parent = $post->ID;
endif;

wp_list_pages( array(
  'post_type' => $post->post_type,
  'child_of'  => $parent,
  'title_li'  => '',
  'depth'     => 1
)); ?>

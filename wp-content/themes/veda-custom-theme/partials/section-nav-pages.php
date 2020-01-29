<?php

if ( $post->post_parent ) :
  $ancestors = get_post_ancestors( $post->ID );
  $root      = count($ancestors) - 1;
  $parent    = $ancestors[$root];
else :
  $parent = $post->ID;
endif; ?>

<div class="article-hero--section-nav">
  <div class="toggle">
    <h5><a title="Click to Open/Close">In This Section<span class="close"><i class="las la-plus-circle"></i></span><span class="open"><i class="las la-minus-circle"></i></span></a></h5>
  </div>
  <div class="toggle-content">
    <ul>
      <?php
      wp_list_pages( array(
        'post_type' => $post->post_type,
        'child_of'  => $parent,
        'title_li'  => '',
        'depth'     => 1
      )); ?>
    </ul>
  </div>
</div>

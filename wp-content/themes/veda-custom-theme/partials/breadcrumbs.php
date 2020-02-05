<?php if ( function_exists('bcn_display') ) : ?>
  <div class="breadcrumbs">

    <?php bcn_display();

    // If Single Post, show date
    if ( get_post_type() == 'post' ) echo "<span class='post post-post current-item'>" . get_the_date() . "</span>"; ?>
    
    </div>
<?php endif; ?>

<div class="top-nav-wrap" role="navigation">
  <?php wp_nav_menu( array(
    'theme_location'  => 'top_nav',
    'container'       => '',
    'container_class' => '',
    'menu_id'         => 'desktop-top-menu',
    'menu_class'      => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'           => 1
)); ?>
</div>

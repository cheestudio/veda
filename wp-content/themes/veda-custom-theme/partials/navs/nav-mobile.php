<div class="mobile-nav-wrap" role="navigation">

  <a class="mobile-brand" href="/" title="Home">
    <?php svg( $logo, 'Mobile Site Logo' ); ?>
  </a>

  <a class="navbar-toggle">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>

  <div class="mobile-nav">
    <div class="mobile-nav__main"><?php include( locate_template('partials/navs/nav-main.php') ); ?></div>
    <div class="mobile-nav__main-top"><?php include( locate_template('partials/navs/nav-main-top.php') ); ?></div>
    <div class="mobile-nav__search"><?php get_search_form(); ?></div>
  </div>

</div>

<?php // VARs
$footer_code    = get_field('footer_code', 'option');
$icons          = get_field('social_icons', 'option');
$content        = get_field('footer_content', 'option');
$icon_nonprofit = get_field('footer_nonprofit', 'option');
$icon_amazon    = get_field('footer_amazon', 'option');
$logo           = get_template_directory_uri() . '/assets/img/logo-white.png'; ?>
</main>

<footer role="contentinfo">
	<div class="container flex">

    <div class="footer--content">
      <div class="logo">
        <a href="#top" class="footer-logo"><?php svg( $logo, 'Site Logo' ); ?></a>
      </div>
      <div class="disclaimer"><?= $content; ?></div>
      <?php if ( $icons ) : ?>
        <div class="social-icons">
          <ul>
            <?php foreach ( $icons as $icon ) : ?>
              <li><a href="<?= $icon['link']; ?>" title="Go to <?= $icon['title']; ?>" target="_blank"><?= $icon['icon_class']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <div class="copyright">
       <p>&copy; <?= date('Y'); ?> Vestibular Disorders Association</p>
     </div>
   </div>

   <div class="footer--menu">
     <nav><?php include( locate_template('partials/navs/nav-footer.php') ); ?></nav>
   </div>

   <div class="footer--badges">
     <div class="primary"><?= $icon_nonprofit; ?></div>
     <hr>
     <div class="secondary"><?= $icon_amazon; ?></div>
   </div>

 </div>

 <div class="footer--back-to-top">
   <div class="button-wrap">
     <a href="#top" title="Go to Top of Page">Back To Top</a>
   </div>
 </div>
</footer>

<?php wp_footer(); ?>

<?php if ( $footer_code ) echo $footer_code; ?>
<?php if ( is_front_page() ) : ?>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?php endif; ?>

</body>
</html>

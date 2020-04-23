<?php // Sponsored Ad
$sponsored = get_field('sponsored_ad'); ?>
<?php if ( $sponsored ) : ?>
  <section class="sponsored">
    <div class="container flex">
      <div class="sponsored--title"><h5>Sponsored</h5></div>
      <div class="sponsored--content">
        <div class="inner"><?= $sponsored; ?></div>
      </div>
    </div>
  </section>
<?php endif; ?>

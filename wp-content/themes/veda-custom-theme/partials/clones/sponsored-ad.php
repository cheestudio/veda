<?php // Sponsored Ad
$sponsored = get_field('sponsored_ad'); ?>
<?php if ( $sponsored ) : ?>
  <section class="sponsored-ad">
    <div class="container flex">
      <div class="sponsored-ad--title"><h5>Sponsored Ad</h5></div>
      <div class="sponsored-ad--content">
        <div class="inner"><?= $sponsored; ?></div>
      </div>
    </div>
  </section>
<?php endif; ?>

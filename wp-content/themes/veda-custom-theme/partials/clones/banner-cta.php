<?php // Donate CTA
$group = get_field('banner_cta_group');
if ( $group ) :
  $buttons = $group['buttons_rep']; ?>
  <section class="banner-cta">
    <div class="container flex">

      <?php if ( $group['image'] ) : ?>
        <div class="banner-cta--image"><?php echo wp_get_attachment_image( $group['image']['id'], 'large' ); ?></div>
      <?php endif; ?>

      <div class="banner-cta--content">
        <div class="inner"><h2><?= $group['heading']; ?></h2></div>
        <?php if ( $buttons ) : ?>
          <div class="button-wrap">
            <?php foreach ( $buttons as $button ) : ?>
              <a href="<?= $button['link']['url']; ?>" title="<?= $button['link']['title']; ?>" <?= $button['link']['target'] ? "target='_blank'" : NULL; ?>><?= $button['link']['title']; ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      
    </div>
  </section>
<?php endif; ?>

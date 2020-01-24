<?php // Donate CTA
$group = get_field('banner_cta_group');
if ( $group ) :
  $buttons = $group['buttons_rep']; ?>
  <section class="banner-cta">
    <div class="container flex">
      <div class="banner-cta--image"><?php echo wp_get_attachment_image( $group['image']['id'], 'large' ); ?></div>
      <div class="banner-cta--content">
        <div class="inner"><?= $group['heading']; ?></div>
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

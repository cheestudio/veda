<?php
$group = get_field('banner_menu_group', 'option');

if ( $group ) :
$links = $group['links_rep']; ?>

  <section class="banner-menu">
    <div class="flex">
      <div class="banner-menu--content light">
        <div class="inner"><?= $group['content']; ?></div>
        <?php if ( $group['button'] ) : ?>
          <div class="button-wrap">
            <a href="<?= $group['button']['url']; ?>" title="<?= $group['button']['title']; ?>" <?= $group['button']['target'] ? "target='_blank'" : NULL; ?>><?= $group['button']['title']; ?></a>
          </div>
        <?php endif; ?>
      </div>

      <div class="banner-menu--image" aria-label="Decorative Image" style="background-image: url(<?= $group['image']['sizes']['medium_large']; ?>);"></div>

      <?php if ( $links ) : ?>
        <div class="banner-menu--menu">
          <div class="banner-menu--menu__links">
            <?php foreach ( $links as $button ) : ?>

              <div class="link">
                <a 
                  href="<?= $button['link']['url']; ?>" 
                  title="Link to <?= $button['link']['title']; ?>" 
                  <?= $button['link']['target'] ? "target='_blank'" : NULL; ?>
                  >
                  <h5><?= $button['link']['title']; ?></h5>
                  <i class="las la-arrow-circle-right"></i>
                </a>
              </div>

            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>

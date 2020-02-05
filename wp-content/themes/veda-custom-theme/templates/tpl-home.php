<?php

/* Template Name: Home
========================================================= */ ?>
<?php get_header(); ?>


<?php // Hero
$hero = get_field('home_hero_group');
if ( $hero ) : ?>
  <section class="home-hero">
    <div class="container flex">
      <div class="home-hero--content"><?= $hero['heading']; ?></div>
      <div class="home-hero--image"><?php echo wp_get_attachment_image( $hero['image']['id'], 'large' ); ?></div>
    </div>
  </section>
<?php endif; ?>


<?php // Intro
$group = get_field('home_intro_group');
if ( $group ) :
  $cards = $group['cards_rep']; ?>
  <section class="home-intro">
    <div class="flex">

      <div class="home-intro--content flex light">
        <div class="inner">
          <?= $group['content']; ?>
          <?php if ( $group['content_button'] ) : ?>
            <div class="button-wrap light">
              <a class="button" href="<?= $group['content_button']['url']; ?>" title="<?= $group['content_button']['title']; ?>" <?= $group['content_button']['target'] ? "target='_blank'" : NULL; ?>><?= $group['content_button']['title']; ?></a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <?php if ( $cards ) : ?>
        <div class="home-intro--cards">
          <div class="flex">
            <?php foreach ( $cards as $card ) : ?>

              <div class="card">
                <a 
                href  = "<?= $card['link']['url']; ?>"
                title = "Go to <?= $card['link']['title']; ?>"
                <?= $card['link']['target'] ? "target='_blank'" : NULL; ?>
                >
                <div class="card__image"><?php echo wp_get_attachment_image( $card['image']['id'], '450' ); ?></div>
                <div class="card__content"><?= $card['content']; ?></div>
                <div class="card__link"><p>More</p></div>
              </a>
            </div>

          <?php endforeach; ?>
        </div>
      </div>
    <?php endif ?>

  </div>
</section>
<?php endif; ?>


<?php // Events & Links
$blocks = get_field('home_blocks_rep'); ?>
<?php if ( $blocks ) : ?>
  <section class="home-blocks">
    <div class="container">
      <div class="home-blocks--grid">
        <div class="flex">
          <?php foreach ( $blocks as $block ) : ?>

            <div class="block">
              <a 
              href  = "<?= $block['link']['url']; ?>"
              title = "Go to <?= $block['link']['title']; ?>"
              <?= $block['link']['target'] ? "target='_blank'" : NULL; ?>
              >
              <div class="block__image" aria-label="Related Link Image" style="background-image: url(<?= $block['image']['sizes']['medium_large']; ?>);"></div>
              <div class="block__content">
                <div class="inner"><?= $block['content']; ?></div>
                <?php if ( $block['link'] ) : ?>
                  <div class="button-wrap">
                    <p><?= $block['link']['title']; ?></p>
                  </div>
                <?php endif; ?>
              </div>
            </a>
          </div>

        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>


<?php // Testimonials
$quotes = get_field('testimonials_rep');
if ( $quotes ) : ?>
  <section class="home-testimonials">
    <div class="container">
      <div class="home-testimonials--content">
        <div class="slideshow-wrap">
          <?php foreach ( $quotes as $quote ) : ?>

            <div class="quote">
              <div class="flex">
                <div class="quote__image"><?php echo wp_get_attachment_image( $quote['image']['id'], 'medium_large' ); ?></div>
                <div class="quote__content">
                  <div class="inner"><?= $quote['content']; ?></div>
                  <?php if ( $quote['link'] ) : ?>
                    <div class="button-wrap">
                      <a class="button" href="<?= $quote['link']['url']; ?>" title="<?= $quote['link']['title']; ?>" <?= $quote['link']['target'] ? "target='_blank'" : NULL; ?>><?= $quote['link']['title']; ?></a>
                    </div>
                  <?php endif; ?>
                  <div class="nav-arrows">
                    <a class="prev-arrow" title="Previous Slide"><i class="las la-arrow-circle-left"></i></a>
                    <a class="next-arrow" title="Next Slide"><i class="las la-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>


<?php // Banner CTA
include( locate_template('partials/clones/banner-cta.php') ); ?>


<?php get_footer(); ?>

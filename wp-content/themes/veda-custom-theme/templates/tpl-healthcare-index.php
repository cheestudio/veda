<?php
/* Template Name: Healthcare Index
========================================================= */ ?>
<?php get_header(); ?>


<section class="hero-basic">
  <div class="container">
    <div class="hero-basic--heading">
      <div class="inner"><h1>Healthcare <br>Directory</h1></div>
    </div>
    <div class="hero-basic--search">
      <div class="inner">
        <form>
          <input type="text" name="" value="" placeholder="Search by Name">
          <select id="healthcare-specialities">
            <option value="">Specialties</option>
            <option value="">Value 1</option>
            <option value="">Value 2</option>
            option
          </select>
          <input type="submit" name="" value="Search">
        </form>
      </div>
    </div>
  </div>
</section>


<div class="healthcare-index">
  <div class="container">
    <div class="healthcare-index--breadcrumbs">
      <?php include( locate_template('partials/breadcrumbs.php') ); ?>
    </div>

    <div class="healthcare-index--intro">
      <div class="flex">
        <div class="search-term"><p>Displaying Results for "Search Term"</p></div>
        <div class="faq-link"><a href="/faq/" title="Go to Directory FAQ">Directory FAQ</a></div>
      </div>
    </div>

    <div class="healthcare-index--results">
      <div class="inner">

        <div class="member">
          <div class="flex">
            <div class="member--image">
              <img src="https://uploads-ssl.webflow.com/5cd8dcc08463a5d465b65258/5d896ef4ecc118c2f5333ed8_ashley-yates_0.jpg" alt="">
            </div>
            <div class="member--details flex">
              <div class="member--details__name">
                <h3>Provider Name</h3>
                <p><a href="PERMALINK" title="Link to PROVIDER">Ashley Yates</a></p>
              </div>
              <div class="member--details__specialty">
                <h3>Specialty</h3>
                <p>Physical Therapy</p>
              </div>
              <div class="member--details__distance">
                <h3>Distance</h3>
                <p>0.8 mi</p>
              </div>
              <div class="member--details__link">
                <div class="button-wrap">
                  <a href="./member-example/" title="Learn more about PROVIDER">Details</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
      <nav class="healthcare-index--page-nav">
        <nav class="post-nav"><?php post_pagination( $wp_query->max_num_pages ); ?></nav>
      </nav>
    <?php endif; ?>

    <div class="healthcare-index--disclaimer">
      <p>* Provider has not opted into the VeDA Vestibular provider directory, but is listed here from a referral or recommendation from one of our patients.</p>
    </div>
  </div>
</div>


<?php // Banner Menu
include( locate_template('partials/banner-menu.php') ); ?>


<?php // Sponsored Ad
include( locate_template('partials/clones/sponsored-ad.php') ); ?>


<?php get_footer(); ?>

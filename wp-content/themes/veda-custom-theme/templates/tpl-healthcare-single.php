<?php
/* Template Name: Healthcare Single
========================================================= */ ?>
<?php get_header(); ?>


<section class="hero-basic">
  <div class="container">
    <div class="hero-basic--heading">
      <div class="inner">
        <p><a href="/coping-support/healthcare-directory/" title="Back to Healthcare Directory"><i class="las la-angle-double-left"></i> Back to Results</a></p>
        <h1>Healthcare <br>Directory</h1>
      </div>
    </div>
  </div>
</section>


<div class="healthcare-single">
  <div class="container">
    <div class="healthcare-single--breadcrumbs">
      <?php include( locate_template('partials/breadcrumbs.php') ); ?>
    </div>
    
    <?php // IF IS MEMBER
    //if (  ) : ?>
    <div class="healthcare-single--member">
      <div class="member">
        <div class="flex">
          <div class="member--image">
            <div class="member--image__headshot">
              <img src="https://uploads-ssl.webflow.com/5cd8dcc08463a5d465b65258/5d896ef4ecc118c2f5333ed8_ashley-yates_0.jpg" alt="">
            </div>
            <div class="member--image__company">
              <img src="https://uploads-ssl.webflow.com/5cd8dcc08463a5d465b65258/5d8b935c251c56d0bab4e84c_logoipsum.jpg" alt="" class="second--provider--image">
            </div>
          </div>

          <div class="member--details">
            <div class="member--details__name">
              <h2>Ashley Yates</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. <strong>Max: 250 character description.</strong></p>
            </div>

            <div class="member--details__email">
              <h6>Email</h6>
              <p><a href="mailto:a.yates@rehab.plus" title="Email PROVIDER">a.yates@rehab.plus</a></p>
            </div>

            <div class="member--details__website">
              <h6>Website</h6>
              <p><a href="http://www.rehabplustimmins.ca/" title="Go to PROVIDER's website" target="_blank">http://www.rehabplustimmins.ca/</a></p>
            </div>

            <div class="member--details__locations">
              <h6>Locations</h6>
              <p>
                <a href="#" title="" target="_blank">REHAB PLUS</a><br>
                ‍181 Dale Ave<br>
                Timmins, ON P4N1M3<br>
                Canada<br>
                <a href="tel:+1-<?= sanitize_title_with_dashes( $NUMBER ); ?>" title="Call Us">705 264 4050</a><br>
              </p>
            </div>

            <div class="member--details__specialty">
              <h6>Specialties</h6>
              <ul>
                <li>Physical Therapist</li>
              </ul>
            </div>

            <div class="member--details__practice">
              <h6>Types of Practice</h6>
              <ul>
                <li>Physical Therapy</li>
              </ul>
            </div>

            <div class="member--details__certifs">
              <h6>Certifications</h6>
              <ul>
                <li>BA Kinesiology Honours - Laurier University 2008 ** graduated with distinction</li>
                <li>Masters of Physical Therapy - University of Western Ontario 2010</li>
                <li>Course: Vestibular Rehabilitaiton: A Comprehensive Introduction - Dizziness and Balance Rehabilitation Clinic (Bernard Tonks)</li>
              </ul>
            </div>

            <div class="member--details__assoc">
              <h6>Professional Associations</h6>
              <ul>
                <li>Lorem Ipsum Dolor</li>
                <li>Sit Amet Ipsum Dolor</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php // ELSE IS NOT MEMBER
    //elseif (  ) : ?>
    <div class="healthcare-single--non-member">
      <div class="non-member">
        <div class="inner">
          <h2>LINDSEY ISABELLA</h2>
          <p>This provider is not currently a member of VeDA. No further information is available. If you are this provider <a href="#" title="Claim Provider Page">click here</a> to claim this page.</p>
        </div>
      </div>
    </div>

    <?php //endif; ?>
  </div>
</div>


<?php // Banner Menu
include( locate_template('partials/banner-menu.php') ); ?>


<?php get_footer(); ?>

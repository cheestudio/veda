<?php get_header(); ?>


<?php // Display Article Index (if page has a parent)
if ( $post->post_parent === 0 ) :
  get_template_part('templates/tpl-article-index');


else : // Display Child/Single View (page has no parent)?>

<?php // Hero
$category = wp_get_post_terms( $post->ID, 'article_category' ); ?>
<section class="article-hero">
  <div class="article-hero--heading">
    <div class="inner">
      <?php if ( $category ) echo "<p>{$category[0]->name}</p>"; ?>
      <h1><?php the_title(); ?></h1>
    </div>
  </div>

  <?php include( locate_template('partials/section-nav-pages.php') ); ?>
</section>


<?php // Main Content
if ( have_posts() ) : ?>
  <section class="article-main-single">
    <div class="container">
      <div class="article-main-single--content">
        <?php include( locate_template('partials/breadcrumbs.php') ); ?>
        <div class="inner">
          <div class="excerpt"><?php the_excerpt(); ?></div>
          <?php while ( have_posts() ) : the_post();
            the_content();
          endwhile; ?>
        </div>
      </div>

      <?php // Loop through & collect link toggles
      if ( have_rows('article_links_group') ) : $rows = array();
        while ( have_rows('article_links_group') ) : the_row();
          $rows = get_row(true);
        endwhile; ?>

        <?php // If at least one is enabled, loop through & display matching one(s)
        if ( in_array(true, $rows) === true ) : ?>
          <div class="article-main-single--links">
            <div class="inner flex">

              <?php // Loop output
              foreach ( $rows as $key => $value ) :
                if ( $value ) :
                  switch ( $key ) : 

                   // Read More Button
                   case 'read_choice' :
                   echo "<a 
                   class = 'read'
                   id    = 'article-readmore-toggle'
                   title = 'Click to Read the Full Article'
                   >Read Full Article</a>";
                   break;

                   // Download PDF
                   case 'pdf_choice' :
                   $pdf_file = $rows['pdf_file']['url'];
                   if ( !empty($pdf_file) ) echo "<a 
                   href   = '{$pdf_file}'
                   class  = 'pdf' title='Click to Download PDF'
                   target = '_blank'
                   >Download PDF<i class='las la-download'></i></a>";
                   break;

                   // Watch Video
                   case 'video_choice' :
                   $video_url = $rows['video_link'];
                   if ( !empty($video_url) ) echo "<a 
                   href='{$video_url}' 
                   class  = 'video'
                   title  = 'Click to Watch Video'
                   target = '_blank'
                   >Watch Video<i class='las la-video'></i></a>";
                   break;

                   // Download One-Pager
                   case 'one_pager_choice' :
                   $pager_file = $rows['one_pager_file']['url'];
                   if ( !empty($pager_file) ) echo "<a 
                   href='{$pager_file}' 
                   class  = 'pager'
                   title  = 'Click to Download One-Pager'
                   target = '_blank'
                   >One-Pager<i class='las la-download'></i></a>";
                   break;

                 endswitch;
               endif;
             endforeach;
           endif; ?>
         </div>
       </div>
     <?php endif; ?>
   </div>
 </section>
<?php endif;?>
<?php wp_reset_query(); ?>


<?php // References
include( locate_template('partials/clones/references.php') ); ?>


<?php // Related Articles
include( locate_template('partials/related-articles.php') ); ?>


<?php // Banner Menu
include( locate_template('partials/banner-menu.php') ); ?>


<?php // Sponsored Ad
include( locate_template('partials/clones/sponsored-ad.php') ); ?>


<?php endif; ?>


<?php get_footer(); ?>


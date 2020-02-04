<?php
/* Theme Initialization
========================================================= */
require_once locate_template('/init/shortcodes.php');    // Shortcodes
require_once locate_template('/init/constants.php');    // Initial theme setup and constants
require_once locate_template('/init/scripts.php');    // Theme Scripts and Stylesheets
require_once locate_template('/init/helpers.php');   // All other custom functions
require_once locate_template('/init/cpt.php');      // Custom Post Types


/* Numerical Pagination
========================================================= */
function post_pagination( $pages = '', $range = 3 ) {
  $showitems = ( $range * 2 ) + 1;
  global $paged;

  if ( empty($paged) ) $paged = 1;
    if ( $pages == '' ) {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
    if ( !$pages ) {
      $pages = 1;
    }
  }

  if ( 1 != $pages ) {
    if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages )
      echo "<a class='first-link' href='" . get_pagenum_link(1) . "' title='Go to First Page'><<</a>";
    if ( $paged != 1 ) 
      echo "<a class='previous-link' href='" . get_pagenum_link($paged - 1) . "' title='Go to Previous Page'><</a>";

    for ( $i = 1; $i <= $pages; $i++ ) {
      if ( 1 != $pages && ( !($i >= $paged+$range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) ) {
      echo ($paged == $i) ? "<span class='current'>{$i}</span>" : "<a href='" . get_pagenum_link($i) . "' class='inactive' title='Go to Page {$i}'>{$i}</a>";
      }
    }

    if ( $paged < $pages ) 
      echo "<a class='next-link' href='" . get_pagenum_link($paged + 1) . "' title='Go to Next Page'>></a>";
    if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages )
      echo "<a class='last-link' href='" . get_pagenum_link($pages) . "' title='Go to Last Page'>>></a>";
  }
}


/* The_content word char max filter
========================================================= */
function the_content_max_words( $text ) {
  $length = 200;
  // don't cut if too short
  if ( strlen($text)<$length+10 ) return $text;

  // find next space after desired length
  $break_pos = strpos( $text, ' ', $length );
  $visible   = substr( $text, 0, $break_pos );
  return balanceTags( $visible ) . "";
} 


/* Add color presets for Beaver Builder
========================================================= */
function my_builder_color_presets( $colors ) {
    $colors = array();
      
      $colors[] = '1796a4';
      $colors[] = '215378';
      $colors[] = 'b3e1e8';
      $colors[] = 'ea8024';
      $colors[] = 'f4f7e2';
      $colors[] = '5c5c5c';
      $colors[] = 'ffffff';
      $colors[] = '000000';
  
    return $colors;
}
add_filter( 'fl_builder_color_presets', 'my_builder_color_presets' );

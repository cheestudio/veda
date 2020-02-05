<?php // Page Title & Archive Type VARs

$name = NULL;

if ( is_home() ) :
  $title = "Blog";
  $type  = "category";

elseif ( is_category() ) :
  $name  = "Category";
  $type  = "category";
  $title = single_tag_title('', false);
  
elseif ( is_tag() ) :
  $name  = "Tag";
  $type  = "post_tag";
  $title = single_tag_title('', false);

elseif ( is_author() ) :
  $name  = "Author";
  $title = get_the_author();

elseif ( is_search() ) :
  $name  = "Search Results For:";
  $title = get_search_query();

else :
  $title = get_the_title();

endif; ?>

<section class="hero-basic">
  <div class="container">
    <div class="hero-basic--heading">
      <div class="inner">
        <?php if ( isset($name) ) echo "<p>{$name}</p>"; ?>
        <h1><?= $title; ?></h1>
      </div>
    </div>
  </div>
</section>


<?php if ( have_posts() || is_search() ) : $i = 0; ?>
<section class="posts-index-filter">
  <div class="container">
    <div class="posts-index-filter--content">
      <div class="flex">
        <?php if ( is_search() ) : ?>
          <h3>New Search</h3>
          <div class="posts-search-form"><?php get_search_form(); ?></div>

          <?php else : ?>
            <h3>Filter By<?php if ($name) echo " {$name}:"; ?></h3>

          <?php // Dropdown Options
          if ( is_author() ) :
            // AUTHORS NOT USED
            wp_dropdown_users( array(
              'show_option_none' => 'Select Author',
              'id' => 'terms-filter'
            ) );
          else :
            $terms = get_terms( array(
              'taxonomy' => $type
            ) );
          endif; ?>

          <?php if ( $terms ) : ?>
            <select id="terms-filter">
              <option label="Select One" value="" disabled selected="selected">Select One</option>
              <?php foreach ( $terms as $term ) :
                $name = $term->name;
                $tax  = ( is_tag() ) ? 'tag' : $term->taxonomy;
                $link = "{$tax}/{$term->slug}/";
                echo "<option label='{$name}' value='{$link}'>{$name}</option>"; ?>
              <?php endforeach; ?>
            </select>
          <?php endif; ?>

          <script type="text/javascript">
            var dropdown = document.getElementById("terms-filter");
            if ( dropdown.length > 0 ) {
              function onCatChange() {
                if ( !dropdown.options.disabled ) {
                  location.href = dropdown.options[dropdown.selectedIndex].value;
                }
              }
              dropdown.onchange = onCatChange;
            }
          </script>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<section class="posts-index">
  <div class="container">
    <div class="posts-index--grid">
      <div class="posts-grid">
        <div class="flex">
          <?php if ( !have_posts() ) : ?>
            <div class="inner">
              <h3>No Results Found</h3>
            </div>
            <?php else : ?>
              <?php while ( have_posts() ) : the_post(); ?>
                <?php include( locate_template('partials/blog/content-index.php') ); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav class="posts-index--nav">
          <nav class="post-nav"><?php post_pagination( $wp_query->max_num_pages ); ?></nav>
        </nav>
      <?php endif; ?>
    <?php endif; ?>

  </div>
</section>

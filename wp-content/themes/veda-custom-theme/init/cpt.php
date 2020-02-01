<?php
/* Cusom Post Types
========================================================= */

// Register Custom Article Post Type
function article_post_type() {
  $labels = array(
    'name'                => _x( 'Articles', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Article', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Articles', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Article:', 'text_domain' ),
    'all_items'           => __( 'All Articles', 'text_domain' ),
    'view_item'           => __( 'View Article', 'text_domain' ),
    'add_new_item'        => __( 'Add New Article', 'text_domain' ),
    'add_new'             => __( 'New Article', 'text_domain' ),
    'edit_item'           => __( 'Edit Article', 'text_domain' ),
    'update_item'         => __( 'Update Article', 'text_domain' ),
    'search_items'        => __( 'Search Articles', 'text_domain' ),
    'not_found'           => __( 'No Articles found', 'text_domain' ),
    'not_found_in_trash'  => __( 'No Articles found in Trash', 'text_domain' )
);

  $args = array(
    'label'               => __( 'Article', 'text_domain' ),
    'description'         => __( 'Article information pages', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 
        'title', 
        'editor', 
        'thumbnail', 
        'excerpt', 
        'page-attributes', 
        'revisions'
    ),
    'taxonomies'          => array( 'article_category' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'show_in_rest'        => true,
    'menu_icon'           => 'dashicons-format-aside',
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
    'rewrite'             => array( 
        'slug'       => 'article',
        'with_front' => false
    ),
);
  register_post_type( 'article', $args );
}
// Hook into the 'init' action
add_action( 'init', 'article_post_type', 0 );


// Register Custom Article Taxonomy
function custom_article_category_taxonomy()  {
  $labels = array(
    'name'                       => _x( 'Article Categories', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Article Category', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Categories', 'text_domain' ),
    'all_items'                  => __( 'All Article Categories', 'text_domain' ),
    'parent_item'                => __( 'Parent Article Category', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Article Category:', 'text_domain' ),
    'new_item_name'              => __( 'New Article Category Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Article Category', 'text_domain' ),
    'edit_item'                  => __( 'Edit Article Category', 'text_domain' ),
    'update_item'                => __( 'Update Article Category', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate Article Categories with commas', 'text_domain' ),
    'search_items'               => __( 'Search Article Categories', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove Article Categories', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used Article Categories', 'text_domain' ),
);

  $rewrite = array(
    'slug'                       => 'article_category',
    'with_front'                 => true,
    'hierarchical'               => true,
);

  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'query_var'                  => 'article_category',
    'rewrite'                    => $rewrite,
);

  register_taxonomy( 'article_category', 'article', $args );
}

// Hook into the 'init' action
add_action( 'init', 'custom_article_category_taxonomy', 0 );

<?php

function my_scripts_method() {
	wp_enqueue_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js");
	wp_enqueue_script('mousewheel', get_stylesheet_directory_uri() . '/js/jquery.mousewheel.min.js', array( 'jquery' ));
	wp_enqueue_script('cycle2', get_stylesheet_directory_uri() . '/js/jquery.cycle2.min.js', array( 'jquery' ));
    wp_enqueue_script('underscore', get_stylesheet_directory_uri() . '/js/junderscore.js', array( 'jquery' ));
    // wp_enqueue_script('lazyload', get_stylesheet_directory_uri() . '/js/lazyload-dev.js', array( 'jquery' ));
	wp_enqueue_script('app', get_stylesheet_directory_uri() . '/js/app.js', array( 'jquery' ));
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

add_theme_support( 'post-thumbnails', array( 'post', 'archive', 'stylist', 'page' ) );


register_nav_menus(
	array(
  	 'archive_nav' => 'Archive Menu',
  	 'stylist_nav' =>'Stylist Menu'
   )
);

// Register Custom Post Type Archive
function custom_pt_archive() {

  $labels = array(
    'name'                => _x( 'Archive', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Archive', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Archive', 'text_domain' ),
    'name_admin_bar'      => __( 'Archive', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
    'all_items'           => __( 'Items', 'text_domain' ),
    'add_new_item'        => __( 'Add Item', 'text_domain' ),
    'add_new'             => __( 'Add New Item', 'text_domain' ),
    'new_item'            => __( 'New Item', 'text_domain' ),
    'edit_item'           => __( 'Edit Item', 'text_domain' ),
    'update_item'         => __( 'Update Item', 'text_domain' ),
    'view_item'           => __( 'View Item', 'text_domain' ),
    'search_items'        => __( 'Search Items', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'archive', 'text_domain' ),
    'description'         => __( 'Archive', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'thumbnail' ),
    'taxonomies'          => array( 'archive-category' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_icon'           => 'dashicons-desktop',
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'query_var' => true,
  );
  register_post_type( 'archive', $args );
  flush_rewrite_rules(false);

}

// Hook into the 'init' action
add_action( 'init', 'custom_pt_archive' );

function archive_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Categories', 'text_domain' ),
    'all_items'                  => __( 'All Categories', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Category', 'text_domain' ),
    'add_new_item'               => __( 'New Category', 'text_domain' ),
    'edit_item'                  => __( 'Edit Category', 'text_domain' ),
    'update_item'                => __( 'Update Category', 'text_domain' ),
    'view_item'                  => __( 'View Category', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'rewrite' => array( 'slug' => 'archive-category'),
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'query_var'                  => true, 
  );
  register_taxonomy( 'archive-category', array( 'archive' ), $args );

wp_insert_term( 'editorial', 'archive-category' );
wp_insert_term( 'art', 'archive-category' );
wp_insert_term( 'celebrity', 'archive-category' );
}

// Hook into the 'init' action
add_action( 'init', 'archive_taxonomy' );


// Register Custom Post Type Stylist
function custom_pt_stylist() {

  $labels = array(
    'name'                => _x( 'Stylist', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Stylist', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Stylist', 'text_domain' ),
    'name_admin_bar'      => __( 'Stylist', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
    'all_items'           => __( 'Items', 'text_domain' ),
    'add_new_item'        => __( 'Add Item', 'text_domain' ),
    'add_new'             => __( 'Add New Item', 'text_domain' ),
    'new_item'            => __( 'New Item', 'text_domain' ),
    'edit_item'           => __( 'Edit Item', 'text_domain' ),
    'update_item'         => __( 'Update Item', 'text_domain' ),
    'view_item'           => __( 'View Item', 'text_domain' ),
    'search_items'        => __( 'Search Items', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'stylist', 'text_domain' ),
    'description'         => __( 'Stylist', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'thumbnail' ),
    'taxonomies'          => array( 'stylist-category' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_icon'           => 'dashicons-desktop',
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'stylist', $args );
  flush_rewrite_rules(false);

}

// Hook into the 'init' action
add_action( 'init', 'custom_pt_stylist', 0 );

function stylist_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Categories', 'text_domain' ),
    'all_items'                  => __( 'All Categories', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Category', 'text_domain' ),
    'add_new_item'               => __( 'New Category', 'text_domain' ),
    'edit_item'                  => __( 'Edit Category', 'text_domain' ),
    'update_item'                => __( 'Update Category', 'text_domain' ),
    'view_item'                  => __( 'View Category', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'rewrite' => array( 'slug' => 'stylist-category' ),
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'stylist-category', array( 'stylist' ), $args );


wp_insert_term(  'stylist-category' );
}

// Hook into the 'init' action
add_action( 'init', 'stylist_taxonomy', 0 );


?>

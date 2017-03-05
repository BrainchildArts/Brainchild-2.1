<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

add_filter( 'get_the_archive_title', function ($title) {

    if ( (is_category()) || (is_tag()) ) {

            $title = single_cat_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});

add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
    function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}

//CHANGE NUMBER OF PRODUCTS PER PAGE
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 999;' ), 20 );

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


/**
Custom taxonomies
**/
add_action( 'init', 'create_creator_taxonomy' );

function create_creator_taxonomy() {
  $labels = array(
    'name'                           => 'Creators',
    'singular_name'                  => 'Creator',
    'search_items'                   => 'Search Creators',
    'all_items'                      => 'All Creators',
    'edit_item'                      => 'Edit Creator',
    'update_item'                    => 'Update Creator',
    'add_new_item'                   => 'Add New Creator',
    'new_item_name'                  => 'New Creator Name',
    'menu_name'                      => 'Creators',
    'view_item'                      => 'View Creator',
    'popular_items'                  => 'Popular Creator',
    'separate_items_with_commas'     => 'Separate creators with commas',
    'add_or_remove_items'            => 'Add or remove creators',
    'choose_from_most_used'          => 'Choose from the most used creators',
    'not_found'                      => 'No creators found'
  );
  register_taxonomy(
    'creator',
    'product',
    array(
      'label' => __( 'Creator' ),
      'hierarchical' => false,
      'labels' => $labels,
      'public' => true,
      'show_in_nav_menus' => false,
      'show_tagcloud' => false,
      'show_admin_column' => true
    )
  );
}

// INCLUDE CREATOR IN PRODUCT LIST
add_action( 'woocommerce_shop_loop_item_title', 'creators_line', 11 );

add_action( 'woocommerce_single_product_summary', 'creators_line', 5 );



function creators_line () {
  $list = get_the_term_list( get_the_id(), 'creator' );
  echo '<h3 class="creator">' . $list . "</h3>";
}


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );




// Register Artist Post Type
function register_artists() {

  $labels = array(
    'name'                  => _x( 'Artists', 'Post Type General Name', 'artists_text' ),
    'singular_name'         => _x( 'Artist', 'Post Type Singular Name', 'artists_text' ),
    'menu_name'             => __( 'Artists', 'artists_text' ),
    'name_admin_bar'        => __( 'Artist', 'artists_text' ),
    'archives'              => __( 'Artist Archives', 'artists_text' ),
    'attributes'            => __( 'Artist Attributes', 'artists_text' ),
    'parent_item_colon'     => __( 'Parent Artist:', 'artists_text' ),
    'all_items'             => __( 'All Artists', 'artists_text' ),
    'add_new_item'          => __( 'Add New Artist', 'artists_text' ),
    'add_new'               => __( 'Add New', 'artists_text' ),
    'new_item'              => __( 'New Artist', 'artists_text' ),
    'edit_item'             => __( 'Edit Artist', 'artists_text' ),
    'update_item'           => __( 'Update Artist', 'artists_text' ),
    'view_item'             => __( 'View Artist', 'artists_text' ),
    'view_items'            => __( 'View Artist', 'artists_text' ),
    'search_items'          => __( 'Search Artist', 'artists_text' ),
    'not_found'             => __( 'Not found', 'artists_text' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'artists_text' ),
    'featured_image'        => __( 'Artist Image', 'artists_text' ),
    'set_featured_image'    => __( 'Set Artist image', 'artists_text' ),
    'remove_featured_image' => __( 'Remove Artist image', 'artists_text' ),
    'use_featured_image'    => __( 'Use as Artist image', 'artists_text' ),
    'insert_into_item'      => __( 'Insert into Artist', 'artists_text' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Artist', 'artists_text' ),
    'items_list'            => __( 'Artists list', 'artists_text' ),
    'items_list_navigation' => __( 'Artists list navigation', 'artists_text' ),
    'filter_items_list'     => __( 'Filter Artists list', 'artists_text' ),
  );
  $rewrite = array(
    'slug'                  => 'lineup',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => false,
  );
  $args = array(
    'label'                 => __( 'Artist', 'artists_text' ),
    'description'           => __( 'Artists playing the festival', 'artists_text' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', ),
    'taxonomies'            => array( 'category', 'post_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-smiley',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'post',
    'show_in_rest'          => true,
  );
  register_post_type( 'artists', $args );

}
add_action( 'init', 'register_artists', 0 );



 function front_page_menu_item(){
   add_menu_page('Front Page', 'Front Page', 'manage_options', '/post.php?post=4&action=edit', '', 'dashicons-welcome-write-blog', 4);
 }
 add_action('admin_menu','front_page_menu_item');

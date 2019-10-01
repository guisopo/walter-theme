<?php
/**
 * Folio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Walter
 */

require get_template_directory().'/inc/cleanup.php';
require get_template_directory().'/inc/enqueue.php';
require get_template_directory().'/inc/menu-management.php';
require get_template_directory().'/inc/walter-template-helpers.php';

function custom_query( $query ) {
  // Run only on the homepage
  if ( $query->is_home() && $query->is_main_query() ) {
    $query->set( 'post_type', 'works' );
    $query->set( 'posts_per_page', 5 );
  }
}
// Hook my above function to the pre_get_posts action
add_action( 'pre_get_posts', 'custom_query');
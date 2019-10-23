<?php
/** 
 * Remove version string from js and css
 * 
 * @package Walter
 */

function walter_remove_wp_version( $src ) {
  $parts = explode( '?ver', $src );
  return $parts[0];
  /** 
   * Remove generator with wordpress version
   */
  remove_action('wp_head', 'wp_generator');
}

add_filter( 'script_loader_src', 'walter_remove_wp_version', 15, 1 );
add_filter( 'style_loader_src', 'walter_remove_wp_version', 15, 1 );
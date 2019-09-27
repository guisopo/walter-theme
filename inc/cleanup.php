<?php
/** 
 * Remove version string from js and css
 * 
 * @package Artist
 */

function artist_remove_wp_version( $src ) {
  /** 
   * Remove generator with wordpress version
   */
  remove_action('wp_head', 'wp_generator'); 
  /**
   * Remove wordpress version from css and js files name strings
   */
	global $wp_version;
	parse_str( parse_url($src, PHP_URL_QUERY), $query );
	if ( !empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}

add_filter( 'script_loader_src', 'artist_remove_wp_version' );
add_filter( 'style_loader_src', 'artist_remove_wp_version' );
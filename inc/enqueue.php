<?php
/**
 * Enqueue scripts and styles
 * 
 * @package Walter
 */

function walter_admin_scripts() {
  /**
   * Main JS file
   */
  if ( WP_DEBUG ) {
    wp_enqueue_script( 'site', 'http://localhost:8080/site.js', [], '1.0.0', true );
  }

  if ( ! WP_DEBUG ) {
    wp_enqueue_script( 'walter-script', get_template_directory_uri() . '/js/build/main.bundle.js', null, null, true);
  }
}

function walter_load_css() {
  /**
   * Main CSS file
   */
  if ( WP_DEBUG ) {
  }

  if ( ! WP_DEBUG ) {
    wp_enqueue_style( 'walter-style', get_template_directory_uri() . '/css/build/main.min.css', array(), '1.0.0', 'all');
  }
   
}

add_action( 'wp_enqueue_scripts','walter_admin_scripts' );
add_action( 'wp_enqueue_scripts', 'walter_load_css' );
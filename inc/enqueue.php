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


// <img 
//   src="http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018.jpg" 
//   data-aspectratio="2862/3873" 
//   data-src="http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018.jpg" 
//   class="attachment-full size-full wp-post-image lazyloaded" 
//   alt="" 
//   data-srcset="http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018.jpg 2862w, 
//                http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018-222x300.jpg 222w, 
//                http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018-768x1039.jpg 768w, 
//                http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018-757x1024.jpg 757w" 
//   sizes="(max-width: 2862px) 100vw, 2862px" 
//   srcset="http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018.jpg 2862w, 
//           http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018-222x300.jpg 222w, 
//           http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018-768x1039.jpg 768w, 
//           http://mirjamwalter.local/wp-content/uploads/2019/10/15-UNTITLED-145x200-cm-mixed-media-on-cotton-2018-757x1024.jpg 757w" 
//   width="2862" height="3873"
// >
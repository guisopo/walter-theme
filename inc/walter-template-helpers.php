<?php

function walter_site_name() {

  $site_name = get_bloginfo( 'name' );
  $names = explode( ' ', $site_name );
  $output = '';
  
  foreach ($names as $name) {

    $letters = str_split( $name);
    $output .= '<span class="logo-word">';
    foreach ($letters as $letter) {
      $output .= '<span class="logo-letter">' . $letter . '</span>';
    }
    $output .= '</span>';
  }

  echo $output;
}
/**
 * Modifi main query to show just works post type.
 *
 * @see pre_get_posts
 */
function walter_main_custom_query( $query ) {
  // Run only on the homepage
  if ( $query->is_home() && $query->is_main_query() ) {
    $query->set( 'post_type', 'works' );
    $query->set( 'posts_per_page', 10 );
  }
}
// Hook my above function to the pre_get_posts action
add_action( 'pre_get_posts', 'walter_main_custom_query');

/**
 * Get taxonomies terms links for single post.
 *
 * @see get_object_taxonomies()
 */
function walter_return_custom_taxonomy( $custom_taxonomy ) {

  if ( ! $post = get_post() ) {
    return '';
  }

  $output = array();

  $terms = get_the_terms( $post->ID, $custom_taxonomy );

  if ( ! empty( $terms ) ) {
    foreach ( $terms as $term ) {
      $output[] = sprintf( '<a href="%1$s">%2$s</a>',
        esc_url( get_term_link( $term->slug, $custom_taxonomy ) ),
        esc_html( $term->name )
      );
    }
  }

  return implode( '', $output );
}

/**
 * Get custom meta values from post.
 *
 * @see get_post_meta()
 */
function walter_get_post_meta( $post_id ) {
  return get_post_meta( $post_id, '_avant_folio_work_info_key', true);
}

/**
 * Render Work CPT Information.
 *
 * @see get_post_meta()
 */
function walter_render_work_info( $meta ) {
  $output = '';

  if( isset( $meta['date_completed'] ) ) {
    $output .= 
      '<p class="content__data">
        <span class="content__title">'. get_the_title() .'</span>,&nbsp
        <span class="content__year">'. $meta['date_completed'] .'</span>
      </p>'
    ;
  }

  $output .= '<div class="content__wrapper">';

  if( isset( $meta['material'] ) ) {
    $output .=
      '<p class="content__data">'. $meta['material'] .'</p>'
    ;
  }

  if ( isset( $meta['dimensions'], $meta['units'] ) ) {
    $output .=
      '<p class="content__data">
        <span class="content__dimensions">'. $meta['dimensions'] .'</span>
        <span class="content__units">'. $meta['units'] .'</span>
      </p>'
    ;
  }

  $output .= '</div>';

  return $output;
}

/**
 * Render Gallery Images saved in Custom Meta Box.
 *
 * @see get_post_meta()
 */
function walter_render_gallery( $gallery_array, $page = '') {

  $images_id = explode(',', $gallery_array );

  $output = '<div class="' . $page . '__gallery" data-scroll-content>';

  foreach ($images_id as $image_id) {
    $image =  wp_get_attachment_image( $image_id, 'medium', false );

    $orientation = give_image_orientation ( $image_id );
    
    $class = $page . '__image-container ' . $page . '__image-container--' . $orientation ;

    $output .= '<div class="' . $page . '__gallery-wrapper">';
    $output .= '<figure class="' . $class . '">' . $image . '</figure>';
    $output .= '</div>';
  }

  $output .= '</div>';

  return $output;
}

/**
 * Give image orientation
 *
 * @see wp_get_attachment_image_src()
 */
function give_image_orientation ( $image_id ) {

  $image = wp_get_attachment_image_src( $image_id, 'medium');
  $image_w = $image[1];
  $image_h = $image[2];

  if ($image_w > $image_h) { 
    return 'landscape';
  }
  elseif ($image_w == $image_h) { 
    return 'square';
  }
  else { 
    return 'portrait';
  } 
}
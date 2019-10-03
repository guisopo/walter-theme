<?php

function walter_site_name() {

  $site_name = get_bloginfo( 'name' );
  $names = explode( ' ', $site_name );
  $output = '';
  
  foreach ($names as $name) {
    $output .= '<span>' . $name . '</span>';
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
    $query->set( 'posts_per_page', 5 );
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
 * Create taxonomy post navigation.
 *
 * @see get_previous_post_link()
 * @see get_next_post_link()
 */
function walter_render_post_nav( $taxonomy ) {

  $previous_link = get_previous_post_link( '%link', 'Previous', TRUE, '', $taxonomy );
  $next_link = get_next_post_link( '%link', 'Next', TRUE, '', $taxonomy );
  
  $tax_terms = get_the_terms('', $taxonomy);
  $tax_name = $tax_terms[0]->name;
  $go_back_link = get_term_link( $tax_name, $taxonomy);

  return '
    <div class="post-navigation">
      <span class="previous-post">
        '. $previous_link .'
      </span>
      <span class="go-back-button">
        <a href='. $go_back_link .'>Close</a>
      </span>
      <span class="next-post">
        '. $next_link .'
      </span>
    </div>';
}

/**
 * Create unordered list with given taxonomy.
 *
 * @see get_terms()
 * @see get_term_link()
 */
function walter_render_taxonmy_list( $tax_name ) {

  $terms_args = array(
    'taxonomy'   => $tax_name,
    'orderby'    => 'count',
    'order'      => 'DESC'
  );

  $terms = get_terms( $terms_args );

  $output = '<ul class="taxonomy-list">';

  if ( ! empty( $terms ) && taxonomy_exists( $tax_name ) ) {

    foreach ( $terms as $term ) {

      $term_link = esc_url( get_term_link( $term->name, $term->taxonomy ) );

      $output .=
        '<li class="taxonomy-item">
            <a class="taxonomy-link" href="' . $term_link  . '">'. $term->name .'</a>
        </li>'
      ;
    } 
  } else {
    return '<p>ERROR <b>create_taxonmy_list()</b>: Given taxonomy doesn\'t exist or is empty.</p>';
  }

  $output .= '</ul>';

  return $output;
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
      '<p class="post-item__data">
        <span class="post-title">'. get_the_title() .'</span>,&nbsp
        <span>'. $meta['date_completed'] .'</span>
      </p>'
    ;
  }

  if( isset( $meta['material'] ) ) {
    $output .=
      '<p class="post-item__data">
        <span>'. $meta['material'] .'</span>
      </p>'
    ;
  }

  if ( isset( $meta['dimensions'], $meta['units'] ) ) {
    $output .=
      '<p class="post-item__data">
        <span>'. $meta['dimensions'] .'</span>
        <span>'. $meta['units'] .'</span>
      </p>'
    ;
  }

  echo $output;
}

/**
 * Render Gallery Images saved in Custom Meta Box.
 *
 * @see get_post_meta()
 */
function walter_render_gallery( $gallery_array) {
  $images_id = explode(',', $gallery_array );

  $figure = '<figure class="post__gallery">';

  foreach ($images_id as $image_id) {
    $image =  wp_get_attachment_image( $image_id, 'medium', false );
    
    $figure .= '<div class="post__image">' . $image . '</div>';
  }

  $figure .= '</figure>';

  return $figure;
}
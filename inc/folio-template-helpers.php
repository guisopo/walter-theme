<?php
/**
 * Get taxonomies terms links for single post.
 *
 * @see get_object_taxonomies()
 */
function folio_return_custom_taxonomy( $custom_taxonomy ) {

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
function folio_render_post_nav( $taxonomy ) {

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
function folio_render_taxonmy_list( $tax_name ) {

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
function folio_get_post_meta( $post_id ) {
  return get_post_meta( $post_id, '_avant_folio_work_info_key', true);
}

/**
 * Render Work CPT Information.
 *
 * @see get_post_meta()
 */
function folio_render_work_info( $meta ) {
  ?>
  <p class="post-item__data">
    <span><?php the_title(); ?></span>,&nbsp
    <span><?php echo $meta['date_completed']; ?></span>
  </p>

  <p class="post-item__data">
    <span><?php echo $meta['material']; ?></span>
  </p>

  <p class="post-item__data">
    <span><?php echo $meta['dimensions']; ?></span>
    <span><?php echo $meta['units']; ?></span>
  </p>
  <?php
}

/**
 * Render Gallery Images saved in Custom Meta Box.
 *
 * @see get_post_meta()
 */
function folio_render_gallery( $gallery_array) {
  $images_id = explode(',', $gallery_array );

  $figure = '<figure class="post__gallery">';

  foreach ($images_id as $image_id) {
    $image =  wp_get_attachment_image( $image_id, 'medium', false );
    
    $figure .= '<div class="post__image">' . $image . '</div>';
  }

  $figure .= '</figure>';

  return $figure;
}
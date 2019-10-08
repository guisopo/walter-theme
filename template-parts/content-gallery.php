<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

$meta = walter_get_post_meta( get_the_ID() );

if ( has_post_thumbnail( $post->ID ) ) :
  $image_orientation = give_image_orientation( get_post_thumbnail_id($post->ID) );
?>

<li class="content <?php echo 'content--'.$image_orientation ?>">

  <a class="content__link" href=<?php echo esc_url( get_permalink() ); ?>>
    
    <figure class="content__image-container <?php echo 'content__image-container--'.$image_orientation ?>">
      <?php the_post_thumbnail( 'medium' ); ?>
    </figure>
    
  </a>

  <?php 

    if( !empty($meta)  ) {
      echo '<div class="content__info  content__info--' .$image_orientation . '">
        ' . walter_render_work_info($meta) . '
      </div>';
    }

  ?>

</li>


<?php
endif;
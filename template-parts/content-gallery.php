<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

$meta = walter_get_post_meta( get_the_ID() );
?>

<li class="content">

  <?php
  if ( has_post_thumbnail( $post->ID ) ) :
    $image_orientation = give_image_orientation( get_post_thumbnail_id($post->ID) );
  ?>
    <a class="content__link" href=<?php echo esc_url( get_permalink() ); ?>>
      
      <figure class="content__image-container <?php echo 'content__image-container--'.$image_orientation ?>">
        <?php the_post_thumbnail( 'medium' ); ?>
      </figure>
      
    </a>

  <?php
  endif;
  ?>

  <div class="content__info <?php echo 'content__info--'.$image_orientation ?>">
    <?php walter_render_work_info($meta); ?>
  </div>

</li><!-- .post-item -->
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

<li class="work">

  <?php
    if ( has_post_thumbnail( $post->ID ) ) :
      $image_orientation = give_image_orientation( $post->ID );
  ?>
    <a class="work__link" href=<?php echo esc_url( get_permalink() ); ?>>
      <figure class="work__image-container <?php echo 'work__image-container--'.$image_orientation ?>">
        <?php the_post_thumbnail( 'medium' ); ?>
      </figure>
    </a>

  <?php
    endif;
  ?>

  <div class="work__info <?php echo 'work__info--'.$image_orientation ?>">
    <?php walter_render_work_info($meta); ?>
  </div>

</li><!-- .post-item -->
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

<li class="post-item post-item--gallery">

  <?php
  if (has_post_thumbnail( $post->ID ) ):
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '');
    $image_w = $image[1];
    $image_h = $image[2];

    if ($image_w > $image_h) { 
      $class = 'landscape';
    }
    elseif ($image_w == $image_h) { 
      $class = 'square';
    }
    else { 
      $class = 'portrait';
    } 
  ?>
    <a class="post-item__link" href=<?php echo esc_url( get_permalink() ); ?>>
      <figure class="post__image-container <?php echo 'post__image-container--'.$class ?>">
        <?php the_post_thumbnail( 'medium' ); ?>
      </figure>
    </a>

  <?php
  endif;
  ?>

  <div class="post-item__info <?php echo 'post-item__info--'.$class ?>">
    <?php walter_render_work_info($meta); ?>
  </div>

</li><!-- .post-item -->
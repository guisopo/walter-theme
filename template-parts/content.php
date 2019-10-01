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

<li class="post-item post-item--list">

  <?php
  if (has_post_thumbnail( $post->ID ) ):
  ?>

  <a class="post-item__link" href=<?php echo esc_url( get_permalink() ); ?>>
    <figure class="post__image-container">
	  	<?php the_post_thumbnail( 'medium' ); ?>
	  </figure>
  </a>

  <?php
  endif;
  ?>

  <?php walter_render_work_info($meta); ?>

</li><!-- .post-item -->
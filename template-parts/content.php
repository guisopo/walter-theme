<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

?>

<li class="post-item post-item--list">
  <a class="post-item__link" href=<?php echo esc_url( get_permalink() ); ?>>
    <p><?php the_title(); ?></p>
  </a>
  <span><?php echo get_the_date( 'Y' ); ?></span>
</li><!-- .post-item -->
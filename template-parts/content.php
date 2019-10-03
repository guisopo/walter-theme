<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

?>

<li class="post-item post-item--article">

  <a class="post-item__link" href=<?php echo esc_url( get_permalink() ); ?>>
    <p><span class="post-item__bullet"></span><?php the_title(); ?></p>
  </a>
  
  <span class="post-item__date"><?php echo get_the_date( 'Y' ); ?></span>

</li><!-- .post-item -->

<span class="post-item__separator"></span>
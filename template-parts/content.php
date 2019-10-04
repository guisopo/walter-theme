<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

?>

<li class="content content--texts">
  
  <span class="bullet-container">
    <span class="bullet"></span>
  </span>

  <a class="content__link" href=<?php echo esc_url( get_permalink() ); ?>>
    
    <p><?php the_title(); ?></p>

  </a>
  
  <span class="content__date"><?php echo get_the_date( 'Y' ); ?></span>

</li><!-- .content -->

<span class="list-separator"></span>
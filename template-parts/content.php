<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Folio
 */

$date_completed = folio_return_custom_taxonomy( 'date_completed' );
?>

<li class="post-item post-item--list">

  <h2 class="post-item__title">
    <a class="post-item__link" href=<?php echo esc_url( get_permalink() ); ?>>
      <?php the_title(); ?>
    </a>
  </h2>

  <p class="post-item__taxonomy"><?php echo $date_completed ?></p>
  
</li><!-- .post-item -->
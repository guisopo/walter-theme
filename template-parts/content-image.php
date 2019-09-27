<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Folio
 */

$meta = folio_get_post_meta( get_the_ID() );
?>

<li class="post-item post-item--grid">

  <a class="post-item__link" href=<?php echo get_the_permalink(); ?>>
      
    <figure class="post-item__image-container">

      <?php the_post_thumbnail( 'medium' ); ?>

    </figure>

  </a>

  <figcaption class="post-item__information">

    <?php folio_render_work_info($meta); ?>
    
  </figcaption>
  
</li>
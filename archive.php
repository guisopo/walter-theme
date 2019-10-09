<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

get_header();
?>

<?php 
if ( have_posts() ) :

  $cpt = get_post_type( get_the_ID() );
?>

  <ul class="content-list <?php echo 'content-list--'.$cpt ?>" data-scroll-content>
    
    <?php
      while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', get_post_format() );
        
      endwhile;

      previous_posts_link( 'Older Posts' );
      next_posts_link( 'Newer Posts' );
    ?>
    
  </ul><!-- .content-list -->

<?php

endif; 
?>

<?php
get_footer();



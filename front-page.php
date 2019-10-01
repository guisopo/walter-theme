<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Folio
 */

get_header();
?>

<main class="content">

  <?php
    if( have_posts() ) :

      while( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', 'content' );

      endwhile;

      previous_posts_link( 'Newer Posts' );
      next_posts_link( 'Older Posts' );
      
    endif;

    wp_reset_postdata();

  ?>

</main>

<?php
get_footer();
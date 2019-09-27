<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

get_header();
?>

  <?php
  if ( have_posts() ) :

    while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', get_post_format() );
      
    endwhile;
    
    else :
      
      get_template_part( 'template-parts/content', 'none' );
      
  endif;
  ?>

<?php
get_footer();
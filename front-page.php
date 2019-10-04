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
if( have_posts() ) :
?>

  <ul class="work-list">

    <?php
      while( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', get_post_format() );

      endwhile;
    ?>

  </ul>

  <?php
    previous_posts_link( 'Newer Posts' );
    next_posts_link( 'Older Posts' );

endif;

wp_reset_postdata();

?>

<?php
get_footer();
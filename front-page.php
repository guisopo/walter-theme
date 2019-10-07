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

  <ul class="content-list">

    <?php
      while( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', get_post_format() );

      endwhile;

    ?>

  </ul>

<?php

endif;

wp_reset_postdata();

?>

<?php
get_footer();
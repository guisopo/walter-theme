<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

get_header();
global $wp_query;
?>

<?php
if( have_posts() ) :
?>

  <ul 
    class="content-list" 
    data-scroll-content 
    data-cpt= "<?= get_post_type(); ?>"
    data-page="<?= get_query_var('paged') ?: 1;?>"
    data-max="<?= $wp_query->max_num_pages; ?>">

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
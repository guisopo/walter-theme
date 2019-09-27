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
    $works_args = array(
      'post_type' => 'works',
    );

    $works = new WP_Query( $works_args );

    if( $works->have_posts() ) :

      while( $works->have_posts() ) : $works->the_post();

        get_template_part( 'template-parts/content', 'content' );

      endwhile;
      
    endif;
  ?>

</main>

<?php
get_footer();
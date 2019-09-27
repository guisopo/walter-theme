<?php
/**
 * Custom Page Templage: About
 * 
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Folio
 */

get_header();
?>

<?php
  while ( have_posts() ) : the_post();

    get_template_part( 'template-parts/content', 'page' );

  endwhile;
?>

<?php
get_footer();

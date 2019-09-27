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
    // Create UL with links to the given taxonomy
    echo folio_render_taxonmy_list( 'work_type' ); 
  ?>

  <div class="image-container">
    This will be the image container
  </div>

</main>

<?php
get_footer();
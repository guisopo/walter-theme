<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Prim
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page' ); ?>>

	<div class="page__content">
    <?php
      the_content();
    ?>
  </div>
  
</article>

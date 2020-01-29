<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page__content">
    <?php
      the_content();
    ?>
  </div>
  
</article>

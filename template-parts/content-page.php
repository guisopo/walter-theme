<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Folio
 */

?>

<article class="page">

	<header class="page__header">

		<h1 class="page_title"><?php the_title(); ?></h1>

	</header>

	<div class="page__content">

    <?php the_content(); ?>
      
  </div>
  
</article>

<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Folio
 */

$meta = folio_get_post_meta( get_the_ID() );
?>

<article class="post">

	<figure class="post__image-container">

		<?php the_post_thumbnail( 'medium' ); ?>

	</figure>

	<div class="post__information">

		<?php folio_render_work_info($meta); ?>

	</div>

</article>

<?php

echo folio_render_post_nav( 'work_type' );
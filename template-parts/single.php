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

	<header class="post__header">

		<h1 class="post__title"><?php the_title(); ?></h1>

		<p class="taxonomies post__taxonomies">

			<?php echo folio_return_custom_taxonomy( 'work_type' ); ?>
			<?php echo folio_return_custom_taxonomy( 'date_completed' ); ?>

		</p>

	</header><!-- article-header -->

	<div class="post__content">

		<p><?php echo $meta['description'] ?></p>

	</div>

	<div class="post__gallery">

		<?php echo folio_render_gallery( $meta['gallery'] ); ?>

	</div>

</article><!-- article -->

<?php

echo folio_render_post_nav( 'work_type' );
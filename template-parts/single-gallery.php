<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

$meta = walter_get_post_meta( get_the_ID() );
?>

<article class="post">

	<div class="post__info">
		<?php walter_render_work_info($meta); ?>
	</div>

	<div class="post__gallery">
		<?php echo walter_render_gallery( $meta['gallery'] ); ?>
	</div>

</article><!-- article -->

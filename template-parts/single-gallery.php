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

<article class="work-wrapper">

	<div class="work__info">
		<?php walter_render_work_info($meta); ?>
	</div>

	<?php echo walter_render_gallery( $meta['gallery'], 'work' ); ?>

</article><!-- article -->

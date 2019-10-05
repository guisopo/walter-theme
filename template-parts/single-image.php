<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Folio
 */

$meta = walter_get_post_meta( get_the_ID() );
?>

<article class="post">

	<figure class="post__image-container">

		<?php the_post_thumbnail( 'medium' ); ?>

	</figure>
	
	<?php
		if( !empty($meta) ) {
			?>
			<div class="post__information">

				<?php walter_render_work_info($meta); ?>

			</div>
			<?php
		}
	?>

</article>
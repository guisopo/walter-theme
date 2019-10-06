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

<article class="work-wrapper">
		
	<?php
		if( !empty($meta) ) {
			?>
			<div class="work__info">

				<h2 class="work__title"><?php echo get_the_title(); ?></h2>
				<p class="work__year"><?php echo $meta['date_completed'] ?></p>

			</div>
			<?php
		}
	?>

	<figure class="work__image-container">

		<?php the_post_thumbnail( 'medium' ); ?>

	</figure>

	<nav class="work-nav">
		<a href="<?php echo esc_url( home_url( '/') ); ?>">Close</a>
		<?php previous_post_link( '%link', 'Next work'); ?>
	</nav>
	
</article>

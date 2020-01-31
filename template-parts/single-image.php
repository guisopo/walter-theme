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
		
	

	<figure class="work__image-container">

		<?php the_post_thumbnail( 'full' ); ?>
		<?php
			if( !empty($meta) ) {
				?>
				<figcaption class="work__info">

					<h2 class="work__title"><?php echo get_the_title(); ?></h2>
					<p class="work__year"><?php echo $meta['date_completed'] ?></p>

				</figcaption>
				<?php
			}
		?>	
	</figure>

	<nav class="work-nav">
		<div class="posts-nav">
			<?php next_post_link( '%link', 'Prev'); ?>
			<?php previous_post_link( '%link', 'Next'); ?>
		</div>
		<div class="close-link">
			<a href="<?php echo esc_url( home_url( '/') ); ?>">Close</a>
		</div>
	</nav>
	
</article>

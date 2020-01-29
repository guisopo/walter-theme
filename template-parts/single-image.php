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

		<?php the_post_thumbnail( 'medium' ); ?>
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
		<a href="<?php echo esc_url( home_url( '/') ); ?>">Close</a>
		<?php previous_post_link( '%link', 'Next work'); ?>
	</nav>
	
</article>

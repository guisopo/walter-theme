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

	<h1 class="post-title"><?php echo esc_html( get_the_title() ); ?></h1>

	<?php the_content(); ?>

</article><!-- article -->

<div>
<?php
	previous_post_link( '%link', 'Previous' );
	next_post_link( '%link', 'Next' );
?>
</div>
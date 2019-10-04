<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */
?>

<article class="article">

	<h1 class="article-title"><?php echo esc_html( get_the_title() ); ?></h1>

	<?php the_content(); ?>

</article>
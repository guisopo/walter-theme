<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walter
 */

get_header();
?>

<h1 class="archive-title"><?php single_term_title(); ?> </h1>

<?php 
if ( have_posts() ) :
?>

  <ul class="post-list">
    <?php

    while ( have_posts() ) : the_post();

      get_template_part( 'template-parts/content', 'content' );
      
    endwhile;

    previous_posts_link( 'Older Posts' );
    next_posts_link( 'Newer Posts' );

    ?>
  </ul><!-- .term-list -->
<?php

endif; 
?>

<?php
get_footer();



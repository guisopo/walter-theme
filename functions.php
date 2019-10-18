<?php
/**
 * Folio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Walter
 */

require get_template_directory().'/inc/cleanup.php';
require get_template_directory().'/inc/enqueue.php';
require get_template_directory().'/inc/menu-management.php';
require get_template_directory().'/inc/walter-template-helpers.php';

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

//AJAX

add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );

function load_more_posts() {

    $next_page = $_POST['current_page'] + 1;
    $query = new WP_Query([
        'post_type' => 'works',
        'posts_per_page' => 3,
        'paged' => $next_page
    ]);

    if($query->have_posts()) : 

        ob_start();
        
        while($query->have_posts()) : $query->the_post();

            get_template_part( 'template-parts/content', get_post_format() );
        
        endwhile;

        wp_send_json_success( ob_get_clean() );

    else :

        wp_send_json_error( 'No more posts' );

    endif;
}
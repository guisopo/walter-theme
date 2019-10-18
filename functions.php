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
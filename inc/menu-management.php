<?php

register_nav_menu( 'primary', 'Main Navigation Menu' );
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

add_filter('next_post_link','add_class_next_post_link',10,1);
add_filter('previous_post_link','add_class_prev_post_link',10,1);

function add_class_next_post_link($html){
    $html = str_replace('<a','<a class="link__prev link__rotated"',$html);
    return $html;
}

function add_class_prev_post_link($html){
    $html = str_replace('<a','<a class="link__next"',$html);
    return $html;
}
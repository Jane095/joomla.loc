<?php 
 
function register_styles()
{
    wp_register_style('style', get_template_directory_uri() .
        '/style.css');
    wp_enqueue_style('style');

    wp_register_style('font', get_template_directory_uri() .
        '//fonts.googleapis.com/css?family=Noto+Sans|Noto+Serif|Playfair+Display');
    wp_enqueue_style('style');
}
add_action( 'wp_enqueue_scripts', 'register_styles' );

function load_my_script() {

    wp_register_script('slick', get_template_directory_uri() .
        '/js/slick.min.js', array (), null, false);
    wp_enqueue_script('slick');

    wp_register_script('mousewheel', get_template_directory_uri() .
        '/js/jquery.mousewheel-3.0.6.pack.js', array (), null, false);
    wp_enqueue_script('mousewheel');

    wp_register_script('fancybox.pack', get_template_directory_uri() .
        '/js/jquery.fancybox.pack.js', array (), ('2.1.5'), false);
    wp_enqueue_script('fancybox.pack');

    wp_register_script('fancybox-thumbs', get_template_directory_uri() .
        '/js/jquery.fancybox-thumbs.js', array (), ('1.0.7'), false);
    wp_enqueue_script('fancybox-thumbs');

    wp_register_script('common.js', get_template_directory_uri() .
        '/js/common.js', array (), null, false);
    wp_enqueue_script('common.js');

}
add_action( 'wp_enqueue_scripts', 'load_my_script' );

register_nav_menu('menu', 'Main menu');

function extra_setup () {
    register_nav_menu ('primary mobile', __ ( 'Navigation Mobile'));
}
add_action ( 'after_setup_theme', 'extra_setup' );
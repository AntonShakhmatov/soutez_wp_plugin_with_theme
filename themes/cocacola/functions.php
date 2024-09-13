<?php

add_action( 'wp_enqueue_scripts', function() {

    wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' );

    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css' );

    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-3.6.0.min.js');

    wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js');
} );

add_theme_support( 'post-thumbnails' );
add_theme_support('title-tag');
add_theme_support('custom-logo');
<?php

define( 'TPL_DIR', get_template_directory_uri() );

// DISABLE EMOJIS 
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter( 'emoji_svg_url', '__return_false' );
// /DISABLE EMOJIS

// LOAD ASSETS
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'vendor', TPL_DIR.'/vendor.css' );
    wp_enqueue_style( 'theme', TPL_DIR.'/theme.css' );
    wp_enqueue_script( 'vendor', TPL_DIR.'/vendor.js' );
    wp_enqueue_script( 'theme', TPL_DIR.'/theme.js' );
} );
// /LOAD ASSETS

// THEME SETUP
add_action( 'after_setup_theme', function() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
} );
// / THEME SETUP

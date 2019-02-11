<?php

define( 'TPL_DIR', get_template_directory_uri() );
define( 'URL_SITE', get_site_url() );
require_once 'lib/cssimg.php';

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

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

	// Add support for full and wide align images.
	//add_theme_support( 'align-wide' );
	// Add support for editor styles.
	//add_theme_support( 'editor-styles' );
	// Enqueue editor styles.
	//add_editor_style( 'style-editor.css' );
} );
// / THEME SETUP

// PHP print if not empty, with prefix and suffix
function p( $prefix, $value, $suffix='', $else='' ) {
    return (
		empty( $value )
		? $else
		//: $prefix.nl2br( htmlspecialchars( $value, ENT_QUOTES, 'UTF-8' ) ).$suffix
		: $prefix.$value.$suffix
	);
}

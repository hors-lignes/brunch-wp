<?php

define( 'TPL_DIR', get_template_directory_uri() );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'vendor', TPL_DIR.'/vendor.css' );
	wp_enqueue_style( 'theme', TPL_DIR.'/theme.css' );
	wp_enqueue_script( 'vendor', TPL_DIR.'/vendor.js' );
	wp_enqueue_script( 'theme', TPL_DIR.'/theme.js' );
} );

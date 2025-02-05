<?php

add_action('wp_enqueue_scripts', 'hanata_child_css', 1001);

// Load CSS
function hanata_child_css() {
	wp_deregister_style( 'styles-child' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'styles-child' );

	wp_deregister_style( 'styles-child-header' );
	wp_register_style( 'styles-child-header', get_stylesheet_directory_uri() . '/assets/css/sections/header.css' );
	wp_enqueue_style( 'styles-child-header' );
}

/* Hooks */
require_once __DIR__ . '/inc/init_hook.php';

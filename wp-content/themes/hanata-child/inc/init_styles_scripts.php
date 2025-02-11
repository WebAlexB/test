<?php

add_action( 'wp_enqueue_scripts', 'hanata_child_css', 1001 );

// Load CSS
function hanata_child_css() {
	wp_deregister_style( 'styles-child' );
	wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'styles-child' );

	wp_deregister_style( 'styles-child-header' );
	wp_register_style( 'styles-child-header', get_stylesheet_directory_uri() . '/assets/css/sections/header.css' );
	wp_enqueue_style( 'styles-child-header' );

	wp_deregister_style( 'styles-child-pdf' );
	wp_register_style( 'styles-child-pdf', get_stylesheet_directory_uri() . '/assets/css/pages/pdf.css' );
	wp_enqueue_style( 'styles-child-pdf' );
	wp_deregister_style( 'styles-child-category' );
	wp_register_style( 'styles-child-category', get_stylesheet_directory_uri() . '/assets/css/pages/category.css' );
	wp_enqueue_style( 'styles-child-category' );
	if ( is_product_category() ) {
		wp_register_script( 'category', get_stylesheet_directory_uri() . '/assets/js/category.js', array(), null,
			true );
		wp_enqueue_script( 'category' );
	}
}
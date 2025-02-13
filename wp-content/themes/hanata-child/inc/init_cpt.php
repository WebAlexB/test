<?php

function register_cpts() {

	$labels_blog = array(
		'name'               => 'Blog',
		'singular_name'      => 'Blog Post',
		'add_new'            => 'Add New Blog Post',
		'add_new_item'       => 'Add New Blog Post',
		'edit_item'          => 'Edit Blog Post',
		'new_item'           => 'New Blog Post',
		'all_items'          => 'All Blog Posts',
		'view_item'          => 'View Blog Post',
		'search_items'       => 'Search Blog Posts',
		'not_found'          => 'No Blog Posts Found',
		'not_found_in_trash' => 'No Blog Posts Found in Trash',
		'menu_name'          => 'Blog',
	);

	$args_blog = array(
		'labels'              => $labels_blog,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'           => 'dashicons-welcome-write-blog',
		'rewrite'             => array( 'slug' => 'blog' ),
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
	);

	register_post_type( 'blog', $args_blog );
}

add_action( 'init', 'register_cpts' );




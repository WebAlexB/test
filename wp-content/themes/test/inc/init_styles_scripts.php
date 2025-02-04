<?php

function add_enqueue_styles() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/style.css', [], filemtime(get_template_directory() . '/assets/css/style.css'), 'all');
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/script.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/script.js'), true);
}
add_action('wp_enqueue_scripts', 'add_enqueue_styles');

<?php
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Дополнительные настройки темы',
        'menu_title'	=> 'Дополнительные настройки темы',
        'menu_slug' 	=> 'option',
        'capability'	=> 'edit_users',
        'redirect'		=> false,
    ));
}


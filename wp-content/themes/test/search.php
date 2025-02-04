<?php
get_header();
if (have_posts()) : 
    echo '<h1>Результаты поиска: ' . get_search_query() . '</h1>';
    while (have_posts()) : the_post(); 
        echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
        the_excerpt();
    endwhile; 
else: 
    echo '<p>Ничего не найдено.</p>';
endif;
get_footer();

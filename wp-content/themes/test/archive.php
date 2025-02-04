<?php
get_header();
if (have_posts()) : 
    echo '<h1>' . post_type_archive_title('', false) . '</h1>';
    while (have_posts()) : the_post(); 
        echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
        the_excerpt();
    endwhile; 
else: 
    echo '<p>Записей не найдено.</p>';
endif;
get_footer();

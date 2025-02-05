<?php
/**
 * Template Name: Home Page V2
 *
 * @package Wpbingo
 * @subpackage Hanata
 * @since Bingo Hanata 1.0
 */
get_header(); ?>

<div class="container homepage-v2" id="container">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'templates/content/content', 'page');

					// If comments are open or we have at least one comment, load up the comment template.
					/*if ( comments_open() || get_comments_number() ) {
						comments_template();
					}*/
				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php 
		//get_sidebar( 'content' ); 
	?>
</div><!-- #main-content -->

<?php
//get_sidebar();
get_footer();

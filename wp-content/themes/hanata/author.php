<?php
$layout_blog = hanata_get_config('layout_blog');
get_header(); ?>
<div class="container">
	<div class="row">
		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php if ( have_posts() ) : ?>

				<header class="archive-header">
					<h1 class="archive-title">
						<?php
							the_post();

							printf( __( 'All posts by %s', 'hanata' ), get_the_author() );
						?>
					</h1>
					<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<div class="author-description"><?php the_author_meta( 'description' ); ?></div>
					<?php endif; ?>
				</header><!-- .archive-header -->

				<?php
						rewind_posts();

						// Start the Loop.
						while ( have_posts() ) : the_post();
							get_template_part( 'templates/content/content', $layout_blog);

						endwhile;
						// Previous/next page navigation.
						hanata_paging_nav();

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'templates/content/content', 'none');

					endif;
				?>

			</div><!-- #content -->
		</section><!-- #primary -->
	</div>
</div>

<?php
get_footer();

<?php get_header(); ?>

<div class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="single-post">
			<h1><?php the_title(); ?></h1>
			<p class="post-meta">
				<?php _e( 'Опубліковано:', 'hanata' ); ?><?php echo get_the_date(); ?> | <?php _e( 'Автор:',
					'hanata' ); ?><?php the_author(); ?> |
				<?php _e( 'Коментарі:', 'hanata' ); ?><?php comments_number( '0', '1', '%' ); ?>
			</p>

			<?php if ( has_post_thumbnail() ) : ?>
				<img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title(); ?>">
			<?php endif; ?>

			<div class="content">
				<?php the_content(); ?>
			</div>

			<div class="comments">
				<?php if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>
			</div>

		</article>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>

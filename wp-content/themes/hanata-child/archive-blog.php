<?php get_header(); ?>

<div class="container">
	<h1><?php  _e('Блог','hanata'); ?></h1>

	<?php if (have_posts()) : ?>
		<div class="posts-list">
			<?php while (have_posts()) : the_post(); ?>
				<article class="post">
					<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()) : ?>
							<img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
						<?php endif; ?>
					</a>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-meta">
						<?php  _e('Опубліковано:','hanata'); ?><?php echo get_the_date(); ?> |
						<?php  _e('Автор:','hanata'); ?><?php the_author(); ?> |
						<?php  _e('Коментарі:','hanata'); ?><?php comments_number('0', '1', '%'); ?>
					</p>
					<p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
					<a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html('Читати далі'); ?></a>
				</article>
			<?php endwhile; ?>

			<div class="pagination">
				<?php
				echo paginate_links(array(
					'total' => $wp_query->max_num_pages,
					'prev_text' => __('« Назад'),
					'next_text' => __('Вперед »'),
				));
				?>
			</div>

		</div>
	<?php else : ?>
		<p><?php echo esc_html('Записів не знайдено.'); ?></p>
	<?php endif; ?>
</div>

<?php get_footer(); ?>


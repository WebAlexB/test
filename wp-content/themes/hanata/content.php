<?php $hanata_settings = hanata_global_settings(); ?>
<article id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
	<?php if ( get_the_post_thumbnail() ){ ?>
		<div class="entry-thumb single-thumb">
			<?php the_post_thumbnail( 'full' ); ?>
		</div>
	<?php }; ?>	
	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="post-content">
		<?php echo hanata_time_link(); ?>
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && hanata_categorized_blog() ) : ?>
		<div class="entry-meta hidden">
			<div class="cat-links"><?php echo get_the_category_list( esc_html_e( 'Used between list items, there is a space after the comma.', 'hanata' ) ); ?></div>
		</div>
		<?php
		endif;
			$show_post_title = hanata_get_config('post-title',true);
			if ($show_post_title){
				if ( is_single() ){
					the_title( '<h3 class="entry-title">', '</h3>' );
				}else {
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				}
			}
		?>	
		<?php hanata_single_posted_on(); ?>
		<div class="post-excerpt clearfix">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				wp_link_pages( array(
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div>

		<?php if ( shortcode_exists( 'social_share' ) ) : ?> 
			<div class="entry-social-share">
			<span class="title-social"><i class="fa fa-share-alt"></i><?php echo esc_html__( 'Share this on: ', 'hanata' ) ?></span>
			<?php echo do_shortcode( "[social_share]" ); ?>	
			</div>
		<?php endif; ?>
		<!-- Tag -->
		<?php if(get_the_tag_list()) { ?>
		<div class="entry-tag single-tag">
			<i class="fa fa-tags"></i><?php echo get_the_tag_list('<span class="custom-font title-tag">'.esc_html__('Tags','hanata').': </span>',' , ','');  ?>
		</div>
		<?php } ?>
		<div class="clearfix"></div>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->

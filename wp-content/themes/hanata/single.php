<?php 
	get_header();
	$post_single_layout = hanata_post_sidebar();
?>

<div class="container">
	<div class="single-post-content row">
			<?php if($post_single_layout == 'left' && is_active_sidebar('sidebar-blog')):?>			
			<div class="bwp-sidebar sidebar-blog <?php echo esc_attr(hanata_get_class()->class_sidebar_left); ?>">
				<?php dynamic_sidebar('sidebar-blog');?>	
			</div>				
			<?php endif; ?>
			<div class="<?php echo esc_attr(hanata_get_class()->class_single_content); ?>">
				<div class="post-single">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							get_template_part( 'content');

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
							// Previous/next post navigation.
							hanata_post_nav();
						endwhile;
					?>
				</div>
			</div>
			<?php if($post_single_layout == 'right' && is_active_sidebar('sidebar-blog')):?>			
				<div class="bwp-sidebar sidebar-blog <?php echo esc_attr(hanata_get_class()->class_sidebar_right); ?>">
					<?php dynamic_sidebar('sidebar-blog');?>	
				</div>				
			<?php endif; ?>
            
    </div>
</div>
<?php
get_footer();
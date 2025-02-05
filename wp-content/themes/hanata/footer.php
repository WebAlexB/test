	</div><!-- #main -->
		<?php 
			global $page_id;
			$hanata_settings = hanata_global_settings();
			$footer_style = hanata_get_config('footer_style','');
			$footer_style = (get_post_meta( $page_id,'page_footer_style', true )) ? get_post_meta( $page_id, 'page_footer_style', true ) : $footer_style ;
			$header_style = hanata_get_config('header_style', ''); 
			$header_style  = (get_post_meta( $page_id, 'page_header_style', true )) ? get_post_meta($page_id, 'page_header_style', true ) : $header_style ;
		?>	
		<?php if($footer_style && (get_post($footer_style))){ ?>
			<footer id="bwp-footer" class="bwp-footer <?php echo esc_attr( get_post($footer_style)->post_name ); ?>">
				<div class="container">
					<?php
						$post_content = get_post( $footer_style )->post_content;
						echo do_shortcode( $post_content );
						hanata_parseShortcodesCustomCss($post_content);						
					?>
				</div>
			</footer>
		<?php }else{
			hanata_copyright(); 
		}?>
	</div><!-- #page -->
	<div class="search-overlay">	
		<span class="close-search"><i class="icon_close"></i></span>	
		<div class="container wrapper-search">
			<?php hanata_search_form_product(); ?>		
		</div>	
	</div>
	<div class="bwp-quick-view">
	</div>	
	<?php 
		$back_active = hanata_get_config('back_active');
		if($back_active && $back_active == 1):
	?>
	<div class="back-top">
		<i class="arrow_carrot-up"></i>
	</div>
	<?php endif;?>
	
	<?php if((isset($hanata_settings['show-newletter']) && $hanata_settings['show-newletter']) && is_active_sidebar('newletter-popup-form')) : ?>		
		<?php hanata_popup_newsletter(); ?>
	<?php endif;  ?>
	<?php wp_footer(); ?>
</body>
</html>
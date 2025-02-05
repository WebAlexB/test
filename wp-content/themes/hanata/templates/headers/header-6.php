	<?php 
		$hanata_settings = hanata_global_settings();
		$show_minicart = (isset($hanata_settings['show-minicart']) && $hanata_settings['show-minicart']) ? ($hanata_settings['show-minicart']) : false;
		$show_searchform = (isset($hanata_settings['show-searchform']) && $hanata_settings['show-searchform']) ? ($hanata_settings['show-searchform']) : false;		
		$show_wishlist = (isset($hanata_settings['show-wishlist']) && $hanata_settings['show-wishlist']) ? ($hanata_settings['show-wishlist']) : false;
	?>
	<h1 class="bwp-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<header id='bwp-header' class="bwp-header header-v6">
		<div class='header-wrapper '>
			<div class='header-right'>
				<?php if($show_minicart && class_exists( 'WooCommerce' )){ ?>
				<div class="wpbingoCartTop pull-right">
					<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
	        	</div>
				<?php } ?>

				<!-- Begin Search -->
				<?php if($show_searchform && class_exists( 'WooCommerce' )){ ?>
				<div class="search-box pull-right">
					<div class="search-toggle"><i class="icon_search"></i></div>
				</div>
				<?php } ?>
				<!-- End Search -->	
				
				<?php if(is_active_sidebar('top-link')){ ?>
				<div class="block-top-link pull-right">					
					<?php dynamic_sidebar( 'top-link' ); ?>			
				</div>
				<?php } ?>	

				<?php if($show_wishlist && class_exists( 'YITH_WCWL' )){ ?>
				<div class="wishlist-box pull-right">
					<a href="<?php echo get_permalink( get_option('yith_wcwl_wishlist_page_id') ); ?>"><i class="icon_heart_alt"></i></a>
				</div>
				<?php } ?>	
			</div>
			<div class='header-content sticky-sidebar'>
				<div class="btn-sticky"></div>
				<div class='header-left hidden-xs'>
					<h3><?php echo esc_html__( 'Welcome to!','hanata'); ?></h3>
					<h2><?php echo esc_html__( 'shop  furniture','hanata'); ?></h2>
				</div>
				<div class='header-center'>
					<div class="header-logo">
						<?php hanata_header_logo(); ?>
					</div>
					<div class="wpbingo-menu-mobile wpbingo-menu-sidebar">
						<?php hanata_top_menu(); ?>
					</div>
					<div class="header-bottom">
						<?php echo do_shortcode("[social_link]"); ?>
						<?php if(isset($hanata_settings['footer-copyright']) && $hanata_settings['footer-copyright']) : ?>		
							<div class="site-info">
								<?php echo esc_html($hanata_settings['footer-copyright']); ?>
							</div><!-- .site-info -->
						<?php else: ?>					
							<div class="site-info">
								<?php echo esc_html__( 'Copyright 2018 ','hanata'); ?>					
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html__('hanata', 'hanata'); ?></a>
								<?php echo esc_html__( 'Template. All Rights Reserved.','hanata'); ?>
							</div><!-- .site-info -->		
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div><!-- End header-wrapper -->

		
	</header><!-- End #bwp-header -->
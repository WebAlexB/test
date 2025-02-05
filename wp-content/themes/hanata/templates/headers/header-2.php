	<?php 
		$hanata_settings = hanata_global_settings();
		$show_minicart = (isset($hanata_settings['show-minicart']) && $hanata_settings['show-minicart']) ? ($hanata_settings['show-minicart']) : false;
		$enable_sticky_header = ( isset($hanata_settings['enable-sticky-header']) && $hanata_settings['enable-sticky-header'] ) ? ($hanata_settings['enable-sticky-header']) : false;
		$show_searchform = (isset($hanata_settings['show-searchform']) && $hanata_settings['show-searchform']) ? ($hanata_settings['show-searchform']) : false;		
		$show_wishlist = (isset($hanata_settings['show-wishlist']) && $hanata_settings['show-wishlist']) ? ($hanata_settings['show-wishlist']) : false;
	?>
	<h1 class="bwp-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<header id='bwp-header' class="bwp-header header-v2">
		<?php if(isset($hanata_settings['show-header-top']) && $hanata_settings['show-header-top']){ ?>
		<div id="bwp-topbar">
			<div class="topbar-inner">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 topbar-left">
						<?php if( isset($hanata_settings['phone']) && $hanata_settings['phone'] ) : ?>
							<span class="phone">
								<i class="fa fa-phone"></i><?php echo esc_html($hanata_settings['phone']); ?>
							</span>
						<?php endif; ?>
						<?php if( isset($hanata_settings['mail']) && $hanata_settings['mail'] ) : ?>
							<span class="mail hidden-xs hidden-sm">
								<i class="fa fa-envelope-o"></i><?php echo esc_html($hanata_settings['mail']); ?>
							</span>
						<?php endif; ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 topbar-right">
						<?php if(is_active_sidebar('top-link')){ ?>
						<div class="block-top-link pull-right">					
							<?php dynamic_sidebar( 'top-link' ); ?>			
						</div>
						<?php } ?>

						<?php if($show_wishlist && class_exists( 'YITH_WCWL' )){ ?>
						<div class="wishlist-box hidden-xs pull-right">
							<a href="<?php echo get_permalink( get_option('yith_wcwl_wishlist_page_id') ); ?>"><i class="icon_heart_alt"></i></a>
						</div>
						<?php } ?>
						<?php echo do_shortcode("[social_link]"); ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class='header-wrapper '>
			<div class='header-content' data-sticky_header="<?php echo esc_attr($hanata_settings['enable-sticky-header']); ?>">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 header-logo">
						<?php hanata_header_logo(); ?>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 wpbingo-menu-mobile text-center">
						<?php hanata_top_menu(); ?>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 header-right">	
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
					</div>
				</div>
			</div>
		</div><!-- End header-wrapper -->

		
	</header><!-- End #bwp-header -->
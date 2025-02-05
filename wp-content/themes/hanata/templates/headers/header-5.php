	<?php 
		$hanata_settings = hanata_global_settings();
		$enable_sticky_header = ( isset($hanata_settings['enable-sticky-header']) && $hanata_settings['enable-sticky-header'] ) ? ($hanata_settings['enable-sticky-header']) : false;
		$show_minicart = (isset($hanata_settings['show-minicart']) && $hanata_settings['show-minicart']) ? ($hanata_settings['show-minicart']) : false;
		$show_searchform = (isset($hanata_settings['show-searchform']) && $hanata_settings['show-searchform']) ? ($hanata_settings['show-searchform']) : false;		
		$show_wishlist = (isset($hanata_settings['show-wishlist']) && $hanata_settings['show-wishlist']) ? ($hanata_settings['show-wishlist']) : false;
	?>
	<h1 class="bwp-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<header id='bwp-header' class="bwp-header header-v5">
		<div class='header-wrapper '>
			<div class='header-content' data-sticky_header="<?php echo esc_attr($hanata_settings['enable-sticky-header']); ?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 header-logo">
							<?php hanata_header_logo(); ?>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-6 col-xs-5 wpbingo-menu-mobile text-center">
							<?php hanata_top_menu(); ?>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-6 col-xs-7 header-right">	
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
						</div>
					</div>
				</div>
			</div>
		</div><!-- End header-wrapper -->
		
	</header><!-- End #bwp-header -->
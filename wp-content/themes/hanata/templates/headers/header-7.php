	<?php 
		$hanata_settings = hanata_global_settings();
		$show_minicart = (isset($hanata_settings['show-minicart']) && $hanata_settings['show-minicart']) ? ($hanata_settings['show-minicart']) : false;
		$enable_sticky_header = ( isset($hanata_settings['enable-sticky-header']) && $hanata_settings['enable-sticky-header'] ) ? ($hanata_settings['enable-sticky-header']) : false;
		$show_searchform = (isset($hanata_settings['show-searchform']) && $hanata_settings['show-searchform']) ? ($hanata_settings['show-searchform']) : 
		false;	
		$show_wishlist = (isset($hanata_settings['show-wishlist']) && $hanata_settings['show-wishlist']) ? ($hanata_settings['show-wishlist']) : false;	
	?>
	<h1 class="bwp-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<header id='bwp-header' class="bwp-header header-v7">
		<div class='header-wrapper '>
			<div class='header-content' data-sticky_header="<?php echo esc_attr($hanata_settings['enable-sticky-header']); ?>">
				<div class="header-top">
					<div class="row">
						<div class="col-xs-5">
							<div class="header-logo">
								<?php hanata_header_logo(); ?>
							</div>
						</div>
						<div class="col-xs-7">
							<div class="header-right">	
								<div class="navigation-right inline pull-right">
									<div class="menu-title-box">
										<button type="button" class="navbar-toggle menu-title">
											<i class="fa fa-bars"></i>
										</button>    			
									</div>							
								</div>
								<div class="wpbingo-menu-right">
									<div class="wpbingo-menu-mobile wpbingo-menu-sidebar">
										<div class="hanata-close"></div>
										<?php hanata_top_menu_right(); ?>
									</div>
									<?php echo do_shortcode("[social_link]"); ?>
								</div>
								<?php if($show_minicart && class_exists( 'WooCommerce' )){ ?>
								<div class="wpbingoCartTop pull-right">
									<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
					        	</div>
								<?php } ?>		
								<?php if(is_active_sidebar('top-link')){ ?>
								<div class="block-top-link pull-right">					
									<?php dynamic_sidebar( 'top-link' ); ?>			
								</div>
								<?php } ?>
								<!-- Begin Search -->
								<?php if($show_searchform && class_exists( 'WooCommerce' )){ ?>
								<div class="search-box pull-right hidden-xs">
									<div class="search-toggle"><i class="icon_search"></i></div>
								</div>
								<?php } ?>
								<!-- End Search -->	
							</div>
						</div>
					</div>
				</div>	
				<div class="header-categories">
					<div class="navigation-categories hidden-lg hidden-md">
						<span class="title-navigation-categories">
							<?php esc_html_e( 'Categories', 'hanata' ); ?>
						</span>
					</div>
					<div class="menu-categories">	
						<div class="hanata-close"></div>					
						<?php if ( is_active_sidebar( 'menu-categories' ) ) : ?>
						    <?php dynamic_sidebar( 'menu-categories' ); ?>
						<?php endif; ?>
					</div>
				</div>		

			</div>
		</div><!-- End header-wrapper -->

		
	</header><!-- End #bwp-header -->
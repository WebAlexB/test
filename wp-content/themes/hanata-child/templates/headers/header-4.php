<?php
$hanata_settings      = hanata_global_settings();
$enable_sticky_header = ( isset( $hanata_settings['enable-sticky-header'] ) && $hanata_settings['enable-sticky-header'] ) ? ( $hanata_settings['enable-sticky-header'] ) : false;
$show_minicart        = ( isset( $hanata_settings['show-minicart'] ) && $hanata_settings['show-minicart'] ) ? ( $hanata_settings['show-minicart'] ) : false;
$show_searchform      = ( isset( $hanata_settings['show-searchform'] ) && $hanata_settings['show-searchform'] ) ? ( $hanata_settings['show-searchform'] ) : false;
$show_wishlist        = ( isset( $hanata_settings['show-wishlist'] ) && $hanata_settings['show-wishlist'] ) ? ( $hanata_settings['show-wishlist'] ) : false;
?>
<h1 class="bwp-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                              rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<header id='bwp-header' class="bwp-header header-v4">
	<div class='header-wrapper '>
		<div class="col-lg-5 col-md-6 col-sm-4 col-xs-2 wpbingo-menu-mobile desktop-menu menu-header">
			<?php hanata_top_menu(); ?>
		</div>
		<div class='header-content' data-sticky_header="<?php echo esc_attr( $enable_sticky_header ); ?>">
			<div class="row section-menu">
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 header-logo text-center">
					<?php hanata_header_logo(); ?>
				</div>
				<div class="col-lg-5 col-md-4 col-sm-8 col-xs-10 header-right section-search">
					<!-- Begin Search -->
					<?php if ( $show_searchform && class_exists( 'WooCommerce' ) ) { ?>
						<?php hanata_search_form_product(); ?>
					<?php } ?>
					<!-- End Search -->
					<?php if ( isset( $hanata_settings['phone'] ) && $hanata_settings['phone'] ) : ?>
						<span class="phone pull-right">
								<a href="tel:<?php echo esc_attr( $hanata_settings['phone'] ); ?>">
                                 <i class="fa fa-phone"></i>
                                </a>
						</span>
					<?php endif; ?>
					<div class="time-work">
						<div class="work-section">
							<p><?php echo esc_html__( 'Графік роботи:' ) ?></p>
							<span><?php echo esc_html__( 'ПН. - СБ.: 10:00 19:00' ) ?></span>
							<span><?php echo esc_html__( 'Неділя - вихідний' ) ?></span>
						</div>
					</div>
					<?php if ( is_active_sidebar( 'top-link' ) ) { ?>
						<div class="block-top-link pull-right">
							<?php dynamic_sidebar( 'top-link' ); ?>
						</div>
					<?php } ?>

					<?php if ( $show_wishlist && class_exists( 'YITH_WCWL' ) ) { ?>
						<div class="wishlist-box pull-right hidden-xs">
							<a href="<?php echo get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ); ?>"><i
										class="icon_heart_alt"></i></a>
						</div>
					<?php } ?>

					<?php if ( $show_minicart && class_exists( 'WooCommerce' ) ) { ?>
						<div class="wpbingoCartTop pull-right">
							<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div><!-- End header-wrapper -->

</header><!-- End #bwp-header -->

<style>
	@media (min-width: 767px) {
		.bwp-header.header-v4 .header-content {
			padding: 0 40px 40px 40px;
		}
		.fa-phone {
			font-size: 20px;
		}

		.phone {
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.work-section p {
			margin: 0;
		}
		body .desktop-menu {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			padding-top: 24px;
		}
	}
	@media (max-width: 767px) {
		#bwp-header .phone {
			display: none;
		}
		.work-section {
			display: none;
		}
	}
</style>

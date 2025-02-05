<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header();
do_action( 'woocommerce_before_main_content' );
$sidebar_product = hanata_category_sidebar();

?>
	<div class="container">
		<div class="main-archive-product row">
			<?php if($sidebar_product == 'left' && is_active_sidebar('sidebar-product')):?>			
				<div class="bwp-sidebar sidebar-product <?php echo esc_attr(hanata_get_class()->class_sidebar_left); ?>">
					<?php if ( ( class_exists("WCV_Vendors") && WCV_Vendors::is_vendor_page() ) || is_tax('dc_vendor_shop') ) { ?>
						<?php dynamic_sidebar( 'sidebar-vendor' );?>
					<?php }else{ ?>	
						<?php dynamic_sidebar( 'sidebar-product' );?>
					<?php } ?>
				</div>				
			<?php endif; ?>
			<div class="<?php echo esc_attr(hanata_get_class()->class_product_content); ?>" >
			
				<?php do_action( 'woocommerce_archive_description' ); ?>
				
				<?php if(apply_filters( 'hanata_custom_category', $html = '' )){ ?>
				<ul class="woocommerce-product-subcategories">
					<?php echo (apply_filters( 'hanata_custom_category', $html = '' )); ?>
				</ul>
				<?php } ?>
				
				<?php if ( have_posts() ) : ?>
					<div class="bwp-top-bar top clearfix">				
						<?php hanata_category_top_bar(); ?>							
					</div>
					<?php if($sidebar_product == 'full'): ?>		
						<div class="bwp-sidebar sidebar-product-filter full">
							<?php dynamic_sidebar( 'sidebar-product' ); ?>	
						</div>
					<?php endif; ?>
					<?php woocommerce_product_loop_start(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile;  ?>

					<?php woocommerce_product_loop_end(); ?>
					<div class="bwp-top-bar bottom clearfix">
						<?php hanata_category_bottom(); ?>
					</div>
				<?php else : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

			</div>
			<?php if($sidebar_product == 'right' && is_active_sidebar('sidebar-product')):?>
				<div class="bwp-sidebar sidebar-product <?php echo esc_attr(hanata_get_class()->class_sidebar_right); ?>">
					<?php if ( ( class_exists("WCV_Vendors") && WCV_Vendors::is_vendor_page() ) || is_tax('dc_vendor_shop') ) { ?>
						<?php dynamic_sidebar( 'sidebar-vendor' );?>
					<?php }else{ ?>	
						<?php dynamic_sidebar( 'sidebar-product' );?>
					<?php } ?>
				</div>	
			<?php endif; ?>
		</div>
	</div>
<?php
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' ); 
?>
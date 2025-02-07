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
			<?php if ( $sidebar_product == 'left' && is_active_sidebar( 'sidebar-product' ) ): ?>
				<div class="bwp-sidebar sidebar-product <?php echo esc_attr( hanata_get_class()->class_sidebar_left ); ?>">
					<?php if ( ( class_exists( "WCV_Vendors" ) && WCV_Vendors::is_vendor_page() ) || is_tax( 'dc_vendor_shop' ) ) { ?>
						<?php dynamic_sidebar( 'sidebar-vendor' ); ?>
					<?php } else { ?>
						<?php dynamic_sidebar( 'sidebar-product' ); ?>
					<?php } ?>
				</div>
			<?php endif; ?>
			<div class="<?php echo esc_attr( hanata_get_class()->class_product_content ); ?>">

				<?php do_action( 'woocommerce_archive_description' ); ?>

				<?php if ( apply_filters( 'hanata_custom_category', $html = '' ) ) { ?>
					<ul class="woocommerce-product-subcategories">
						<?php echo( apply_filters( 'hanata_custom_category', $html = '' ) ); ?>
					</ul>
				<?php } ?>

				<?php if ( have_posts() ) : ?>
					<div class="bwp-top-bar top clearfix">
						<?php hanata_category_top_bar(); ?>
					</div>
					<?php if ( $sidebar_product == 'full' ): ?>
						<div class="bwp-sidebar sidebar-product-filter full">
							<?php dynamic_sidebar( 'sidebar-product' ); ?>
						</div>
					<?php endif; ?>
					<?php woocommerce_product_loop_start(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; ?>

					<?php woocommerce_product_loop_end(); ?>
					<div class="bwp-top-bar bottom clearfix">
						<?php hanata_category_bottom(); ?>
					</div>
				<?php else : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

			</div>
			<?php if ( $sidebar_product == 'right' && is_active_sidebar( 'sidebar-product' ) ): ?>
				<div class="bwp-sidebar sidebar-product <?php echo esc_attr( hanata_get_class()->class_sidebar_right ); ?>">
					<?php if ( ( class_exists( "WCV_Vendors" ) && WCV_Vendors::is_vendor_page() ) || is_tax( 'dc_vendor_shop' ) ) { ?>
						<?php dynamic_sidebar( 'sidebar-vendor' ); ?>
					<?php } else { ?>
						<?php dynamic_sidebar( 'sidebar-product' ); ?>
					<?php } ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php
$category = get_queried_object();
do_action( 'woocommerce_after_main_content' );
if ( have_rows( 'category_faq', get_queried_object() ) ): ?>
	<div class="faq-section">
		<h2><?php echo esc_html__( 'Часті питання про категорію ', 'hanata' ) . esc_html( $category->name ); ?></h2>
		<div class="faq-list">
			<?php while ( have_rows( 'category_faq', get_queried_object() ) ): the_row(); ?>
				<div class="faq-item">
					<div class="faq-question">
						<span class="faq-toggle">+</span>
						<strong><?php the_sub_field( 'question' ); ?></strong>
					</div>
					<div class="faq-answer">
						<?php the_sub_field( 'answer' ); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif;

$category_text = get_field( 'ks', $category );

if ( $category_text ) :
	$allowed_tags = [
		'p'      => [],
		'br'     => [],
		'strong' => [],
		'em'     => [],
		'b'      => [],
		'i'      => [],
		'ul'     => [],
		'ol'     => [],
		'li'     => [],
		'a'      => [ 'href' => [], 'title' => [], 'target' => [] ],
		'span'   => [ 'style' => [] ],
		'div'    => [ 'class' => [], 'style' => [] ],
	];
	?>
	<section class="catalog__text">
		<div class="seo-text j-seo-text-expander __clip"
		     data-toggle-text='{"show":"Розгорнути", "hide":"Згорнути"}'
		     style="max-height: 190px; overflow: hidden;">
			<div class="text">
				<?php echo wp_kses( $category_text, $allowed_tags ); ?>
			</div>
		</div>
		<p class="a-pseudo js-toggle-button">Розгорнути</p>
	</section>
<?php endif; ?>
<?php get_footer( 'shop' );
?>
<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * @see       http://docs.woothemes.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header();
?>

<?php
/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked hanata_woocommerce_breadcrumb - 20
 */
$sidebar_detail_product = hanata_get_config('sidebar_detail_product');
do_action( 'woocommerce_before_main_content' );
?>

<div class="container clearfix">
	<div class="contents-detail">
		<div class="main-single-product row">
			<?php if ($sidebar_detail_product == 'left' && is_active_sidebar('sidebar-product')): ?>
				<div class="bwp-sidebar sidebar-product <?php echo esc_attr(hanata_get_class()->class_sidebar_left); ?>">
					<?php dynamic_sidebar('sidebar-product'); ?>
				</div>
			<?php endif; ?>
			<div class="custom-product-slider">
				<div class="slick-slider">
					<?php
					global $post;
					$product = wc_get_product($post->ID);

					if ($product) {
						$attachment_ids = $product->get_gallery_image_ids();
						if (has_post_thumbnail()) {
							echo '<div>';
							echo get_the_post_thumbnail($product->get_id(), 'large');
							echo '</div>';
						}
						if ($attachment_ids) {
							foreach ($attachment_ids as $attachment_id) {
								echo '<div>';
								echo wp_get_attachment_image($attachment_id, 'large');
								echo '</div>';
							}
						}
					} else {
						echo '<p>Изображения товара не найдены.</p>';
					}
					?>
				</div>
			</div>

			<div class="<?php echo esc_attr(hanata_get_class()->class_detail_product_content); ?> <?php if (is_active_sidebar('sidebar-product') && $sidebar_detail_product == 'left') { echo "pull-right"; } ?>">
				<?php while (have_posts()) : the_post(); ?>
					<?php wc_get_template_part('content', 'single-product'); ?>
				<?php endwhile; ?>
			</div>

			<?php if ($sidebar_detail_product == 'right' && is_active_sidebar('sidebar-product')): ?>
				<div class="bwp-sidebar sidebar-product <?php echo esc_attr(hanata_get_class()->class_sidebar_left); ?>">
					<?php dynamic_sidebar('sidebar-product'); ?>
				</div>
			<?php endif; ?>

			<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content');
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>


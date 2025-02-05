<?php 
global $product, $woocommerce_loop, $post;
remove_action('woocommerce_after_shop_loop_item', 'hanata_quickview'); 
add_action('woocommerce_before_shop_loop_item_title', 'hanata_quickview', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'hanata_add_loop_wishlist_link' , 20 );
add_action('woocommerce_before_shop_loop_item_title', 'hanata_add_loop_wishlist_link', 20 );
add_action( 'woocommerce_after_shop_loop_item_title', 'hanata_add_excerpt_in_product_archives', 15 );
?>
<div class="products-entry clearfix product-wapper">
<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="products-thumb">
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</div>
	<div class="products-content">
		<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
		<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
		<div class='product-button'>
			<?php do_action('woocommerce_after_shop_loop_item'); ?>
		</div>
	</div>
</div>
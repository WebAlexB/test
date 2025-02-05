<?php 
if ( !class_exists('Woocommerce') ) { 
	return false;
}
global $woocommerce; ?>
<div id="cart" class="dropdown mini-cart top-cart">
	<a class="dropdown-toggle cart-icon" data-toggle="dropdown" data-hover="dropdown" data-delay="0" href="#" title="<?php esc_attr_e('View your shopping cart', 'hanata'); ?>">
		<i class="icon_cart_alt"></i>
		<?php echo sprintf(_n(' <span class="mini-cart-items">%d</span> ', ' <span class="mini-cart-items">%d</span> ', $woocommerce->cart->cart_contents_count, 'hanata'), $woocommerce->cart->cart_contents_count);?>
    </a>
	<div class="cart-popup">
		<?php woocommerce_mini_cart(); ?>
	</div>
</div>
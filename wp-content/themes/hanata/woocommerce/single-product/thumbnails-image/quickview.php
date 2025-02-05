<?php
global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();
$_images =array();
if(has_post_thumbnail()){
	$_images[] = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
}else{
	$_images[] = '<img src="'. esc_url(wc_placeholder_img_src()) .'" alt="'.esc_attr__('Placeholder', 'hanata').'" />';
}
foreach ($attachment_ids as $attachment_id) {
	$_images[]       = wp_get_attachment_image( $attachment_id, 'shop_single' );
}
?>
<div id="quickview-slick-carousel">
	<?php if(count($_images)>0){ ?>
	<!-- Indicators -->
	<div class="quickview-slick" data-columns4="1" data-columns3="1" data-columns2="1" data-columns1="1" data-columns="1" data-nav="true" data-dots="true">
		<?php foreach ($_images as $key => $image) { ?>
		<div class="item">
			<?php echo trim( $image ); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>



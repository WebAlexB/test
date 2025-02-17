<?php
add_filter( 'woocommerce_catalog_orderby', 'custom_translate_orderby_options' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_translate_orderby_options' );

function custom_translate_orderby_options( $options ) {
	if ( isset( $options['menu_order'] ) ) {
		$options['menu_order'] = 'Сортувати товари';
	}
	if ( isset( $options['date'] ) ) {
		$options['date'] = 'Останні';
	}
	if ( isset( $options['rating'] ) ) {
		$options['rating'] = 'Найвищий рейтинг';
	}
	if ( isset( $options['popularity'] ) ) {
		$options['popularity'] = 'Найпопулярніші';
	}
	if ( isset( $options['featured'] ) ) {
		$options['featured'] = 'Рекомендовані';
	}

	return $options;
}

add_action('wp_footer', function() {
	?>
	<script>
		jQuery(document).ready(function($) {
			$('.filter-orderby li[data-value="date"]').text('Останні товари');
			$('.filter-orderby li[data-value="rating"]').text('Найвищий рейтинг');
			$('.filter-orderby li[data-value="popularity"]').text('Найпопулярніші');
			$('.filter-orderby li[data-value="featured"]').text('Рекомендовані товари');
		});
	</script>
	<?php
});

function mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'mime_types' );

function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime ) {
	if ( str_ends_with( $filename, '.svg' ) ) {
		$data['ext']  = 'svg';
		$data['type'] = 'image/svg+xml';
	}

	return $data;
}

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

function enable_comments_for_blog($open, $post_id) {
	$post = get_post($post_id);
	if ('blog' == $post->post_type) {
		return true;
	}
	return $open;
}
add_filter('comments_open', 'enable_comments_for_blog', 10, 2);

add_filter( 'woocommerce_cart_needs_payment', '__return_false' );


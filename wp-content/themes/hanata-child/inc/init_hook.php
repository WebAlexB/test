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

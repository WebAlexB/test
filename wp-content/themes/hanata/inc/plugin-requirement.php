<?php
/***** Active Plugin ********/

add_action( 'tgmpa_register', 'hanata_register_required_plugins' );
function hanata_register_required_plugins() {
    $plugins = array(
		array(
            'name'               => esc_html__('Woocommerce', 'hanata'), 
            'slug'               => 'woocommerce', 
            'required'           => false
        ),		
		array(
            'name'               => esc_html__('Visual Composer', 'hanata'), 
            'slug'               => 'js_composer', 
            'source'             => get_template_directory() . '/plugins/js_composer.zip',
            'required'           => true, 
        ),
		array(
            'name'               => esc_html__('Revolution Slider', 'hanata'), 
			'slug'               => 'revslider',
			'source'             => get_template_directory() . '/plugins/revslider.zip', 
			'required'           => true, 
        ),
		array(
            'name'               => esc_html__('Wpbingo Core', 'hanata'), 
            'slug'               => 'wpbingo', 
            'source'             => get_template_directory() . '/plugins/wpbingo.zip',
            'required'           => true, 
        ),			
		array(
            'name'               => esc_html__('Redux Framework', 'hanata'), 
            'slug'               => 'redux-framework', 
            'required'           => false
        ),			
		array(
            'name'      		 => esc_html__('Contact Form 7', 'hanata'),
            'slug'     			 => 'contact-form-7',
            'required' 			 => false
        ),
		array(
            'name'     			 => esc_html__('YITH Woocommerce Wishlist', 'hanata'),
            'slug'      		 => 'yith-woocommerce-wishlist',
            'required' 			 => false
        ), 
		array(
            'name'     			 => esc_html__('WooCommerce Variation Swatches', 'hanata'),
            'slug'      		 => 'variation-swatches-for-woocommerce',
            'required' 			 => false
        ),
    );
    $config = array();

    tgmpa( $plugins, $config );

}	
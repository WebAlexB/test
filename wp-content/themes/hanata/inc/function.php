<?php
	function hanata_get_config($option,$default='1'){
		$hanata_settings = hanata_global_settings();
		$query_string = hanata_get_query_string();
		parse_str($query_string, $params);
		if(isset($params[$option]) && $params[$option]){
			return $params[$option];
		}
		else{
			$value = isset($hanata_settings[$option]) ? $hanata_settings[$option] : $default;
			return $value;
		}
	}
	
	function hanata_get_query_string(){
		global $wp_rewrite;
		$request = remove_query_arg( 'paged' );
		$home_root = parse_url(home_url());
		$home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
		$home_root = preg_quote( $home_root, '|' );
		$request = preg_replace('|^'. $home_root . '|i', '', $request);
		$request = preg_replace('|^/+|', '', $request);
		$request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
		$request = preg_replace( '|^' . preg_quote( $wp_rewrite->index, '|' ) . '|i', '', $request);
		$request = ltrim($request, '/');
		
		$qs_regex = '|\?.*?$|';
		preg_match( $qs_regex, $request, $qs_match );
		if ( !empty( $qs_match[0] ) ) {
			$query_string = $qs_match[0];
			$query_string = str_replace("?","",$query_string);
		} else {
			$query_string = '';
		}

		return 	$query_string;
	}
	
	function hanata_addURLParameter($url, $paramName, $paramValue) {
		 $url_data = parse_url($url);
		 if(!isset($url_data["query"]))
			 $url_data["query"]="";

		 $params = array();
		 parse_str($url_data['query'], $params);
		 $params[$paramName] = $paramValue;
		 $url_data['query'] = http_build_query($params);
		 return hanata_build_url( $url_data );
	}	
	
	function hanata_build_url($url_data) {
		$url="";
		if(isset($url_data['host'])){
			 $url .= $url_data['scheme'] . '://';
			 if (isset($url_data['user'])) {
				 $url .= $url_data['user'];
					 if (isset($url_data['pass'])) {
						 $url .= ':' . $url_data['pass'];
					 }
				 $url .= '@';
			 }
			 $url .= $url_data['host'];
			 if (isset($url_data['port'])) {
				 $url .= ':' . $url_data['port'];
			 }
		}
		if (isset($url_data['path'])) {
			$url .= $url_data['path'];
		}
		if (isset($url_data['query'])) {
			$url .= '?' . $url_data['query'];
		}
		if(isset($url_data['fragment'])) {
			$url .= '#' . $url_data['fragment'];
		}
		
		return $url;
	}	
	
	function hanata_global_settings(){
		global $hanata_settings;
		return $hanata_settings;
	}
	
	if ( ! function_exists( 'hanata_popup_newsletter' ) ) {
		function hanata_popup_newsletter() {
			$hanata_settings = hanata_global_settings(); 
			echo '<div class="popupshadow" style="display:none"></div>';
			echo '<div id="newsletterpopup" class="bingo-modal newsletterpopup" style="display:none">';
			echo '<span class="close-popup">x</span>';
			echo '<div class="wp-newletter"';
				if(isset($hanata_settings['background_newletter_img']['url']) && !empty($hanata_settings['background_newletter_img']['url'])){
					echo ' style="background:url('.esc_url($hanata_settings['background_newletter_img']['url']).')"';
				}
			echo '>';	
				dynamic_sidebar('newletter-popup-form');
			echo '</div>';
			echo '</div>';
		}
	}	
		
	
	function hanata_config_font(){
		$config_fonts = array();
		$text_fonts = array(
			'family_font_body',
			'family_font_custom',
			'h1-font',
			'h2-font',
			'h3-font',
			'h4-font',
			'h5-font',
			'h6-font',
			'class_font_custom'
		);
		foreach ($text_fonts as $text) {
			if(hanata_get_config($text))
				$config_fonts[$text] = hanata_get_config($text);
		}
		return $config_fonts;
	}
	
	function hanata_get_class(){
		$class = new stdClass;
		$sidebar_left_expand 		= hanata_get_config('sidebar_left_expand',3);
		$sidebar_left_expand_md 	= hanata_get_config('sidebar_left_expand_md',3);
		$class->class_sidebar_left  = 'col-lg-'.$sidebar_left_expand.' col-md-'.$sidebar_left_expand_md.' col-sm-12 col-xs-12';
		
		$sidebar_right_expand 		= hanata_get_config('sidebar_right_expand',3);
		$sidebar_right_expand_md 	= hanata_get_config('sidebar_right_expand_md',3);
		$class->class_sidebar_right  = 'col-lg-'.$sidebar_right_expand.' col-md-'.$sidebar_right_expand_md.' col-sm-12 col-xs-12';
		
		$sidebar_blog = hanata_blog_sidebar();
		if($sidebar_blog == 'left' && is_active_sidebar('sidebar-blog')){
			$blog_content_expand = 12- $sidebar_left_expand;
			$blog_content_expand_md = 12- $sidebar_left_expand_md;
		}elseif($sidebar_blog == 'right' && is_active_sidebar('sidebar-blog')){
			$blog_content_expand = 12- $sidebar_right_expand;
			$blog_content_expand_md = 12- $sidebar_right_expand_md;
		}else{
			$blog_content_expand = 12;
			$blog_content_expand_md = 12;
		}
		
		$class->class_blog_content  = 'col-lg-'.$blog_content_expand.' col-md-'.$blog_content_expand_md.' col-sm-12 col-xs-12';		

		
		$post_single_layout = hanata_post_sidebar();
		if($post_single_layout == 'left' && is_active_sidebar('sidebar-blog')){
			$blog_single_expand = 12- $sidebar_left_expand;
			$blog_single_expand_md = 12- $sidebar_left_expand_md;
		}elseif($post_single_layout == 'right' && is_active_sidebar('sidebar-blog')){
			$blog_single_expand = 12- $sidebar_right_expand;
			$blog_single_expand_md = 12- $sidebar_right_expand_md;
		}else{
			$blog_single_expand = 12;
			$blog_single_expand_md = 12;
		}
		
		$class->class_single_content  = 'col-lg-'.$blog_single_expand.' col-md-'.$blog_single_expand_md.' col-sm-12 col-xs-12';		
		
		
		$sidebar_product = hanata_category_sidebar();
		if($sidebar_product == 'left' && is_active_sidebar('sidebar-product')){
			$product_content_expand = 12- $sidebar_left_expand;
			$product_content_expand_md = 12- $sidebar_left_expand_md;
		}elseif($sidebar_product == 'right' && is_active_sidebar('sidebar-product')){
			$product_content_expand = 12- $sidebar_right_expand;
			$product_content_expand_md = 12- $sidebar_right_expand_md;
		}else{
			$product_content_expand = 12;
			$product_content_expand_md = 12;
		}
		$class->class_product_content  = 'col-lg-'.$product_content_expand.' col-md-'.$product_content_expand_md.' col-sm-12 col-xs-12';		

		$sidebar_detail_product = hanata_get_config('sidebar_detail_product');
		if($sidebar_detail_product == 'left' && is_active_sidebar('sidebar-product')){
			$product_content_expand = 12- $sidebar_left_expand;
			$product_content_expand_md = 12- $sidebar_left_expand_md;
		}elseif($sidebar_detail_product == 'right' && is_active_sidebar('sidebar-product')){
			$product_content_expand = 12- $sidebar_right_expand;
			$product_content_expand_md = 12- $sidebar_right_expand_md;
		}else{
			$product_content_expand = 12;
			$product_content_expand_md = 12;
		}
		$class->class_detail_product_content  = 'col-lg-'.$product_content_expand.' col-md-'.$product_content_expand_md.' col-sm-12 col-xs-12';	
		
		$blog_col_large 	= 12/(hanata_get_config('blog_col_large',3));
		$blog_col_medium = 12/(hanata_get_config('blog_col_medium',3));
		$blog_col_sm 	= 12/(hanata_get_config('blog_col_sm',3));
		
		$class->class_item_blog = 'col-lg-'.$blog_col_large.' col-md-'.$blog_col_medium.' col-sm-'.$blog_col_sm.' col-xs-12';
		
		return $class;
	}
	
	function hanata_post_sidebar(){
		$sidebar_post = get_post_meta( get_the_ID(), 'post_single_layout', true );
		if( !empty($sidebar_post)){
			$post_single_layout = $sidebar_post;
		}else{
			$post_single_layout = hanata_get_config('post-single-layout','left');
		}
		
		return 	$post_single_layout;
	}
	
	function hanata_blog_view(){
		$category = get_category( get_query_var( 'cat' ) );
		$id_category =  ( isset($category->term_id) && $category->term_id ) ? $category->term_id : 0;
		$layout_blog = get_term_meta( $id_category, 'layout_blog', true );
		if( !empty($layout_blog) ){
			$blog_view = $layout_blog;
		}else{
			$blog_view = hanata_get_config('layout_blog','list');
		}
		return 	$blog_view;
	}
	
	function hanata_blog_sidebar(){
		$category = get_category( get_query_var( 'cat' ) );
		$id_category =  ( isset($category->term_id) && $category->term_id ) ? $category->term_id : 0;
		$sidebar_blog = get_term_meta( $id_category, 'sidebar_blog', true );
		if( !empty($sidebar_blog) ){
			$sidebar = $sidebar_blog;
		}else{
			$sidebar 		= hanata_get_config('sidebar_blog','left');
		}
		return 	$sidebar;
	}	
	
	function hanata_is_customize(){
		return isset($_POST['customized']) && ( isset($_POST['customize_messenger_chanel']) || isset($_POST['wp_customize']) );
	}	
	
	function hanata_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="search-from" action="' . esc_url(home_url( '/' )) . '" >
					<div class="container">
						<div class="form-content">
							<input type="text" value="' . esc_attr(get_search_query()) . '" name="s"  class="s" placeholder="' . esc_attr__( 'Search...', 'hanata' ) . '" />
							<button id="searchsubmit" class="btn" type="submit">
								<i class="fa fa-search"></i>
								<span>' . esc_html__( 'Search', 'hanata' ) . '</span>
							</button>
						</div>
					</div>
				  </form>';
		return $form;
	}
	add_filter( 'get_search_form', 'hanata_search_form' );

	// Remove each style one by one
	add_filter( 'woocommerce_enqueue_styles', 'hanata_jk_dequeue_styles' );
	function hanata_jk_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
		unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
		unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
		return $enqueue_styles;
	}

	// Or just remove them all in one line
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );					
					
	function hanata_woocommerce_breadcrumb( $args = array() ) {
		$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '<span class="delimiter"></span>',
			'wrap_before' => '<div class="breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
			'wrap_after'  => '</div>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'hanata' )
		) ) );

		$breadcrumbs = new WC_Breadcrumb();

		if ( $args['home'] ) {
			$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
		}

		$args['breadcrumb'] = $breadcrumbs->generate();

		wc_get_template( 'global/breadcrumb.php', $args );
	}
	
	add_filter('woocommerce_add_to_cart_fragments', 'hanata_woocommerce_header_add_to_cart_fragment');
	function hanata_woocommerce_header_add_to_cart_fragment( $fragments )
	{
	    global $woocommerce;
	    ob_start(); 
	    get_template_part( 'woocommerce/minicart-ajax' );
	    $fragments['.mini-cart'] = ob_get_clean();
	    return $fragments;
	}

	function hanata_display_view(){
		echo hanata_grid_list();
    }
	
	function hanata_grid_list(){
		$category_view_mode = hanata_category_view();
		$query_string = '?'.hanata_get_query_string();
		$active_list = ($category_view_mode == 'list') ? 'active' : '';
		$active_grid = ($category_view_mode == 'grid') ? 'active' : '';
		$html = '<ul class="display hidden-sm hidden-xs pull-left">
				<li>
					<a class="view-products view-grid '.esc_html($active_grid).'" href="'. hanata_addURLParameter($query_string, 'category-view-mode', 'grid').'"><i class="fa fa-th-large"></i></a>
				</li>
				<li>
					<a class="view-products view-list '.esc_html($active_list).'" href="'. hanata_addURLParameter($query_string, 'category-view-mode', 'list').'"><i class="fa fa-bars"></i></a>
				</li>
			</ul>';
		
		return $html;
	}
	
	function hanata_category_view(){
		$id_category =  is_tax() ? get_queried_object()->term_id : 0;
		$category_view = get_term_meta( $id_category, 'category_view', true );
		if( $category_view &&  $id_category != 0 ){
			$category_view_mode = $category_view;
		}else{
			$category_view_mode 		= hanata_get_config('category-view-mode','grid');	
		}
		
		return 	$category_view_mode;
	}
	
	function hanata_category_sidebar(){
		$id_category =  is_tax() ? get_queried_object()->term_id : 0;
		$category_sidebar = get_term_meta( $id_category, 'category_sidebar', true );
		if( $category_sidebar &&  $id_category != 0 ){
			$sidebar_product = $category_sidebar;
		}else{
			$sidebar_product 		= hanata_get_config('sidebar_product','left');	
		}
		
		return 	$sidebar_product;
	}	
	
	function hanata_main_menu($id, $layout = "") {

		global $hanata_settings, $post;

		$show_cart = $show_wishlist = false;
		if ( isset($hanata_settings['show_cart']) ) {
		$show_cart            = $hanata_settings['show_cart'];
		}
		if ( isset($hanata_settings['show_wishlist']) ) {
		$show_wishlist            = $hanata_settings['show_wishlist'];
		}
		$vertical_header_text = (isset($hanata_settings['vertical_header_text']) && $hanata_settings['vertical_header_text']) ? $hanata_settings['vertical_header_text'] : '';
		$page_menu = $menu_output = $menu_full_output = $menu_with_search_output = $menu_float_output = $menu_vert_output = "";

		$main_menu_args = array(
			'echo'            => false,
			'theme_location' => 'main_navigation',
			'walker' => new hanata_mega_menu_walker,
		);
		
		$menu_output .= '<nav id="'.$id.'" class="std-menu clearfix">'. "\n";

		if(function_exists('wp_nav_menu')) {
			if (has_nav_menu('main_navigation')) {
				$menu_output .= wp_nav_menu( $main_menu_args );
			}
			else {
				$menu_output .= '<div class="no-menu">'. esc_html__("Please assign a menu to the Main Menu in Appearance > Menus", 'hanata').'</div>';
			}
		}
		$menu_output .= '</nav>'. "\n";
		switch ($layout) {
			case 'full':
					$menu_full_output .= '<div class="container">'. "\n";
					$menu_full_output .= '<div class="row">'. "\n";
					$menu_full_output .= '<div class="menu-left">'. "\n";
					$menu_full_output .= $menu_output . "\n";
					$menu_full_output .= '</div>'. "\n";
					$menu_full_output .= '<div class="menu-right">'. "\n";
					$menu_full_output .= '</div>'. "\n";
					$menu_full_output .= '</div>'. "\n";
					$menu_full_output .= '</div>'. "\n";
					$menu_output = $menu_full_output;
				break;
			case 'float':
					$menu_float_output .= '<div class="float-menu">'. "\n";
					$menu_float_output .= $menu_output . "\n";
					$menu_float_output .= '</div>'. "\n";
					$menu_output = $menu_float_output;
				break;
			case 'float-2':
					$menu_float_output .= '<div class="float-menu container">'. "\n";
					$menu_float_output .= $menu_output . "\n";
					$menu_float_output .= '</div>'. "\n";
					$menu_output = $menu_float_output;
				break;				
			case 'vertical':
				$menu_vertical_output .= $menu_output . "\n";
				$menu_vertical_output .= '<div class="vertical-menu-bottom">'. "\n";
				if($vertical_header_text)
				$menu_vertical_output .= '<div class="copyright">'.do_shortcode(stripslashes($vertical_header_text)).'</div>'. "\n";
				$menu_vertical_output .= '</div>'. "\n";

				$menu_output = $menu_vertical_output;
				break;
		}	
		return $menu_output;
	}				
	
	add_action('admin_enqueue_scripts','hanata_upload_scripts');	

	function hanata_upload_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
    }		
	
	function hanata_body_classes( $classes ) {
		if (is_single() || is_page() && !is_front_page()) {
			$classes[] = basename(get_permalink());
		}			
		$type_banner = hanata_get_config('banners_effect');
		$classes[] = $type_banner;		
		
		$direction = hanata_get_direction(); 
		if($direction && $direction == 'rtl'){
			$classes[] = 'rtl';
		}
		
		$box_layout 	= hanata_get_config('layout');
		if( $box_layout == 'boxed' ){
			$classes[] = 'box-layout';
		}else{
			$classes[] = 'full-layout';
		}	
		
		return $classes;
	}
	add_filter( 'body_class', 'hanata_body_classes' );

	function hanata_post_classes( $classes ) {
		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
			$classes[] = 'has-post-thumbnail';
		}

		return $classes;
	}
	add_filter( 'post_class', 'hanata_post_classes' );


	function hanata_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'hanata' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'hanata_wp_title', 10, 2 );
	
	function hanata_get_excerpt($limit = 45, $more_link = true, $more_style_block = false) {
		$hanata_settings = hanata_global_settings();

		if (!$limit) {
			$limit = 45;
		}

		if (has_excerpt()) {
			$content = get_the_excerpt();
		} else {
			$content = get_the_content();
		}
		
		if($content)
		{
			$content = hanata_strip_tags( apply_filters( 'the_content', $content ) );
			$content = explode(' ', $content, $limit);

			if (count($content) >= $limit) {
				array_pop($content);
				if ($more_link)
					$content = implode(" ",$content).'... ';
				else
					$content = implode(" ",$content).' [...]';
			} else {
				$content = implode(" ",$content);
			}
			
			$content = '<p class="post-excerpt">'.wp_kses_post($content).'</p>';
			
			if ($more_link) {
				if ($more_style_block) {
					$content .= ' <a class="read-more read-more-block" href="'.esc_url( apply_filters( 'the_permalink', get_permalink() ) ).'">'.esc_html__('Read more', 'hanata').'</a>';
				} else {
					$content .= ' <a class="read-more" href="'.esc_url( apply_filters( 'the_permalink', get_permalink() ) ).'">'.esc_html__('Continue Reading', 'hanata').'</a>';
				}
			}
		}
		return $content;
	}
	
	function hanata_strip_tags( $content ) {
		$content = str_replace( ']]>', ']]&gt;', $content );
		$content = preg_replace("/<script.*?\/script>/s", "", $content);
		$content = preg_replace("/<style.*?\/style>/s", "", $content);
		$content = strip_tags( $content );
		return $content;
	}
	
	if( !function_exists( 'hanata_get_direction' ) ) :
	function hanata_get_direction(){
		$direction = hanata_get_config('direction','ltr');		
		if (isset($_COOKIE['hanata_direction_cookie']))
			$direction = $_COOKIE['hanata_direction_cookie'];
		if(isset($_GET['direction']) && $_GET['direction'])
			$direction = $_GET['direction'];
		return 	$direction;
	}
	endif;	
	
	function hanata_get_entry_content_asset( $post_id ){
		$post = get_post( $post_id );

		$content = apply_filters ("the_content", $post->post_content);
		$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		if ( ! empty( $video ) ) {
			$html = '';
			foreach ( $video as $video_html ) {
				$html .=   '<div class="video-wrapper">';
					$html .= $video_html;
				$html .= '</div>';
			}
			return $html;
		}
	}
	
	function hanata_loading_overlay(){
		$hanata_settings = hanata_global_settings();
		if(isset($hanata_settings['show-loading-overlay']) && $hanata_settings['show-loading-overlay'] ){
			echo'<div class="loader-content">
				<div id="loader">
					<div class="chasing-dots"><div></div><div></div><div></div></div>
				</div>
			</div>';
		}
	}
	
	function hanata_header_logo(){
		$hanata_settings = hanata_global_settings(); 
		$sitelogo = (isset($hanata_settings['sitelogo']['url']) && $hanata_settings['sitelogo']['url']) ? $hanata_settings['sitelogo']['url'] : "";
		$page_logo_url = get_post_meta( get_the_ID(), 'page_logo', true );
		$page_logo_url = ($page_logo_url) ? $page_logo_url : $sitelogo; ?>
		<div class="wpbingoLogo">
			<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if($page_logo_url){ ?>
					<img src="<?php echo esc_url($page_logo_url); ?>" alt="<?php bloginfo('name'); ?>"/>
				<?php }else{
					$logo = get_template_directory_uri().'/images/logo/logo.png'; ?>
					<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
				<?php } ?>
			</a>
		</div> 
	<?php }
	
	function hanata_top_menu(){
		$hanata_settings = hanata_global_settings();
		echo '<div class="wpbingo-menu-wrapper">
			<div class="megamenu">
				<nav class="navbar-default">
					<div class="navbar-header">
						<button type="button" id="show-megamenu"  class="navbar-toggle">
							<span>'. esc_html__("Menu","hanata") .'</span>
						</button>
					</div>
					<div  class="bwp-navigation primary-navigation navbar-mega">
						'.hanata_main_menu( 'main-navigation', 'float' ).'
					</div>
				</nav> 
			</div>       
		</div>';
	}	

	function hanata_top_menu_right(){
		$hanata_settings = hanata_global_settings();
		echo '<div class="wpbingo-menu-wrapper">
			<div class="megamenu">
				<div  class="bwp-navigation primary-navigation navbar-mega">
					'.hanata_main_menu( 'main-navigation', 'float' ).'
				</div>
			</div>       
		</div>';
	}
	
	function hanata_copyright(){
		$hanata_settings = hanata_global_settings();?>
		<div class="bwp-copyright">
			<div class="container">		
			    <div class="row">
					<?php if(isset($hanata_settings['footer-copyright']) && $hanata_settings['footer-copyright']) : ?>		
						<div class="site-info col-sm-6 col-xs-12">
							<?php echo esc_html($hanata_settings['footer-copyright']); ?>
						</div><!-- .site-info -->
					<?php else: ?>					
						<div class="site-info col-sm-6 col-xs-12">
							<?php echo esc_html__( 'Copyright 2018 ','hanata'); ?>					
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html__('hanata', 'hanata'); ?></a>
							<?php echo esc_html__( 'Template. All Rights Reserved.','hanata'); ?>
						</div><!-- .site-info -->		
					<?php endif; ?>
					<?php if(isset($hanata_settings['footer-payments']) && $hanata_settings['footer-payments']) : ?>
						<div class="payment col-sm-6 col-xs-12">
							<a href="<?php echo isset($hanata_settings['footer-payments-link']) ? esc_url($hanata_settings['footer-payments-link']) : "#"; ?>">
								<img src="<?php echo isset($hanata_settings['footer-payments-image']['url']) ? esc_url($hanata_settings['footer-payments-image']['url']) : ""; ?>" alt="<?php echo isset($hanata_settings['footer-payments-image-alt']) ? esc_attr($hanata_settings['footer-payments-image-alt']) : ""; ?>" />
							</a>
						</div>		
					<?php endif; ?>	
				</div>
			</div>
		</div>	
		<?php	
	}
	
	function hanata_parseShortcodesCustomCss($post_content){
		echo hanata_ShortcodesCustomCss($post_content); 
	}
	
	function hanata_ShortcodesCustomCss($post_content){
		$output = '';
		if(class_exists("Vc_Manager")){
		   $shortcodes_custom_css = visual_composer()->parseShortcodesCustomCss( $post_content );
		   if ( ! empty( $shortcodes_custom_css ) ) {
			$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
			$output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
			$output .= $shortcodes_custom_css;
			$output .= '</style>';
		   }
		}
		return 	$output;	
	}

	if( !is_admin() ){
		add_filter( 'language_attributes', 'hanata_direction', 20 );
		function hanata_direction( $doctype = 'html' ){
	   		$direction = hanata_get_direction();
	   		if ( ( function_exists( 'is_rtl' ) && is_rtl() ) || $direction == 'rtl' ){
	    		$attribute[] = 'direction="rtl"';
	    		$attribute[] = 'class="rtl"';
	   		}
	   		( $direction === 'rtl' ) ? $lang = 'ar' : $lang = get_bloginfo('language');
	   		if ( $lang ) {
	   			if ( get_option('html_type') == 'text/html' || $doctype == 'html' )
	    			$attribute[] = "lang=\"$lang\"";

	   			if ( get_option('html_type') != 'text/html' || $doctype == 'xhtml' )
	    			$attribute[] = "xml:lang=\"$lang\"";
	   		}
	   		$hanata_output = implode(' ', $attribute);
	   		return $hanata_output;
		}
	}	
	
	function hanata_walker_comment($comment, $args, $depth) {
		?>
            <div class="media">
                <div class="media-left">
                   <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 100 ); ?>
                </div>
                <div class="media-body">
                    <div class="media-content last">
                        <h4 class="media-heading"><?php echo get_comment_author_link();?><span> <?php
							printf( esc_html__('%1$s at %2$s', 'hanata' ), get_comment_date(),  get_comment_time() );
							 ?></span></h4>
                        <p>  <?php comment_text(); ?></p>
                        
                         <?php 
					$args ['reply_text'] =  esc_html__( 'Reply', 'hanata' );
                    comment_reply_link( array_merge( $args, array(  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>
                </div>
            </div>
		<?php
	}
	
	function hanata_prefix_kses_allowed_html($allowed_tags, $context) {
		switch($context) {
			case 'social': 
			$allowed_tags = array(
				'a' => array(
					'class' => array(),
					'href'  => array(),
					'rel'   => array(),
					'title' => array(),
				),
				'abbr' => array(
					'title' => array(),
				),
				'b' => array(),
				'blockquote' => array(
					'cite'  => array(),
				),
				'cite' => array(
					'title' => array(),
				),
				'code' => array(),
				'br' => array(),
				'del' => array(
					'datetime' => array(),
					'title' => array(),
				),
				'dd' => array(),
				'div' => array(
					'class' => array(),
					'title' => array(),
					'style' => array(),
				),
				'dl' => array(),
				'dt' => array(),
				'em' => array(),
				'h1' => array(),
				'h2' => array(),
				'h3' => array(),
				'h4' => array(),
				'h5' => array(),
				'h6' => array(),
				'i' => array(
					'class'  => array(),
				),
				'img' => array(
					'alt'    => array(),
					'class'  => array(),
					'height' => array(),
					'src'    => array(),
					'width'  => array(),
				),
				'li' => array(
					'class' => array(),
				),
				'ol' => array(
					'class' => array(),
				),
				'p' => array(
					'class' => array(),
				),
				'q' => array(
					'cite' => array(),
					'title' => array(),
				),
				'span' => array(
					'class' => array(),
					'title' => array(),
					'style' => array(),
				),
				'strike' => array(),
				'strong' => array(),
				'ul' => array(
					'class' => array(),
				),
				'button' => array(
					'class' => array(),
					'type' => array(),
				),				
			);
			return $allowed_tags;
			default:
			return $allowed_tags;
		}
	}
	add_filter( 'wp_kses_allowed_html', 'hanata_prefix_kses_allowed_html', 10, 2);
	if ( ! function_exists( 'wp_body_open' ) ) {
		function wp_body_open() {
			do_action( 'wp_body_open' );
		}
	}	
?>
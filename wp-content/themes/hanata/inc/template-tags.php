<?php

if ( ! function_exists( 'hanata_paging_nav' ) ) :

function hanata_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$pagination = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => esc_html__( 'Previous', 'hanata' ),
		'next_text' => esc_html__( 'Next', 'hanata' ),
		'type'      => 'list'
	) );

	if ( $pagination ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'hanata' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo wp_kses( $pagination,'social' ); ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'hanata_post_nav' ) ) :

function hanata_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation hidden" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'hanata' ); ?></h1>
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', esc_html__( '<span class="meta-nav">Published In</span>%title', 'hanata' ) );
			else :
				previous_post_link( '%link', esc_html__( '<span class="meta-nav">Previous Post</span>%title', 'hanata' ) );
				next_post_link( '%link', esc_html__( '<span class="meta-nav">Next Post</span>%title', 'hanata' ) );
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

function hanata_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hanata_category_count' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hanata_category_count', $all_the_cool_cats );
	}

	if ( 1 !== (int) $all_the_cool_cats ) {
		return true;
	} else {
		return false;
	}
}


function hanata_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'hanata_category_count' );
}
add_action( 'edit_category', 'hanata_category_transient_flusher' );
add_action( 'save_post',     'hanata_category_transient_flusher' );

if ( ! function_exists( 'hanata_post_thumbnail' ) ) :

function hanata_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) : ?>
		<div class="post-thumbnail">
		<?php the_post_thumbnail( 'hanata-full-width' ); ?>
		</div>
	<?php else : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'hanata-full-width' ); ?>
		</a>
	<?php endif; // End is_singular()
}

endif;

function hanata_page_title() {
	global $post, $hanata_settings,$wp_query;
	$enable_page_title = isset($hanata_settings['page_title']) ? $hanata_settings['page_title'] : true ;
	if($enable_page_title){
		$bg = isset($hanata_settings['page_title_bg']['url']) ? $hanata_settings['page_title_bg']['url'] : "";
		$class_empty = (empty($bg)) ? " empty-image" : "";
		?>
		<div class="page-title bwp-title<?php echo esc_attr($class_empty); ?>" <?php echo (!empty($bg) ? ' style="background-image:url(' . esc_url( $bg ) . ');"' : ''); ?>>
			<div class="container" >
				<?php if(!is_single() ) :  ?>
					<h1>
						<?php						
						if( is_category() ) :
							single_cat_title();
						elseif (class_exists("WCV_Vendors") && WCV_Vendors::is_vendor_page()) :
							$vendor_shop 		= urldecode( get_query_var( 'vendor_shop' ) );
							$vendor_id   		= WCV_Vendors::get_vendor_id( $vendor_shop );
							$shop_name 			= WCV_Vendors::get_vendor_shop_name( stripslashes( $vendor_id ) );
						echo esc_html($shop_name);
						elseif (class_exists("WeDevs_Dokan") && dokan()->vendor->get( get_query_var( 'author' ) ) && get_query_var( 'author' ) != 0 ) :
							$store_user    = dokan()->vendor->get( get_query_var( 'author' ) );
							$shop_name 			= $store_user->get_shop_name();
							echo esc_html($shop_name);							
						elseif ( is_tax() ) :
							single_tag_title();	
						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							esc_html_e( 'Galleries', 'hanata' );
						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							esc_html_e( 'Images', 'hanata' );
						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							esc_html_e( 'Videos', 'hanata' );
						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							esc_html_e( 'Quotes', 'hanata' );
						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							esc_html_e( 'Audios', 'hanata' );
						elseif ( is_archive() && is_author() ) :
							esc_html_e( 'Posts by " ', 'hanata' ) . the_author() . esc_html_e(' " ','hanata');
						elseif ( function_exists('is_shop') && is_shop() ) :							
							esc_html_e( 'Shop', 'hanata' );
						elseif ( is_archive() && !is_search()) :						
							the_archive_title();
						elseif ( is_search() ) :
							printf( esc_html__( 'Search for: %s', 'hanata' ), get_search_query() );
						elseif ( is_404() ) :
							esc_html_e( '404 Error', 'hanata' );
						elseif ( is_singular( 'knowledge' ) ) :
							esc_html_e( 'Knowledge Base', 'hanata' );
						elseif ( is_home() ) :
							esc_html_e( 'Posts', 'hanata' );
						else :
							echo get_the_title();
						endif;
						?>
					</h1>
				<?php endif; ?>
				<?php $enable_breadcrumb = isset($hanata_settings['breadcrumb']) ? $hanata_settings['breadcrumb'] : true ; ?>
				<?php if($enable_breadcrumb) : ?>
					<?php
						if(function_exists('is_woocommerce') && is_woocommerce()){
							if (class_exists("WCV_Vendors") && WCV_Vendors::is_vendor_page()){
								get_template_part( 'breadcrumb');
							}else{
								hanata_woocommerce_breadcrumb();
							}
						}else{
							get_template_part( 'breadcrumb');
						}		
					?>			
				<?php endif; ?>
			</div><!-- .container -->
			
		</div><!-- Page Title -->
	<?php } ?>
<?php }
if ( ! function_exists( 'hanata_single_posted_on' ) ) :

function hanata_single_posted_on() { 
	global $hanata_settings,$post; ?>
	<div class="entry-meta">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
			<span class="sticky-post"><?php echo esc_html__( 'Featured', 'hanata' ) ?></span>
		<?php } ?>	
		<?php if (hanata_get_config('archives-author')) { ?>
			<span class="entry-meta-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '30'); ?><?php the_author_posts_link(); ?></span>
		<?php } ?>
		<!-- Categories -->
		<?php $categories_list = get_the_category_list( __( ', ', 'hanata' ) );
		
		if ( $categories_list ) : ?>
			<span class="cat-links">
				<span><?php echo esc_html__('in', 'hanata'); ?></span>
				<?php					
				echo wp_kses_post( $categories_list );
				?>
			</span>
		<?php endif; ?>
		<!-- End if categories. -->
		<a class="comments-link" href="<?php echo esc_attr('#respond'); ?>">
			<?php 
			$comment_count =  wp_count_comments(get_the_ID())->total_comments;
			if($comment_count > 0) {
			?>
				<?php if($comment_count == 1){?>
					<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comment', 'hanata').'</span>'; ?>
				<?php }else{ ?>
					<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comments', 'hanata').'</span>'; ?>
				<?php } ?>
			<?php }else{ ?>
				<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comments', 'hanata').'</span>'; ?>
			<?php } ?>
		</a>
	</div>			
<?php }

endif;	

if ( ! function_exists( 'hanata_posted_on' ) ) :

function hanata_posted_on() { 
	global $hanata_settings,$post; ?>
		<div class="entry-meta">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
				<span class="sticky-post"><?php echo esc_html__( 'Featured', 'hanata' ) ?></span>
			<?php } ?>	
			<?php if (hanata_get_config('archives-author')) { ?>
				<span class="entry-meta-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '30'); ?><?php the_author_posts_link(); ?></span>
			<?php } ?>
			<span class="comments-link">
				<?php 
				$comment_count =  wp_count_comments(get_the_ID())->total_comments;
				if($comment_count > 0) {
				?>
					<?php if($comment_count == 1){?>
						<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comment', 'hanata').'</span>'; ?>
					<?php }else{ ?>
						<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comments', 'hanata').'</span>'; ?>
					<?php } ?>
				<?php }else{ ?>
					<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comments', 'hanata').'</span>'; ?>
				<?php } ?>
			</span>
		</div>			
<?php }

endif;

if ( ! function_exists( 'hanata_posted_on_2' ) ) :

function hanata_posted_on_2() { 
	global $hanata_settings,$post; ?>
		<div class="entry-meta">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
				<span class="sticky-post"><?php echo esc_html__( 'Featured', 'hanata' ) ?></span>
			<?php } ?>	
			<?php if (hanata_get_config('archives-author')) { ?>
				<span class="entry-meta-link"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '30'); ?><?php the_author_posts_link(); ?></span>
			<?php } ?>
		</div>	
<?php }

endif;

if ( ! function_exists( 'hanata_time_link' ) ) :
	function hanata_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s, %3$s, %4$s, %5$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s, %3$s, %4$s, %5$s</time><time class="updated" datetime="%6$s">%7$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date('l'),
			get_the_date('F j'),
			get_the_date('Y'),
			get_the_date('g:i a'),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);
		return sprintf(
			__( '<span class="screen-reader-text">' . esc_html__('Posted on','hanata'). '</span> %s', 'hanata' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;

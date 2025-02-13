<?php
/**
 * Template Name: Sale Product
 * Post Type: page
 *
 * @package hanata
 */

get_header();
?>

<div class="sale-page">
	<h1><?php the_title(); ?></h1>

	<div class="sale-products">
		<?php
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => - 1,
			'meta_query'     => array(
				array(
					'key'     => '_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'NUMERIC'
				)
			)
		);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ): ?>
			<ul class="products">
				<?php while ( $query->have_posts() ): $query->the_post();
					$product       = wc_get_product( get_the_ID() );
					$sale_price    = $product->get_sale_price();
					$regular_price = $product->get_regular_price();
					$sale_start    = get_field( 'sale_start', get_the_ID() );
					$sale_end      = get_field( 'sale_end', get_the_ID() );

					$days_left = null;
					if ( ! empty( $sale_end ) ) {
						$sale_end_date = DateTime::createFromFormat( 'd/m/Y', $sale_end );
						if ( $sale_end_date ) {
							$today     = new DateTime();
							$interval  = $today->diff( $sale_end_date );
							$days_left = ( $today > $sale_end_date ) ? 0 : $interval->days;
						}
					}
					?>
					<li class="product">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'medium' ); ?>

							<?php if ( ! empty( $sale_start ) ): ?>
								<span class="sale-start">
                                    <?php echo __( 'Начало', 'hanata' ) . ' ' . esc_html( $sale_start ); ?>
                                </span>
							<?php endif; ?>

							<?php if ( ! is_null( $days_left ) && $days_left > 0 ): ?>
								<div class="sale-circle">
									<span><?php echo $days_left; ?></span>
									<small><?php echo __( 'дн.', 'hanata' ); ?></small>
								</div>
							<?php endif; ?>

							<h2><?php the_title(); ?></h2>
						</a>

						<?php if ( $sale_price ): ?>
							<span class="price"><?php echo __( 'Акція:',
									'hanata' ); ?> <?php echo wc_price( $sale_price ); ?> (<?php echo __( 'Звичайна:',
									'hanata' ); ?><?php echo wc_price( $regular_price ); ?>)</span>
						<?php endif; ?>

						<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
						   class="sale-button"><?php echo __( 'Купити', 'hanata' ); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<p><?php echo __( 'Немає товарів зі знижкою', 'hanata' ); ?></p>
		<?php endif;
		wp_reset_postdata();
		?>
	</div>
</div>

<?php get_footer(); ?>

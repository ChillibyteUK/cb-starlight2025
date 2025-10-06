<?php
/**
 * Block template for CB Product Index.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="product-index has-white-background-color has-black-color">
	<div class="container py-5">
		<div class="row g-5">
		<?php
		$products_page = get_page_by_path( 'products', OBJECT, 'page' );
		if ( $products_page ) {
			$products = new WP_Query(
				array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'orderby'     => 'menu_order',
					'order'       => 'ASC',
					'post_parent' => $products_page->ID,
				)
			);
			if ( $products->have_posts() ) {
				while ( $products->have_posts() ) {
					$products->the_post();
					?>
					<div class="col-md-6 mb-4">
						<a href="<?php the_permalink(); ?>" class="product-index__card d-flex flex-column h-100">
							<?php
							if ( has_post_thumbnail() ) {
								?>
								<div class="product-index__image-wrapper">
									<?= get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'product-index__image' ) ); ?>
								</div>
								<?php
							}
							?>
							<div class="product-index__body d-flex flex-column flex-grow-1">
								<h3 class="h3 mb-4 card-title">
									<?= esc_html( get_the_title() ); ?>
								</h3>
								<div class="has-left-border">
									<p class="card-text">
										<?= wp_kses_post( get_field( 'product_card_text', get_the_ID() ) ); ?>
									</p>
									<span class="mt-auto align-self-start btn">Find out more</span>
								</div>
							</div>
						</a>
					</div>
					<?php
				}
				wp_reset_postdata();
			}
		}
		?>
		</div>
	</div>
</section>
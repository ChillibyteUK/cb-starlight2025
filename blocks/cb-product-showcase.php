<?php
/**
 * Block template for CB Product Showcase.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="showcase has-primary-900-background-color has-white-color py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-4" data-aos="fade-up">
				<h2 class="h2 mb-5"><?= wp_kses_post( get_field( 'title' ) ); ?></h2>
				<div class="has-left-border">
					<?= wp_kses_post( get_field( 'content' ) ); ?>
					<p class="mt-4"><a class="btn" href="/products/"
						target="_self">View Products</a>
					</p>
				</div>
			</div>
			<div class="col-md-8">
				<div class="row g-2">
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
								$card_image = get_field( 'product_card_image', get_the_ID() ) ? wp_get_attachment_image( get_field( 'product_card_image', get_the_ID() ), 'medium', false, array( 'class' => 'showcase__image' ) ) : get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'showcase__image' ) );
								?>
								<div class="col-sm-6 col-md-4 mb-4">
									<a href="<?php the_permalink(); ?>" class="showcase__card">
										<div class="showcase__image-wrapper">
											<?= wp_kses_post( $card_image ); ?>
										</div>
										<h3 class="mt-2 mb-0">
											<?= esc_html( get_the_title() ); ?>
										</h3>
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
		</div>
	</div>
</section>
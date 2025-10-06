<?php
/**
 * Block template for LC Related Products.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

$products_page = get_page_by_path( 'products', OBJECT, 'page' );

if ( $products_page ) {
	?>
<section class="related-products py-5 has-secondary-light-background-color has-black-color">
	<div class="container">
		<h2 class="h2 mb-5 text-center" data-aos="fade-up">Related Products</h2>
		
		<!-- Swiper -->
		<div class="swiper related-products-swiper">
			<div class="swiper-wrapper">
		<?php
		$products = new WP_Query(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'orderby'      => 'menu_order',
				'order'        => 'ASC',
				'post_parent'  => $products_page->ID,
				'post__not_in' => array( get_the_ID() ), // Exclude current product page.
			)
		);
		if ( $products->have_posts() ) {
			while ( $products->have_posts() ) {
				$products->the_post();
				$card_image = get_field( 'product_card_image', get_the_ID() ) ? wp_get_attachment_image( get_field( 'product_card_image', get_the_ID() ), 'medium', false, array( 'class' => 'related-products__image' ) ) : get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'related-products__image' ) );
				?>
			<div class="swiper-slide">
				<a href="<?php the_permalink(); ?>" class="related-products__card d-flex flex-column h-100">
					<?php
					if ( has_post_thumbnail() || $card_image ) {
						?>
						<div class="related-products__image-wrapper">
							<?= wp_kses_post( $card_image ); ?>
						</div>
						<?php
					}
					?>
					<div class="related-products__body d-flex flex-column flex-grow-1">
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
		?>
			</div>
		</div>
		<!-- End Swiper -->
		
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			new Swiper('.related-products-swiper', {
				slidesPerView: 1,
				spaceBetween: 30,
				autoplay: {
					delay: 3000,
					disableOnInteraction: false,
				},
				loop: true,
				breakpoints: {
					768: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					992: {
						slidesPerView: 3,
						spaceBetween: 30,
					}
				}
			});
		});
		</script>
	</div>
</section>
	<?php
}
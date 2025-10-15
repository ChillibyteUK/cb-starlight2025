<?php
/**
 * Block template for CB Product Hero.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="product-hero has-primary-900-background-color has-white-color">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 py-5 ps-md-5" data-aos="fade-right">
				<h1 class="h2 mb-4"><?= wp_kses_post( get_field( 'title' ) ); ?></h1>
				<div class="has-left-border">
					<?= wp_kses_post( get_field( 'content' ) ); ?>
					<?php
					$cta = get_field( 'link' );
					if ( $cta ) {
						?>
						<p class="mt-4">
							<a class="btn" href="<?= esc_url( $cta['url'] ); ?>"
								target="<?= esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
								<?= esc_html( $cta['title'] ); ?>
							</a>
						</p>
						<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-6 pe-md-0" data-aos="fade-left">
				<?php
				$images = get_field( 'images' );
				if ( $images ) {
					?>
					<div class="swiper product-hero__carousel">
						<div class="swiper-wrapper">
							<?php
							foreach ( $images as $image ) {
								?>
								<div class="swiper-slide">
									<?= wp_get_attachment_image( $image, 'full', false, array( 'class' => 'img-fluid' ) ); ?>
								</div>
								<?php
							}
							?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<?php
				} else {
					// Fallback to a single image if no images are set.
					$image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					if ( $image ) {
						echo '<img src="' . esc_url( $image ) . '" class="img-fluid" alt="' . esc_attr( get_the_title() ) . '">';
					}
				}
				?>
			</div>
		</div>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const swiper = new Swiper('.product-hero__carousel', {
			loop: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
		});
	});
</script>
		<?php
	},
	100
);
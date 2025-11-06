<?php
/**
 * Block template for CB Product Spec.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

// Generate a unique ID for this block instance.
$block_uid = 'product-spec' . uniqid();
?>
<section id="<?= esc_attr( $block_uid ); ?>" class="product-spec py-5" >
	<div class="container py-5">
		<div class="row g-5 align-items-start">
			<div class="col-md-6" data-aos="fade">
				<div class="text-center">
					<?= wp_get_attachment_image( get_field( 'image' ), 'full', false, array( 'class' => '' ) ); ?>
				</div>
			</div>
			<div class="col-md-6"  data-aos="fade">
				<!-- Bootstrap Accordion -->
				<div class="accordion" id="<?= esc_attr( $block_uid ); ?>-accordion">
					
					<?php if ( get_field( 'description' ) ) : ?>
					<!-- Description -->
					<div class="accordion-item">
						<h3 class="accordion-header">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?= esc_attr( $block_uid ); ?>-description" aria-expanded="true" aria-controls="<?= esc_attr( $block_uid ); ?>-description">
								Description
							</button>
						</h3>
						<div id="<?= esc_attr( $block_uid ); ?>-description" class="accordion-collapse collapse show" data-bs-parent="#<?= esc_attr( $block_uid ); ?>-accordion">
							<div class="accordion-body">
								<?= wp_kses_post( get_field( 'description' ) ); ?>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( get_field( 'available_sizes' ) ) : ?>
					<!-- Available Sizes -->
					<div class="accordion-item">
						<h3 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= esc_attr( $block_uid ); ?>-sizes" aria-expanded="false" aria-controls="<?= esc_attr( $block_uid ); ?>-sizes">
								Available Sizes
							</button>
						</h3>
						<div id="<?= esc_attr( $block_uid ); ?>-sizes" class="accordion-collapse collapse" data-bs-parent="#<?= esc_attr( $block_uid ); ?>-accordion">
							<div class="accordion-body">
								<?= wp_kses_post( get_field( 'available_sizes' ) ); ?>
								<?php

								$agallery = get_field( 'available_sizes_gallery' );
								if ( $agallery ) {
									?>
									<div class="row g-2">
										<?php
										$asc = 1;
										foreach ( $agallery as $image ) {
											?>
											<div class="col-md-3">
												<a href="<?= esc_url( wp_get_attachment_image_url( $image['ID'], 'full' ) ); ?>" 
												class="glightbox" 
												data-gallery="available-sizes-gallery-<?= esc_attr( $block_uid ); ?>"
												data-glightbox="description: .as_desc_<?= esc_attr( $asc ); ?>"
												data-type="image">
													<?= wp_get_attachment_image( $image['ID'], 'thumbnail', false, array( 'class' => 'img-fluid' ) ); ?>
												</a>
												<div class="glightbox-desc as_desc_<?= esc_attr( $asc ); ?>">
													<?php
													if ( $image['title'] ) {
														?>
													<h3 class="h3 mb-3"><?= esc_html( $image['title'] ); ?></h3>
														<?php
													}
													if ( $image['caption'] ) {
														?>
													<p class="mb-3"><?= esc_html( $image['caption'] ); ?></p>
														<?php
													}
													?>
													<a href="/contact/" class="btn">Request a Quote</a>
												</div>
											</div>
											<?php
											++$asc;
										}
										?>
									</div>
									<?php
								}


								$cta = get_field( 'cta' );
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
					</div>
					<?php endif; ?>

					<?php if ( get_field( 'gallery' ) ) : ?>
					<!-- Gallery -->
					<div class="accordion-item">
						<h3 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= esc_attr( $block_uid ); ?>-gallery" aria-expanded="false" aria-controls="<?= esc_attr( $block_uid ); ?>-gallery">
								Examples
							</button>
						</h3>
						<div id="<?= esc_attr( $block_uid ); ?>-gallery" class="accordion-collapse collapse" data-bs-parent="#<?= esc_attr( $block_uid ); ?>-accordion">
							<div class="accordion-body">
								<?php
								$gallery = get_field( 'gallery' );
								if ( $gallery ) {
									?>
									<div class="row g-2">
										<?php
										$gal = 1;
										foreach ( $agallery as $image ) {
											?>
											<div class="col-md-3">
												<a href="<?= esc_url( wp_get_attachment_image_url( $image['ID'], 'full' ) ); ?>" 
												class="glightbox" 
												data-gallery="available-sizes-gallery-<?= esc_attr( $block_uid ); ?>"
												data-glightbox="description: .gal_desc_<?= esc_attr( $gal ); ?>"
												data-type="image">
													<?= wp_get_attachment_image( $image['ID'], 'thumbnail', false, array( 'class' => 'img-fluid' ) ); ?>
												</a>
												<div class="glightbox-desc gal_desc_<?= esc_attr( $gal ); ?>">
													<?php
													if ( $image['title'] ) {
														?>
													<h3 class="h3 mb-3"><?= esc_html( $image['title'] ); ?></h3>
														<?php
													}
													if ( $image['caption'] ) {
														?>
													<p class="mb-3"><?= esc_html( $image['caption'] ); ?></p>
														<?php
													}
													?>
													<a href="/contact/" class="btn">Request a Quote</a>
												</div>
											</div>
											<?php
											++$asc;
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<?php endif; ?>

				</div>
				<!-- End Accordion -->
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
	document.addEventListener("DOMContentLoaded", function() {
		const lightbox = GLightbox({
			selector: '.glightbox'
		});
	});
</script>
		<?php
	},
	100
);
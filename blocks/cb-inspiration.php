<?php
/**
 * Block template for CB Inspiration.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="gallery">
	<div class="container py-5">
		<?php
		$images = get_field( 'images' );
		if ( $images ) {
			?>
		<div class="row" id="gallery_items">
			<?php
			$c = 1;
			foreach ( $images as $image ) {
				?>
				<div class="col-md-4 mb-4 gallery-item-wrapper">
					<a href="<?= esc_url( wp_get_attachment_image_url( $image['ID'], 'full' ) ); ?>" class="gallery__link image-16x9 glightbox" data-glightbox="description: .desc_<?= esc_attr( $c ); ?>;" data-gallery="work-gallery-all" data-type="image">
						<?= wp_get_attachment_image( $image['ID'], 'large', false, array( 'class' => 'gallery__image' ) ); ?>
					</a>
					<div class="glightbox-desc desc_<?= esc_attr( $c ); ?>">
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
				++$c;
			}
			?>
		</div>
			<?php
		}
		?>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
document.addEventListener('DOMContentLoaded', function() {
        const lightbox = GLightbox({});
});
</script>
		<?php
	}
);

get_footer();
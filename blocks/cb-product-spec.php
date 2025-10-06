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
		<div class="row g-5 align-items-center">
			<div class="col-md-6" data-aos="fade">
				<div class="text-center">
					<?= wp_get_attachment_image( get_field( 'image' ), 'full', false, array( 'class' => '' ) ); ?>
				</div>
			</div>

			<div class="col-md-6"  data-aos="fade">
				<h2 class="h2 mb-5"><?= wp_kses_post( get_field( 'title' ) ); ?></h2>
				<div class="has-left-border">
					<?= wp_kses_post( get_field( 'content' ) ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
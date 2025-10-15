<?php
/**
 * Block template for CB Doclist.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="doclist">
	<div class="container py-5">
		<?php
		if ( have_rows( 'documents' ) ) {
			?>
			<div class="row g-5">
				<?php
				while ( have_rows( 'documents' ) ) {
					the_row();
					$doc  = get_sub_field( 'file' );
					$icon = 'application/pdf' === $doc['mime_type'] ? 'fa-file-pdf' : 'fa-file';
					?>
					<div class="col-md-3">
						<a class="doclist__item d-flex flex-column h-100 has-black-color" href="<?= esc_url( $doc['url'] ); ?>" target="_blank" rel="noopener">
							<?php
							$attachment_id = $doc['id'];
							$thumb         = wp_get_attachment_image_src( $attachment_id, 'large' );
							if ( $thumb ) {
								?>
								<div class="doclist__image-wrapper">
									<img src="<?= esc_url( $thumb[0] ); ?>" class="doclist__image" alt="">
								</div>
								<?php
							}
							?>
							<div class="doclist__body d-flex flex-column flex-grow-1">
								<h3 class="h3 mb-4 card-title">
									<?= esc_html( get_sub_field( 'file_name' ) ? get_sub_field( 'file_name' ) : $doc['title'] ); ?>
								</h3>
								<div class="has-left-border">
									<?php
									if ( get_sub_field( 'file_description', get_the_ID() ) ) {
										?>
									<p class="card-text">
										<?= wp_kses_post( get_sub_field( 'file_description', get_the_ID() ) ); ?>
									</p>
										<?php
									}
									?>
									<span class="mt-auto align-self-start btn">Download</span>
								</div>
							</div>
						</a>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		} else {
			?>
			<p>No documents available.</p>
			<?php
		}
		?>
	</div>
</section>
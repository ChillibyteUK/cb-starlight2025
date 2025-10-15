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
			<div class="row g-4">
				<?php
				while ( have_rows( 'documents' ) ) {
					the_row();
					$doc  = get_sub_field( 'file' );
					var_dump($doc);
					$icon = 'application/pdf' === $doc['mime_type'] ? 'fa-file-pdf' : 'fa-file';
					?>
					<div class="col-md-4">
						<a class="doclist__item d-block p-3 h-100 has-left-border" href="<?= esc_url( $doc['url'] ); ?>" target="_blank" rel="noopener">
							<?php
							// display pdf thumbnail if pdf
							if ( 'application/pdf' === $doc['mime_type'] ) {
								$pdf_path = get_attached_file( $doc['id'] );
								$upload_dir = wp_upload_dir();
								$pdf_relative_path = str_replace( $upload_dir['basedir'], '', $pdf_path );
								$thumbnail_url = $upload_dir['baseurl'] . '/thumbnails' . $pdf_relative_path . '.png';
								if ( file_exists( $thumbnail_path ) ) {
									echo '<img src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( $doc['title'] ) . '" class="img-fluid mb-2">';
								}
							}
							?>
							<h3 class="h5 mb-2"><i class="fas <?= esc_attr( $icon ); ?>"></i> <?= esc_html( $doc['title'] ); ?></h3>
							<?php
							if ( get_sub_field( 'file_name' ) ) {
								?>
								<p class="mb-0"><?= esc_html( get_sub_field( 'file_name' ) ); ?></p>
								<?php
							}
							if ( get_sub_field( 'file_description' ) ) {
								?>
								<p class="mb-0"><?= esc_html( get_sub_field( 'file_description' ) ); ?></p>
								<?php
							}
							?>
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
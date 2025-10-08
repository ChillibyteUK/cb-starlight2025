<?php
/**
 * Block template for CB Contact.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="contact">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-6">
				<h2>Contact Us</h2>
				<p>We'd love to hear about your event. Contact us via email or phone, or use our contact form.</p>
				<ul class="fa-ul">
					<li><span class="fa-li"><i class="fas fa-envelope"></i></span> <?= do_shortcode( '[contact_email]' ); ?></li>
					<li><span class="fa-li"><i class="fas fa-phone"></i></span> <?= do_shortcode( '[contact_phone]' ); ?></li>
				</ul>
			</div>
			<div class="col-md-6">
				<?php
				if ( get_field( 'cf7_form_id' ) ) {
					$cfid = get_field( 'cf7_form_id' );
					?>
					<?= do_shortcode( '[contact-form-7 id="' . esc_attr( $cfid ) . '" title="Contact form 1"]' ); ?>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</section>
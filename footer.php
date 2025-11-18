<?php
/**
 * Footer template for the Starlight 2025 theme.
 *
 * This file contains the footer section of the theme, including navigation menus,
 * office addresses, and colophon information.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="footer-top"></div>

<footer class="footer py-4">
    <div class="container">
        <div class="row pb-4 g-3">
			<div class="col-12 col-md-8 col-xl-4 order-1 order-md-4 order-xl-1">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/starlight--wo.svg' ); ?>" alt="Starlight Exhibitions Logo" class="w-50 mb-4 d-block" width="254" height="57">
            </div>
            <div class="col-12 col-md-4 col-xl-2 order-2 order-md-1 order-xl-2">
				<div class="footer-title">Starlight</div>
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu1',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-12 col-md-4 col-xl-2 order-3 order-md-2 order-xl-3">
				<div class="footer-title">Services</div>
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu2',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-12 col-md-4 col-xl-2 order-4 order-md-3 order-xl-4">
				<div class="footer-title">Products</div>
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu3',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-12 col-md-4 col-xl-2 order-5 order-md-5 order-xl-5 footer__contact">
                <div class="footer-title">Get in touch</div>
				<ul class="list-unstyled">
					<li><?= do_shortcode( '[contact_email]' ); ?></li>
					<li><?= do_shortcode( '[contact_phone]' ); ?></li>
					<li><?= do_shortcode( '[contact_address]' ); ?></li>
				</ul>
				<div class="d-flex flex-wrap align-items-center social-icons gap-3">
					<span>Connect:</span>
					<?= do_shortcode( '[social_icons class="d-flex justify-content-center gap-3 fs-h3"]' ); ?>
				</div>
            </div>
        </div>

        <div class="colophon d-flex justify-content-between align-items-center flex-wrap">
            <div>
                &copy; <?= esc_html( gmdate( 'Y' ) ); ?> Starlight Exhibitions Limited. Registered in England, no. 99999999
            </div>
            <div>
				<a href="/privacy-policy/">Privacy</a> & <a href="/cookie-policy/">Cookies</a> |
                <a href="https://www.chillibyte.co.uk/" class="cb" rel="nofollow noopener" target="_blank" title="Digital Marketing by Chillibyte"></a>
            </div>
        </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
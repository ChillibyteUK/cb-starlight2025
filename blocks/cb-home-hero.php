<?php
/**
 * Template for CB Home Hero.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

$bg    = get_field( 'background_image' );
$words = get_field( 'words' );

$words_array = array_filter( array_map( 'trim', explode( "\n", $words ) ) );

?>
<section class="home-hero" style="background-image: url(<?= esc_url( wp_get_attachment_image_url( $bg, 'large', false ) ); ?>)">
    <div class="container pt-5">
		<div class="row pt-5">
			<div class="col-md-6">
				<h1>
					<?= wp_kses_post( get_field( 'title' ) ); ?><br>
					<span id="animated-word" data-words='<?= esc_attr( wp_json_encode( $words_array ) ); ?>'></span>
				</h1>
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
    const el = document.getElementById("animated-word");
    const words = JSON.parse(el.getAttribute("data-words"));
    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 60;
    let pauseTime = 1000;
    let deleteSpeed = 10;

    function type() {
        const currentWord = words[wordIndex];
        if (isDeleting) {
            charIndex--;
            el.textContent = currentWord.substring(0, charIndex);
        } else {
            charIndex++;
            el.textContent = currentWord.substring(0, charIndex);
        }

        if (!isDeleting && charIndex === currentWord.length) {
            setTimeout(() => { isDeleting = true; type(); }, pauseTime);
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            wordIndex = (wordIndex + 1) % words.length;
            setTimeout(type, 400);
        } else {
            setTimeout(type, isDeleting ? deleteSpeed : typingSpeed);
        }
    }
    type();
    </script>
		<?php
	},
	100
);
<?php
/**
 * Block template for CB Gallery Pushthrough.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

$bg = get_field( 'background' ) ? get_field( 'background' ) : 'white';
?>
<section class="gallery-pushthrough has-black-color has-<?= esc_attr( $bg ); ?>-background-color">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-4" data-aos="fade-up">
				<h2 class="h2 mb-5"><?= wp_kses_post( get_field( 'title' ) ); ?></h2>
				<div class="has-left-border">
					<?= wp_kses_post( get_field( 'content' ) ); ?>
					<?php
					if ( get_field( 'cta' ) ) {
						$cta = get_field( 'cta' );
						?>
						<p class="mt-4"><a class="btn" href="<?= esc_url( $cta['url'] ); ?>"
							target="<?= esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>"><?= esc_html( $cta['title'] ); ?></a>
						</p>
						<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-8" data-aos="fade-left">
				<?php
				$q = new WP_Query(
					array(
						'post_type'      => 'case_study',
						'posts_per_page' => 4,
						'order'          => 'DESC',
						'orderby'        => 'date',
					)
				);
				if ( $q->have_posts() ) {
					?>
				<div class="gallery-grid">
					<?php
					while ( $q->have_posts() ) {
						$q->the_post();
						?>
						<div class="gallery-item">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'large' ); ?>
							</a>
						</div>
						<?php
					}
					wp_reset_postdata();
					?>
				</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
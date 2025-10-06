<?php
/**
 * Block template for CB Latest Posts.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="latest-posts">
	<div class="container py-5">
		<h2 class="h2 text-center">News Room</h2>
		<?php
		$q = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 4,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);
		if ( $q->have_posts() ) {
			?>
			<div class="row g-3 mt-3">
				<?php
				$d = 0;
				while ( $q->have_posts() ) {
					$q->the_post();
					?>
					<div class="col-md-6 col-lg-3" data-aos="fade" data-aos-delay="<?= esc_attr( $d ); ?>">
						<a href="<?php the_permalink(); ?>" class="latest-posts__card d-flex flex-column h-100">
							<?php
							if ( has_post_thumbnail() ) {
								?>
								<div class="latest-posts__image-wrapper">
									<?= get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'latest-posts__image' ) ); ?>
								</div>
								<?php
							}
							?>
							<div class="latest-posts__body d-flex flex-column flex-grow-1">
								<h3 class="h5 card-title">
									<?= esc_html( get_the_title() ); ?>
								</h3>
								<p class="card-text">
									<?= wp_kses_post( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?>
								</p>
								<span class="mt-auto"><i class="fas fa-plus"></i></span>
							</div>
						</a>
					</div>
					<?php
					$d += 100;
				}
				wp_reset_postdata();
				?>
			</div>
			<?php
		}
		?>
	</div>
</section>
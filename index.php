<?php
/**
 * Template for displaying the blog index page.
 *
 * @package cb-starlight2025
 */

defined( 'ABSPATH' ) || exit;

$page_for_posts = get_option( 'page_for_posts' );

get_header();
?>
<main id="main">
	<section class="product-hero has-primary-900-background-color has-white-color">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 py-5 ps-md-5" data-aos="fade-right">
					<h1 class="h2 mb-4">News &amp; Insights</h1>
					<div class="has-left-border">
						<p class="subtitle">Expert advice, industry updates, and company news.</p>
						<a href="/contact/" class="btn mb-4">Contact Us</a>
					</div>
				</div>
				<div class="col-md-6 pe-md-0" data-aos="fade-left">
					<?php
					wp_get_attachment_image(
						get_post_thumbnail_id( $page_for_posts ),
						'full',
						false,
						array(
							'class' => 'page-hero__image',
						)
					);
					?>
				</div>
			</div>
		</div>
	</section>
    <section class="latest_posts mt-5">
        <div class="container pb-5">
            <?php
			/*
            // Get all categories for filter buttons.
            $all_categories = get_categories(
				array(
					'hide_empty' => true,
					'orderby'    => 'name',
					'order'      => 'ASC',
				)
			);

            if ( ! empty( $all_categories ) ) {
                ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="filter-buttons text-center">
                            <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
                            <?php
							foreach ( $all_categories as $category ) {
								?>
                                <button class="btn btn-outline-primary filter-btn" data-filter="<?= esc_attr( $category->slug ); ?>"><?= esc_html( $category->name ); ?></button>
                            	<?php
							}
							?>
                        </div>
                    </div>
                </div>
                <?php
            }
				*/
            ?>
            <div class="row g-4 w-100">
            <?php
            // Custom query to include both published and scheduled posts.
            $args = array(
                'post_type'      => 'post',
                'post_status'    => array( 'publish', 'future' ), // Include published and scheduled posts.
                'orderby'        => 'date',
                'order'          => 'DESC', // Descending order.
                'posts_per_page' => -1,    // Get all posts.
            );

            $q = new WP_Query( $args );

            if ( $q->have_posts() ) {
				$d = 0;
				while ( $q->have_posts() ) {
					$q->the_post();
					// get categories.
					$categories = get_the_category();
					if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
						// get space separated list of category slugs.
						$first_category = $categories[0];
						// If there are multiple categories, use the first one.
						if ( count( $categories ) > 1 ) {
							// Get the first category slug.
							$categories = array_slice( $categories, 0, 1 );
						}
						// Convert to space separated list.
						$categories = implode( ' ', wp_list_pluck( $categories, 'slug' ) );
					}
					?>

					<div class="col-md-6 col-lg-4 mb-4" data-aos="fade" data-category="<?= esc_attr( $categories ); ?>">
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
								<h3 class="h5 card-title mb-3">
									<?= esc_html( get_the_title() ); ?>
								</h3>
								<div class="latest-insights__meta">
									<span><i class="fa-regular fa-calendar"></i> <?= esc_html( get_the_date( 'jS F Y' ) ); ?></span>
									<span><i class="fa-regular fa-clock"></i> <?= wp_kses_post( estimate_reading_time_in_minutes( get_the_content() ) ); ?> minute read</span>
								</div>
								<p class="card-text">
									<?= wp_kses_post( wp_trim_words( get_clean_excerpt(), 15, '...' ) ); ?>
								</p>
								<span class="mt-auto"><i class="fas fa-plus"></i></span>
							</div>
						</a>
					</div>
					<?php
					$d += 100;
                }
            } else {
                echo '<p>No posts found.</p>';
            }

            // Reset post data.
            wp_reset_postdata();
            ?>
            </div>
        </div>
    </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const posts = document.querySelectorAll('[data-category]');

    // Add post-item class to all posts
    posts.forEach(post => {
        post.classList.add('post-item');
    });

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter posts
            posts.forEach(post => {
                const postCategories = post.getAttribute('data-category');
                const shouldShow = filterValue === 'all' || (postCategories && postCategories.includes(filterValue));
                
                if (shouldShow) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php

get_footer();
?>
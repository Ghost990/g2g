<?php
/**
 * Testimonial Slider Block - Server-side render
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$posts_per_page  = isset( $attributes['postsPerPage'] ) ? absint( $attributes['postsPerPage'] ) : 5;
$autoplay        = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : true;
$autoplay_speed  = isset( $attributes['autoplaySpeed'] ) ? absint( $attributes['autoplaySpeed'] ) : 5000;
$show_dots       = isset( $attributes['showDots'] ) ? $attributes['showDots'] : true;

// Get testimonials
$args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
);

$testimonials = new WP_Query( $args );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'              => 'g2f-testimonial-slider',
		'data-autoplay'      => $autoplay ? 'true' : 'false',
		'data-autoplay-speed'=> $autoplay_speed,
	)
);
?>

<div <?php echo $wrapper_attributes; ?>>

	<?php if ( $testimonials->have_posts() ) : ?>
		<div class="g2f-testimonial-track">
			<?php $index = 0; ?>
			<?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
				<?php
				$quote   = get_post_meta( get_the_ID(), '_g2f_testimonial_quote', true ) ?: get_the_title();
				$name    = get_post_meta( get_the_ID(), '_g2f_testimonial_name', true );
				$role    = get_post_meta( get_the_ID(), '_g2f_testimonial_role', true );
				$company = get_post_meta( get_the_ID(), '_g2f_testimonial_company', true );
				?>
				<div class="g2f-testimonial" data-index="<?php echo esc_attr( $index ); ?>" style="<?php echo $index > 0 ? 'display: none;' : ''; ?>">

					<h3 class="g2f-testimonial-quote">"<?php echo esc_html( $quote ); ?>"</h3>

					<div class="g2f-testimonial-text">
						<?php the_content(); ?>
					</div>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="g2f-testimonial-avatar-wrapper">
							<?php the_post_thumbnail( 'g2f-avatar', array( 'class' => 'g2f-testimonial-avatar' ) ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $name ) : ?>
						<p class="g2f-testimonial-name"><?php echo esc_html( $name ); ?></p>
					<?php endif; ?>

					<?php if ( $role || $company ) : ?>
						<p class="g2f-testimonial-role">
							<?php
							$role_parts = array();
							if ( $role ) $role_parts[] = $role;
							if ( $company ) $role_parts[] = $company;
							echo esc_html( implode( ' at ', $role_parts ) );
							?>
						</p>
					<?php endif; ?>

				</div>
				<?php $index++; ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<?php if ( $show_dots && $testimonials->post_count > 1 ) : ?>
			<div class="g2f-testimonial-dots" role="tablist">
				<?php for ( $i = 0; $i < $testimonials->post_count; $i++ ) : ?>
					<button
						class="g2f-testimonial-dot <?php echo $i === 0 ? 'active' : ''; ?>"
						data-slide="<?php echo esc_attr( $i ); ?>"
						role="tab"
						aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
						aria-label="<?php printf( esc_attr__( 'Go to slide %d', 'g2f-functionality' ), $i + 1 ); ?>"
					></button>
				<?php endfor; ?>
			</div>
		<?php endif; ?>

	<?php else : ?>
		<p class="g2f-no-testimonials"><?php esc_html_e( 'No testimonials found.', 'g2f-functionality' ); ?></p>
	<?php endif; ?>

</div>

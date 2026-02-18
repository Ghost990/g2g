<?php
/**
 * Client Marquee Block - Server-side render
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$posts_per_page = isset( $attributes['postsPerPage'] ) ? absint( $attributes['postsPerPage'] ) : 20;
$speed          = isset( $attributes['speed'] ) ? absint( $attributes['speed'] ) : 30;
$pause_on_hover = isset( $attributes['pauseOnHover'] ) ? $attributes['pauseOnHover'] : true;
$direction      = isset( $attributes['direction'] ) ? $attributes['direction'] : 'left';

// Get clients
$args = array(
	'post_type'      => 'client',
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
);

$clients = new WP_Query( $args );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'            => 'g2f-clients-marquee' . ( $pause_on_hover ? ' pause-on-hover' : '' ),
		'data-speed'       => $speed,
		'data-direction'   => $direction,
	)
);
?>

<div <?php echo $wrapper_attributes; ?>>

	<?php if ( $clients->have_posts() ) : ?>
		<div class="g2f-clients-track" style="animation-duration: <?php echo esc_attr( $speed ); ?>s; animation-direction: <?php echo $direction === 'right' ? 'reverse' : 'normal'; ?>;">
			<?php while ( $clients->have_posts() ) : $clients->the_post(); ?>
				<?php
				$client_url = get_post_meta( get_the_ID(), '_g2f_client_url', true );
				$has_link   = ! empty( $client_url );
				?>
				<div class="g2f-client-item">
					<?php if ( $has_link ) : ?>
						<a href="<?php echo esc_url( $client_url ); ?>" target="_blank" rel="noopener noreferrer" title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'g2f-client-logo', array( 'class' => 'g2f-client-logo', 'alt' => get_the_title() ) ); ?>
					<?php else : ?>
						<span class="g2f-client-name"><?php the_title(); ?></span>
					<?php endif; ?>

					<?php if ( $has_link ) : ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>

			<?php
			// Duplicate logos for seamless loop
			wp_reset_postdata();
			$clients->rewind_posts();
			while ( $clients->have_posts() ) : $clients->the_post();
				$client_url = get_post_meta( get_the_ID(), '_g2f_client_url', true );
				$has_link   = ! empty( $client_url );
			?>
				<div class="g2f-client-item" aria-hidden="true">
					<?php if ( $has_link ) : ?>
						<a href="<?php echo esc_url( $client_url ); ?>" target="_blank" rel="noopener noreferrer" tabindex="-1">
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'g2f-client-logo', array( 'class' => 'g2f-client-logo', 'alt' => '' ) ); ?>
					<?php else : ?>
						<span class="g2f-client-name"><?php the_title(); ?></span>
					<?php endif; ?>

					<?php if ( $has_link ) : ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

	<?php else : ?>
		<p class="g2f-no-clients"><?php esc_html_e( 'No clients found.', 'g2f-functionality' ); ?></p>
	<?php endif; ?>

</div>

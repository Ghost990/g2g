<?php
/**
 * Project Grid Block - Server-side render
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$columns        = isset( $attributes['columns'] ) ? absint( $attributes['columns'] ) : 3;
$posts_per_page = isset( $attributes['postsPerPage'] ) ? absint( $attributes['postsPerPage'] ) : 6;
$show_filters   = isset( $attributes['showFilters'] ) ? $attributes['showFilters'] : true;
$show_button    = isset( $attributes['showButton'] ) ? $attributes['showButton'] : true;
$button_text    = isset( $attributes['buttonText'] ) ? $attributes['buttonText'] : __( 'SEE MORE WORK', 'g2f-functionality' );
$button_link    = isset( $attributes['buttonLink'] ) ? $attributes['buttonLink'] : '#';

// Get project categories
$categories = get_terms(
	array(
		'taxonomy'   => 'project_category',
		'hide_empty' => true,
	)
);

// Get projects
$args = array(
	'post_type'      => 'project',
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
);

$projects = new WP_Query( $args );

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'g2f-project-grid-block',
	)
);
?>

<div <?php echo $wrapper_attributes; ?>>

	<?php if ( $show_filters && ! empty( $categories ) ) : ?>
		<div class="g2f-project-tabs" role="tablist">
			<button class="g2f-project-tab active" data-category="all" role="tab" aria-selected="true">
				<span><?php esc_html_e( 'All', 'g2f-functionality' ); ?></span>
			</button>
			<?php foreach ( $categories as $category ) : ?>
				<button class="g2f-project-tab" data-category="<?php echo esc_attr( $category->slug ); ?>" role="tab" aria-selected="false">
					<span><?php echo esc_html( $category->name ); ?></span>
				</button>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="g2f-project-grid" style="--columns: <?php echo esc_attr( $columns ); ?>;">
		<?php if ( $projects->have_posts() ) : ?>
			<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
				<?php
				$terms     = wp_get_post_terms( get_the_ID(), 'project_category', array( 'fields' => 'slugs' ) );
				$category  = ! empty( $terms ) ? $terms[0] : '';
				$term_names = wp_get_post_terms( get_the_ID(), 'project_category', array( 'fields' => 'names' ) );
				$category_name = ! empty( $term_names ) ? $term_names[0] : '';
				?>
				<article class="g2f-project-card" data-category="<?php echo esc_attr( $category ); ?>">
					<a href="<?php the_permalink(); ?>" class="g2f-project-link">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="g2f-project-image-wrapper">
								<?php the_post_thumbnail( 'g2f-project', array( 'class' => 'g2f-project-image' ) ); ?>
								<div class="g2f-project-overlay">
									<span class="g2f-project-view"><?php esc_html_e( 'View Project', 'g2f-functionality' ); ?></span>
								</div>
							</div>
						<?php endif; ?>
						<div class="g2f-project-info">
							<h5 class="g2f-project-title"><?php the_title(); ?></h5>
							<?php if ( $category_name ) : ?>
								<p class="g2f-project-category"><?php echo esc_html( $category_name ); ?></p>
							<?php endif; ?>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p class="g2f-no-projects"><?php esc_html_e( 'No projects found.', 'g2f-functionality' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( $show_button ) : ?>
		<div class="g2f-project-grid-footer">
			<a href="<?php echo esc_url( $button_link ); ?>" class="g2f-button-arrow">
				<span><?php echo esc_html( $button_text ); ?></span>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.125 10H16.875" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>
		</div>
	<?php endif; ?>

</div>

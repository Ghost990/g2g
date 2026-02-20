<?php
/**
 * Title: Service Projects Grid
 * Slug: g2f-theme/service-projects-grid
 * Categories: g2f-theme
 * Keywords: projects, grid, service, portfolio, filtered
 * Description: Projects grid filtered by current page's service taxonomy (ux-design, art-direction, photography).
 */

// Map page slug to project_service taxonomy term slug
$slug_map = array(
	'ux-design'       => 'ux-design',
	'art-direction'   => 'art-direction',
	'photography'     => 'photography',
);

$page_slug    = get_post_field( 'post_name', get_queried_object_id() );
$service_slug = $slug_map[ $page_slug ] ?? null;

$query_args = array(
	'post_type'      => 'project',
	'posts_per_page' => 6,
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
);

if ( $service_slug ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'project_service',
			'field'    => 'slug',
			'terms'    => $service_slug,
		),
	);
}

$projects = new WP_Query( $query_args );
?>

<!-- wp:group {"tagName":"section","className":"g2f-projects-section","style":{"spacing":{"padding":{"top":"80px","bottom":"80px","left":"80px","right":"80px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<section class="wp-block-group g2f-projects-section" style="padding-top:80px;padding-bottom:80px;padding-left:80px;padding-right:80px;margin-top:0;margin-bottom:0">

	<!-- Header -->
	<div class="g2f-section-header">
		<h2 class="g2f-section-title">Explore <em>Our Latest Projects.</em></h2>
	</div>

	<?php if ( $projects->have_posts() ) : ?>

	<div class="g2f-projects-grid">
		<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
		<article class="g2f-project-card">
			<a href="<?php the_permalink(); ?>" class="g2f-project-card__link">
				<?php if ( has_post_thumbnail() ) : ?>
				<figure class="g2f-project-card__image">
					<?php the_post_thumbnail( 'g2f-project', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) ); ?>
				</figure>
				<?php endif; ?>
				<div class="g2f-project-card__info">
					<h3 class="g2f-project-card__title"><?php the_title(); ?></h3>
					<?php
					$cats = get_the_terms( get_the_ID(), 'project_category' );
					if ( $cats && ! is_wp_error( $cats ) ) :
					?>
					<span class="g2f-project-card__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
					<?php endif; ?>
				</div>
			</a>
		</article>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>

	<?php if ( $projects->max_num_pages > 1 ) : ?>
	<div class="g2f-load-more-wrap">
		<button class="g2f-load-more g2f-btn"><?php esc_html_e( 'Load More', 'g2f-theme' ); ?></button>
	</div>
	<?php endif; ?>

	<?php else : ?>
	<p class="g2f-no-projects"><?php esc_html_e( 'No projects found.', 'g2f-theme' ); ?></p>
	<?php endif; ?>

</section>
<!-- /wp:group -->

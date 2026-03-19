<?php
/**
 * Title: Service Projects Grid
 * Slug: g2f-theme/service-projects-grid
 * Categories: g2f-theme
 * Keywords: projects, grid, service, portfolio, filtered
 * Description: Projects grid filtered by current page's service taxonomy.
 */

$slug_map = array(
	'ux-design'     => 'ux-design',
	'art-direction' => 'art-direction',
	'photography'   => 'photography',
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
<section class="g2f-svc-projects">
	<div class="g2f-svc-projects__inner">
		<div class="g2f-svc-projects__header">
			<h2 class="g2f-svc-projects__title">Explore <em>Our Latest Projects.</em></h2>
		</div>

		<?php if ( $projects->have_posts() ) : ?>
		<div class="g2f-svc-projects__grid">
			<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
			<article class="g2f-svc-card">
				<a href="<?php the_permalink(); ?>" class="g2f-svc-card__link">
					<figure class="g2f-svc-card__image">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) ); ?>
						<?php else : ?>
							<div class="g2f-svc-card__placeholder"><?php the_title(); ?></div>
						<?php endif; ?>
					</figure>
					<div class="g2f-svc-card__info">
						<h3 class="g2f-svc-card__title"><?php the_title(); ?></h3>
						<?php
						$cats = get_the_terms( get_the_ID(), 'project_category' );
						if ( $cats && ! is_wp_error( $cats ) ) :
						?>
						<span class="g2f-svc-card__cat"><?php echo esc_html( $cats[0]->name ); ?></span>
						<?php endif; ?>
					</div>
				</a>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div class="g2f-svc-projects__more">
			<a href="/gallery/" class="g2f-see-more-btn">SEE MORE WORK →</a>
		</div>
		<?php else : ?>
		<p class="g2f-no-projects">No projects found.</p>
		<?php endif; ?>
	</div>
</section>

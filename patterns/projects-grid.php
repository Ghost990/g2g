<?php
/**
 * Title: Projects Grid
 * Slug: g2f-theme/projects-grid
 * Categories: g2f-theme
 * Keywords: projects, portfolio, gallery, grid
 * Description: Filterable projects grid — WP post type "project"
 */

$args = array(
	'post_type'      => 'project',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$query = new WP_Query( $args );

// Build category map for tabs
$all_cats = array();
$projects  = array();

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$pid   = get_the_ID();
		$terms = get_the_terms( $pid, 'project_service' );
		$cat   = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->slug : 'other';
		$label = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : 'Other';

		if ( ! isset( $all_cats[ $cat ] ) ) {
			$all_cats[ $cat ] = $label;
		}

		$projects[] = array(
			'id'    => $pid,
			'title' => get_the_title(),
			'cat'   => $cat,
			'type'  => $label,
			'thumb' => get_the_post_thumbnail_url( $pid, 'large' ),
			'url'   => get_permalink(),
		);
	}
	wp_reset_postdata();
}

// Tabs HTML
$tabs_html = '<div class="g2f-projects-tabs">';
$tabs_html .= '<button class="g2f-tab active" data-filter="all">All</button>';
foreach ( $all_cats as $slug => $name ) {
	$tabs_html .= '<button class="g2f-tab" data-filter="' . esc_attr( $slug ) . '">' . esc_html( $name ) . '</button>';
}
$tabs_html .= '</div>';

// Cards HTML
$cards_html = '<div class="g2f-projects-grid">';
foreach ( $projects as $p ) {
	$cards_html .= '<div class="g2f-project-card" data-category="' . esc_attr( $p['cat'] ) . '">';
	$cards_html .= '<a href="' . esc_url( $p['url'] ) . '" class="g2f-project-card__link">';
	$cards_html .= '<div class="g2f-project-card__image">';
	if ( $p['thumb'] ) {
		$cards_html .= '<img src="' . esc_url( $p['thumb'] ) . '" alt="' . esc_attr( $p['title'] ) . '" loading="lazy" />';
	} else {
		$cards_html .= '<div class="g2f-project-image-placeholder"><span>' . esc_html( $p['title'] ) . '</span></div>';
	}
	$cards_html .= '<div class="g2f-project-card__overlay"><span class="g2f-explore-link">Explore →</span></div>';
	$cards_html .= '</div>';
	$cards_html .= '<div class="g2f-project-info">';
	$cards_html .= '<h5>' . esc_html( $p['title'] ) . '</h5>';
	$cards_html .= '<p>' . esc_html( $p['type'] ) . '</p>';
	$cards_html .= '</div>';
	$cards_html .= '</a>';
	$cards_html .= '</div>';
}
$cards_html .= '</div>';
?>

<section id="gallery" class="g2f-projects-grid-section">

	<h2 class="g2f-projects-heading"><strong>Explore</strong> Our Latest Projects.</h2>

	<?php echo $tabs_html; ?>
	<?php echo $cards_html; ?>

	<div class="g2f-see-more-wrap">
		<a href="/gallery/" class="g2f-btn-arrow">SEE MORE WORK →</a>
	</div>

</section>

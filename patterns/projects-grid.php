<?php
/**
 * Title: Projects Grid
 * Slug: g2f-theme/projects-grid
 * Categories: g2f-theme
 * Keywords: projects, portfolio, gallery, grid
 * Description: Filterable projects grid with tabs
 */

// Project data array - edit this to add/modify projects
$base_url = get_site_url() . '/wp-content/uploads/2026/03';
$projects = array(
	array(
		'title'    => 'AsicMinerz',
		'category' => 'ux-ui',
		'type'     => 'Website - UX/UI',
		'image'    => $base_url . '/project-1.jpg',
	),
	array(
		'title'    => 'Aeroprodukt',
		'category' => 'art-direction',
		'type'     => 'Visual identity - Branding',
		'image'    => $base_url . '/project-2.jpg',
	),
	array(
		'title'    => 'Medtrend',
		'category' => 'art-direction',
		'type'     => 'Brochure - Graphic Design',
		'image'    => $base_url . '/project-3.jpg',
	),
	array(
		'title'    => 'Ipari Marketing',
		'category' => 'ux-ui',
		'type'     => 'Website - UX/UI',
		'image'    => $base_url . '/project-4.jpg',
	),
	array(
		'title'    => 'Captured in Tones',
		'category' => 'photography',
		'type'     => 'Photography',
		'image'    => $base_url . '/project-5.jpg',
	),
	array(
		'title'    => 'Brand Identity',
		'category' => 'art-direction',
		'type'     => 'Photography - Editorial',
		'image'    => $base_url . '/project-6.jpg',
	),
);

// Build tabs HTML
$tabs_html = '<div class="g2f-project-tabs">';
$tabs_html .= '<div class="g2f-project-tab active" data-category="all"><p>All</p></div>';
$tabs_html .= '<div class="g2f-project-tab" data-category="ux-ui"><p>UX/UI</p></div>';
$tabs_html .= '<div class="g2f-project-tab" data-category="art-direction"><p>Art Direction</p></div>';
$tabs_html .= '<div class="g2f-project-tab" data-category="photography"><p>Photography</p></div>';
$tabs_html .= '</div>';

// Build project cards HTML
$cards_html = '<div class="g2f-project-grid">';
foreach ( $projects as $project ) {
	$cards_html .= '<div class="g2f-project-card" data-category="' . esc_attr( $project['category'] ) . '">';

	if ( ! empty( $project['image'] ) ) {
		$cards_html .= '<figure class="g2f-project-image">';
		$cards_html .= '<img src="' . esc_url( $project['image'] ) . '" alt="' . esc_attr( $project['title'] ) . '" onerror="this.parentElement.classList.add(\'g2f-img-missing\'); this.remove();">';
		$cards_html .= '<div class="g2f-project-placeholder-label">' . esc_html( $project['title'] ) . '</div>';
		$cards_html .= '</figure>';
	} else {
		$cards_html .= '<div class="g2f-project-image-placeholder"><span>' . esc_html( $project['title'] ) . '</span></div>';
	}

	$cards_html .= '<div class="g2f-project-info">';
	$cards_html .= '<h5>' . esc_html( $project['title'] ) . '</h5>';
	$cards_html .= '<p>' . esc_html( $project['type'] ) . '</p>';
	$cards_html .= '</div>';
	$cards_html .= '</div>';
}
$cards_html .= '</div>';
?>

<!-- wp:group {"tagName":"section","anchor":"gallery","className":"g2f-projects-grid-section","style":{"spacing":{"padding":{"top":"100px","bottom":"100px","left":"151px","right":"151px"}}},"backgroundColor":"white","layout":{"type":"default"}} -->
<section id="gallery" class="wp-block-group g2f-projects-grid-section has-white-background-color has-background" style="padding-top:100px;padding-bottom:100px;padding-left:151px;padding-right:151px">

	<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"60px","fontStyle":"normal","fontWeight":"400","lineHeight":"1.1"},"spacing":{"margin":{"bottom":"48px"}}},"fontFamily":"inter"} -->
	<h2 class="wp-block-heading has-text-align-center has-inter-font-family" style="margin-bottom:48px;font-size:60px;font-style:normal;font-weight:400;line-height:1.1"><strong>Explore</strong> Our Latest Projects.</h2>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<?php echo $tabs_html; ?>
	<!-- /wp:html -->

	<!-- wp:html -->
	<?php echo $cards_html; ?>
	<!-- /wp:html -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"48px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
	<div class="wp-block-group" style="margin-top:48px">

		<!-- wp:group {"style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"24px","right":"24px"}}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:8px;padding-right:24px;padding-bottom:8px;padding-left:24px">

			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"fontSize":"medium","fontFamily":"inter"} -->
			<p class="has-inter-font-family has-medium-font-size" style="font-style:normal;font-weight:600;line-height:1.2"><a href="#">SEE MORE WORK</a></p>
			<!-- /wp:paragraph -->

			<!-- wp:outermost/icon-block {"iconName":"g2f-arrows/arrow-right-black","width":"20px","height":"20px"} -->
			<div class="wp-block-outermost-icon-block"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
			<!-- /wp:outermost/icon-block -->

		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->

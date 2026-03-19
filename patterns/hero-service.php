<?php
/**
 * Title: Service Hero
 * Slug: g2f-theme/hero-service
 * Categories: g2f-theme
 * Description: Reusable hero for service sub-pages — full-width cover image + overlay + centered text.
 */

// Config per page slug
$configs = [
	'ux-design' => [
		'label'   => 'UX/UI DESIGN',
		'heading' => 'Designing Digital <strong>Experiences.</strong>',
		'sub'     => 'HUMAN-CENTERED DESIGN',
		'bg'      => '/wp-content/uploads/2026/03/service-ux.jpg',
	],
	'art-direction' => [
		'label'   => 'ART DIRECTION',
		'heading' => 'Shaping <strong>Visual Worlds</strong><br>With Meaning.',
		'sub'     => 'VISUAL STORYTELLING',
		'bg'      => '/wp-content/uploads/2026/03/service-art.jpg',
	],
	'photography' => [
		'label'   => 'PHOTOGRAPHY',
		'heading' => 'Capturing Moments,<br><strong>Crafting Stories.</strong>',
		'sub'     => 'AUTHENTIC IMAGERY',
		'bg'      => '/wp-content/uploads/2026/03/service-photo.jpg',
	],
];

$slug   = get_post_field( 'post_name', get_queried_object_id() );
$cfg    = $configs[ $slug ] ?? [
	'label'   => 'SERVICES',
	'heading' => 'Our Services.',
	'sub'     => 'G2F DESIGN',
	'bg'      => '',
];
?>
<div class="g2f-hero-about-wrap">
	<div class="g2f-hero-about-container">
		<span class="g2f-hero-about__label"><?php echo esc_html( $cfg['label'] ); ?></span>
		<div class="g2f-hero-about__image"<?php if ( $cfg['bg'] ) echo ' style="background-image:url(' . esc_url( $cfg['bg'] ) . ')"'; ?>>
			<div class="g2f-hero-about__overlay"></div>
			<div class="g2f-hero-about__content">
				<h1 class="g2f-hero-about__heading"><?php echo wp_kses_post( $cfg['heading'] ); ?></h1>
				<p class="g2f-hero-about__sub"><?php echo esc_html( $cfg['sub'] ); ?></p>
			</div>
		</div>
	</div>
</div>

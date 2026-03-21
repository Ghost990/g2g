<?php
/**
 * Title: Project Hero
 * Slug: g2f-theme/hero-project
 * Categories: g2f-theme
 * Keywords: project, hero, breadcrumb
 * Description: Single project hero — dynamic breadcrumb (SERVICES / CATEGORY) + full-bleed featured image
 */

if ( ! is_singular( 'project' ) ) return;

$services = get_the_terms( get_the_ID(), 'project_service' );
$cat_name = ( ! empty( $services ) && ! is_wp_error( $services ) ) ? $services[0]->name : '';
$thumb_id = get_post_thumbnail_id();
$thumb    = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : '';
?>
<style>
.g2f-project-hero { position: relative; margin-top: calc(-1 * var(--g2f-header-height, 74px)); padding-top: var(--g2f-header-height, 74px); background: #fff; }
.g2f-project-hero__breadcrumb { padding: 20px 80px; font-family: sans-serif; font-size: 12px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: #888; }
.g2f-project-hero__breadcrumb a { color: #888; text-decoration: none; }
.g2f-project-hero__breadcrumb a:hover { color: #000; }
.g2f-project-hero__breadcrumb .sep { margin: 0 12px; color: #bbb; }
.g2f-project-hero__image { width: 100%; height: 540px; background-color: #1c1c1c; background-size: cover; background-position: center; }
@media (max-width: 768px) {
	.g2f-project-hero__breadcrumb { padding: 16px 24px; }
	.g2f-project-hero__image { height: 280px; }
}
</style>
<div class="g2f-project-hero">
	<div class="g2f-project-hero__breadcrumb">
		<a href="/services/"><?php esc_html_e( 'SERVICES', 'g2f-theme' ); ?></a>
		<?php if ( $cat_name ) : ?>
			<span class="sep">/</span>
			<span><?php echo esc_html( strtoupper( $cat_name ) ); ?></span>
		<?php endif; ?>
	</div>
	<div class="g2f-project-hero__image"<?php if ( $thumb ) echo ' style="background-image:url(' . esc_url( $thumb ) . ')"'; ?>></div>
</div>

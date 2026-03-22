<?php
/**
 * Title: Project Hero
 * Slug: g2f-theme/hero-project
 * Categories: g2f-theme
 * Keywords: project, hero, breadcrumb
 * Description: Single project hero — breadcrumb + full-width featured image with title overlay
 */

global $post;
if ( ! $post ) return;

$services = get_the_terms( $post->ID, 'project_service' );
$cat_name = ( ! empty( $services ) && ! is_wp_error( $services ) ) ? $services[0]->name : '';
$thumb_id = get_post_thumbnail_id( $post->ID );
$thumb    = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : '';
?>
<style>
.g2f-project-hero {
	position: relative;
	margin-top: calc(-1 * var(--g2f-header-height, 60px));
	padding-top: var(--g2f-header-height, 60px);
	background: #fff;
}
.g2f-project-hero__breadcrumb {
	padding: 24px 116px;
	font-family: 'Roboto', sans-serif;
	font-size: 11px;
	font-weight: 700;
	letter-spacing: 3px;
	text-transform: uppercase;
	color: #999;
}
.g2f-project-hero__breadcrumb a { color: #999; text-decoration: none; }
.g2f-project-hero__breadcrumb a:hover { color: #000; }
.g2f-project-hero__breadcrumb .sep { margin: 0 12px; color: #ccc; }
.g2f-project-hero__image {
	width: 100%;
	height: 560px;
	background-color: #1a1a1a;
	background-size: cover;
	background-position: center;
	position: relative;
}
.g2f-project-hero__title-bar {
	position: absolute;
	bottom: 0; left: 0; right: 0;
	padding: 48px 116px;
	background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, transparent 100%);
}
.g2f-project-hero__title {
	font-family: 'Inter', sans-serif;
	font-size: clamp(28px, 4vw, 52px);
	font-weight: 300;
	color: #fff;
	letter-spacing: -1px;
	line-height: 1.1;
	margin: 0 0 8px;
}
.g2f-project-hero__type {
	font-family: 'Roboto', sans-serif;
	font-size: 11px;
	font-weight: 700;
	letter-spacing: 3px;
	text-transform: uppercase;
	color: rgba(255,255,255,0.55);
}
@media (max-width: 1024px) {
	.g2f-project-hero__breadcrumb { padding: 20px 40px; }
	.g2f-project-hero__title-bar { padding: 36px 40px; }
}
@media (max-width: 768px) {
	.g2f-project-hero__breadcrumb { padding: 16px 24px; }
	.g2f-project-hero__image { height: 300px; }
	.g2f-project-hero__title-bar { padding: 24px; }
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
	<div class="g2f-project-hero__image"<?php if ( $thumb ) echo ' style="background-image:url(' . esc_url( $thumb ) . ')"'; ?>>
		<div class="g2f-project-hero__title-bar">
			<h1 class="g2f-project-hero__title"><?php echo esc_html( get_the_title( $post->ID ) ); ?></h1>
			<?php if ( $cat_name ) : ?>
				<span class="g2f-project-hero__type"><?php echo esc_html( $cat_name ); ?></span>
			<?php endif; ?>
		</div>
	</div>
</div>

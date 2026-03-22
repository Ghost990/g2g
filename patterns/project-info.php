<?php
/**
 * Title: Project Info Sidebar
 * Slug: g2f-theme/project-info
 * Categories: g2f-theme
 * Keywords: project, info, sidebar, meta, client
 * Description: Single project info sidebar — white bordered style
 */

global $post;
if ( ! $post ) return;

$client   = get_post_meta( $post->ID, '_g2f_client_name', true );
$year     = get_post_meta( $post->ID, '_g2f_project_year', true ) ?: get_the_date( 'Y' );
$services = get_the_terms( $post->ID, 'project_service' );
$cats     = get_the_terms( $post->ID, 'project_category' );
$live_url = get_post_meta( $post->ID, '_g2f_project_url', true );
$post_url = get_permalink( $post->ID );
?>
<style>
.g2f-sidebar-box { border: 1px solid #e8e8e8; padding: 40px 36px; position: sticky; top: calc(var(--g2f-header-height, 60px) + 24px); }
.g2f-sidebar-box h6 { font-family: 'Roboto', sans-serif; font-size: 10px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: #999; margin: 0 0 28px; }
.g2f-sidebar-item { padding: 18px 0; border-bottom: 1px solid #f0f0f0; display: flex; flex-direction: column; gap: 5px; }
.g2f-sidebar-item:first-of-type { padding-top: 0; }
.g2f-sidebar-item:last-of-type { border-bottom: none; padding-bottom: 0; }
.g2f-sidebar-label { font-family: 'Roboto', sans-serif; font-size: 10px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: #aaa; }
.g2f-sidebar-value { font-family: 'Inter', sans-serif; font-size: 15px; font-weight: 500; color: #111; line-height: 1.4; }
.g2f-sidebar-share { display: flex; gap: 12px; flex-wrap: wrap; }
.g2f-sidebar-share a { font-family: 'Inter', sans-serif; font-size: 13px; color: #555; text-decoration: none; border-bottom: 1px solid #ddd; padding-bottom: 1px; }
.g2f-sidebar-share a:hover { color: #000; border-color: #000; }
.g2f-sidebar-cta { margin-top: 28px; }
.g2f-sidebar-cta a { display: inline-flex; align-items: center; gap: 8px; font-family: 'Roboto', sans-serif; font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #000; text-decoration: none; border-bottom: 2px solid #000; padding-bottom: 4px; }
.g2f-sidebar-cta a:hover { opacity: 0.6; }
</style>
<div class="g2f-sidebar-box">
	<h6>PROJECT INFO</h6>

	<?php if ( $year ) : ?>
	<div class="g2f-sidebar-item">
		<span class="g2f-sidebar-label">Date</span>
		<span class="g2f-sidebar-value"><?php echo esc_html( $year ); ?></span>
	</div>
	<?php endif; ?>

	<?php if ( $client ) : ?>
	<div class="g2f-sidebar-item">
		<span class="g2f-sidebar-label">Client</span>
		<span class="g2f-sidebar-value"><?php echo esc_html( $client ); ?></span>
	</div>
	<?php endif; ?>

	<?php if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) : ?>
	<div class="g2f-sidebar-item">
		<span class="g2f-sidebar-label">Categories</span>
		<span class="g2f-sidebar-value"><?php echo implode( ' · ', array_map( fn($t) => esc_html($t->name), $cats ) ); ?></span>
	</div>
	<?php endif; ?>

	<?php if ( ! empty( $services ) && ! is_wp_error( $services ) ) : ?>
	<div class="g2f-sidebar-item">
		<span class="g2f-sidebar-label">Tags</span>
		<span class="g2f-sidebar-value"><?php echo implode( ', ', array_map( fn($t) => esc_html($t->name), $services ) ); ?></span>
	</div>
	<?php endif; ?>

	<div class="g2f-sidebar-item">
		<span class="g2f-sidebar-label">Share</span>
		<div class="g2f-sidebar-share">
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode($post_url); ?>" target="_blank">LinkedIn</a>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode($post_url); ?>" target="_blank">Facebook</a>
			<a href="https://www.behance.net/" target="_blank">Behance</a>
		</div>
	</div>

	<?php if ( $live_url ) : ?>
	<div class="g2f-sidebar-cta">
		<a href="<?php echo esc_url($live_url); ?>" target="_blank">View Live Page →</a>
	</div>
	<?php endif; ?>
</div>

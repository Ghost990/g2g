<?php
/**
 * Title: Project — View Live Button
 * Slug: g2f-theme/project-view-live
 * Categories: g2f-theme
 * Keywords: project, live, button, url
 * Description: Renders a "VIEW LIVE PAGE" button from the _g2f_project_url custom field. Silent when empty.
 * Inserter: false
 */

if ( ! is_singular( 'project' ) ) return;

$live_url = get_post_meta( get_the_ID(), '_g2f_project_url', true );
if ( ! $live_url ) return;
?>
<div class="g2f-project-view-live">
	<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer" class="g2f-btn-view-live">
		<?php esc_html_e( 'VIEW LIVE PAGE', 'g2f-theme' ); ?>
		<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<path d="M3.125 10H16.875" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</a>
</div>

<?php
/**
 * Title: Project Info Sidebar
 * Slug: g2f-theme/project-info
 * Categories: g2f-theme
 * Keywords: project, info, sidebar, meta, client, year, role
 * Description: Dynamic project meta sidebar (client, year, category, role, live URL). PHP rendered.
 */

if ( ! is_singular( 'project' ) ) return;

$client   = get_post_meta( get_the_ID(), '_g2f_client_name', true );
$year     = get_post_meta( get_the_ID(), '_g2f_project_year', true );
$role     = get_post_meta( get_the_ID(), '_g2f_project_role', true );
$live_url = get_post_meta( get_the_ID(), '_g2f_project_url', true );
$services = get_the_terms( get_the_ID(), 'project_service' );
$cats     = get_the_terms( get_the_ID(), 'project_category' );
?>

<aside class="g2f-project-info">

	<?php if ( $client ) : ?>
	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Client', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value"><?php echo esc_html( $client ); ?></strong>
	</div>
	<?php endif; ?>

	<?php if ( $year ) : ?>
	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Year', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value"><?php echo esc_html( $year ); ?></strong>
	</div>
	<?php endif; ?>

	<?php if ( ! empty( $services ) && ! is_wp_error( $services ) ) : ?>
	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Tags', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value">
			<?php echo implode( ', ', array_map( fn( $t ) => esc_html( $t->name ), $services ) ); ?>
		</strong>
	</div>
	<?php endif; ?>

	<?php if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) : ?>
	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Type', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value">
			<?php echo implode( ', ', array_map( fn( $t ) => esc_html( $t->name ), $cats ) ); ?>
		</strong>
	</div>
	<?php endif; ?>

	<?php if ( $role ) : ?>
	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Role', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value"><?php echo esc_html( $role ); ?></strong>
	</div>
	<?php endif; ?>

	<?php if ( $live_url ) : ?>
	<div class="g2f-project-meta-item g2f-project-meta-item--link">
		<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer" class="g2f-btn g2f-btn--outline">
			<?php esc_html_e( 'View Live Project', 'g2f-theme' ); ?>
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M3 8H13M13 8L8 3M13 8L8 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</a>
	</div>
	<?php endif; ?>

</aside>

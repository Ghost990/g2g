<?php
/**
 * Title: Project Info Sidebar
 * Slug: g2f-theme/project-info
 * Categories: g2f-theme
 * Keywords: project, info, sidebar, meta, client, date, tags, categories
 * Description: Dynamic project meta sidebar (Date, Share, Tags, Categories, Client). PHP rendered.
 */

if ( ! is_singular( 'project' ) ) return;

$client   = get_post_meta( get_the_ID(), '_g2f_client_name', true );
$year     = get_post_meta( get_the_ID(), '_g2f_project_year', true ) ?: get_the_date( 'Y' );
$services = get_the_terms( get_the_ID(), 'project_service' );
$cats     = get_the_terms( get_the_ID(), 'project_category' );
$post_url = get_permalink();
?>

<aside class="g2f-project-info">

	<?php if ( $year ) : ?>
	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Date', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value"><?php echo esc_html( $year ); ?></strong>
	</div>
	<?php endif; ?>

	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Share', 'g2f-theme' ); ?></span>
		<div class="g2f-project-meta-share">
			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( $post_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn">LinkedIn</a>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( $post_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook">Facebook</a>
			<a href="https://www.behance.net/" target="_blank" rel="noopener noreferrer" aria-label="View on Behance">Behance</a>
		</div>
	</div>

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
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Categories', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value">
			<?php echo implode( ', ', array_map( fn( $t ) => esc_html( $t->name ), $cats ) ); ?>
		</strong>
	</div>
	<?php endif; ?>

	<?php if ( $client ) : ?>
	<div class="g2f-project-meta-item">
		<span class="g2f-project-meta-label"><?php esc_html_e( 'Client', 'g2f-theme' ); ?></span>
		<strong class="g2f-project-meta-value"><?php echo esc_html( $client ); ?></strong>
	</div>
	<?php endif; ?>

	<hr class="g2f-project-meta-divider" />

</aside>

<?php
/**
 * Title: Clients Section
 * Slug: g2f-theme/clients-section
 * Categories: g2f-theme
 * Keywords: clients, logos, partners
 * Description: Client logos section — WP media library images
 */

$clients = [
	[ 'id' => 0, 'name' => 'Vodafone Business' ],
	[ 'id' => 0, 'name' => 'dm' ],
	[ 'id' => 0, 'name' => 'AsicMinerz' ],
	[ 'id' => 0, 'name' => 'Alteo' ],
	[ 'id' => 0, 'name' => 'Richmond' ],
	[ 'id' => 0, 'name' => 'Macmillan' ],
	[ 'id' => 0, 'name' => 'Shopper Park+' ],
];
?>
<section class="g2f-clients-section">
	<div class="g2f-clients-inner">

		<h2 class="g2f-clients-heading">Clients<span class="g2f-dot">.</span></h2>
		<p class="g2f-clients-sub">Over the years I have worked for and cooperated with various companies from various industries.<br>Some of them can be found here:</p>

		<div class="g2f-clients-logos">
			<?php foreach ( $clients as $client ) :
				$src = wp_get_attachment_image_url( $client['id'], 'medium' );
				if ( $src ) : ?>
				<div class="g2f-client-logo">
					<img src="<?php echo esc_url( $src ); ?>"
						 alt="<?php echo esc_attr( $client['name'] ); ?>"
						 loading="lazy" />
				</div>
				<?php else : ?>
				<div class="g2f-client-logo g2f-client-logo--text" aria-label="<?php echo esc_attr( $client['name'] ); ?>">
					<span class="g2f-client-logo__text"><?php echo esc_html( $client['name'] ); ?></span>
				</div>
				<?php endif; endforeach; ?>
		</div>

	</div>
</section>

<?php
/**
 * Title: About Section
 * Slug: g2f-theme/about-section
 * Categories: g2f-theme
 * Keywords: about, introduction, team
 * Description: About us section with image and text content
 */

$site_url = get_site_url();
?>
<section id="about" class="g2f-about-section">
	<div class="g2f-about-inner">

		<div class="g2f-about-image-col">
			<img src="<?php echo esc_url( $site_url ); ?>/wp-content/uploads/2026/03/about.jpg"
				alt="About G2F Design"
				class="g2f-about-img" />
		</div>

		<div class="g2f-about-text-col">
			<h2 class="g2f-about-heading">We Bring <strong>Creative Ideas</strong> To Life.</h2>

			<div class="g2f-about-body">
				<p>Welcome to <strong>G2F Design</strong> — a culmination of two decades of experience, relentless creativity, and a passion for shaping extraordinary visual experiences.</p>
				<p class="g2f-about-muted">At the heart of <strong>G2F Design</strong> is a commitment to fusing creative design and web technology into seamless visual experiences and functionality. We specialize in creating beautiful digital experiences that not only look stunning but also work flawlessly.</p>
			</div>

			<a href="/about/" class="g2f-btn-arrow">
				<span>ABOUT US</span>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M3.125 10H16.875" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>
		</div>

		<span class="g2f-about-label">About Us</span>

	</div>
</section>

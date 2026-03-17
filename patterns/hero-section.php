<?php
/**
 * Title: Hero Section
 * Slug: g2f-theme/hero-section
 * Categories: g2f-theme
 * Keywords: hero, banner, header
 * Description: Full-width hero section with background image and headline
 */
?>

<!-- wp:group {"tagName":"section","anchor":"home","className":"g2f-hero","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<section id="home" class="wp-block-group g2f-hero" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0">

	<!-- wp:group {"className":"g2f-hero-wrapper","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
	<div class="wp-block-group g2f-hero-wrapper" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">

		<!-- wp:group {"className":"g2f-vertical-text-strip","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"backgroundColor":"white","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group g2f-vertical-text-strip has-white-background-color has-background" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">

			<!-- wp:paragraph {"className":"g2f-vertical-text","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"700","letterSpacing":"3px","lineHeight":"1.2"}},"textColor":"black","fontFamily":"roboto"} -->
			<p class="g2f-vertical-text has-black-color has-text-color has-roboto-font-family" style="font-size:14px;font-style:normal;font-weight:700;letter-spacing:3px;line-height:1.2">WEBSITE + UI/UX DESIGN</p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->

		<!-- wp:cover {"url":"http://localhost:8080/wp-content/uploads/2026/03/hero.jpg","id":40,"dimRatio":50,"overlayColor":"black","isUserOverlayColor":true,"minHeight":868,"minHeightUnit":"px","className":"g2f-hero-cover","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
		<div class="wp-block-cover g2f-hero-cover" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:868px">
			<span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-50 has-background-dim"></span>
			<img alt="" class="wp-block-cover__image-background wp-image-40" src="http://localhost:8080/wp-content/uploads/2026/03/hero.jpg" style="object-position:50% 50%;" data-object-fit="cover"/>
			<div class="wp-block-cover__inner-container">

				<!-- wp:group {"style":{"spacing":{"padding":{"top":"250px","bottom":"100px","left":"80px","right":"80px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
				<div class="wp-block-group" style="padding-top:250px;padding-bottom:100px;padding-left:80px;padding-right:80px">

					<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
					<div class="wp-block-group">

						<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","lineHeight":"1.375"}},"textColor":"white","fontFamily":"inter"} -->
						<p class="has-white-color has-text-color has-inter-font-family" style="font-size:16px;line-height:1.375">©2025</p>
						<!-- /wp:paragraph -->

						<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"100px","fontStyle":"normal","fontWeight":"400","lineHeight":"0.94","letterSpacing":"-4px"}},"textColor":"white","fontFamily":"inter"} -->
						<h1 class="wp-block-heading has-white-color has-text-color has-inter-font-family" style="font-size:100px;font-style:normal;font-weight:400;letter-spacing:-4px;line-height:0.94">CRAFT DESIGN<br>SOLUTION.</h1>
						<!-- /wp:heading -->

						<!-- wp:separator {"style":{"spacing":{"margin":{"top":"40px","bottom":"32px"}}},"backgroundColor":"white","className":"is-style-wide g2f-hero-separator"} -->
						<hr class="wp-block-separator has-text-color has-white-color has-alpha-channel-opacity has-white-background-color has-background is-style-wide g2f-hero-separator" style="margin-top:40px;margin-bottom:32px"/>
						<!-- /wp:separator -->

						<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"300","lineHeight":"1.5"}},"textColor":"white","fontFamily":"inter"} -->
						<p class="has-white-color has-text-color has-inter-font-family" style="font-size:16px;font-style:normal;font-weight:300;line-height:1.5">two decades of experience, relentless curiosity, and a passion for<br>shaping extraordinary visual narratives.</p>
						<!-- /wp:paragraph -->

					</div>
					<!-- /wp:group -->

				</div>
				<!-- /wp:group -->

			</div>
		</div>
		<!-- /wp:cover -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->

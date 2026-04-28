<?php
/**
 * Title: Hero Section
 * Slug: g2f-theme/hero-section
 * Categories: g2f-theme
 * Keywords: hero, banner, header
 * Description: Full-width hero section with background image and headline
 */
?>

<?php
$hero_image = g2f_theme_resolve_upload_asset(
	'2026/03/hero.jpg',
	18,
	'2026/02/Rectangle-321@2x-scaled.png'
);
?>

<!-- wp:group {"tagName":"section","anchor":"home","className":"g2f-hero","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<section id="home" class="wp-block-group g2f-hero is-layout-flow wp-block-group-is-layout-flow" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0">

	<!-- wp:group {"className":"g2f-hero-wrapper","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
	<div class="wp-block-group g2f-hero-wrapper is-layout-flex wp-block-group-is-layout-flex is-nowrap is-content-justification-left" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">

		<!-- LEFT STRIP -->
		<!-- wp:group {"className":"g2f-vertical-text-strip","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"backgroundColor":"white","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group g2f-vertical-text-strip has-white-background-color has-background is-layout-flex wp-block-group-is-layout-flex is-vertical is-content-justification-center" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">
			<!-- wp:paragraph {"className":"g2f-vertical-text","style":{"typography":{"fontSize":"24px","fontStyle":"normal","fontWeight":"700","letterSpacing":"3px","lineHeight":"1.2"}},"textColor":"black","fontFamily":"roboto"} -->
			<p class="g2f-vertical-text has-black-color has-text-color has-roboto-font-family" style="font-size:24px;font-style:normal;font-weight:700;letter-spacing:3px;line-height:1.2">WELCOME TO G2F DESIGN</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- HERO COVER -->
		<!-- wp:cover {"url":"<?php echo esc_url( $hero_image ); ?>","dimRatio":50,"overlayColor":"black","isUserOverlayColor":true,"minHeight":500,"minHeightUnit":"px","className":"g2f-hero-cover","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
		<div class="wp-block-cover g2f-hero-cover" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:500px">
			<span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-50 has-background-dim"></span>
			<img alt="" class="wp-block-cover__image-background" src="<?php echo esc_url( $hero_image ); ?>" style="object-position:50% 50%;" data-object-fit="cover"/>
			<div class="wp-block-cover__inner-container">

				<!-- wp:group {"className":"g2f-hero-content-wrap","style":{"spacing":{"padding":{"top":"152px","bottom":"56px","left":"72px","right":"72px"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
				<div class="wp-block-group g2f-hero-content-wrap is-layout-constrained wp-block-group-is-layout-constrained" style="padding-top:152px;padding-bottom:56px;padding-left:72px;padding-right:72px">

					<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
					<div class="wp-block-group is-layout-flex wp-block-group-is-layout-flex is-vertical">

						<!-- wp:paragraph {"className":"g2f-hero-eyebrow","style":{"typography":{"fontSize":"12px","lineHeight":"1.2","letterSpacing":"0.18em","fontStyle":"normal","fontWeight":"600","textTransform":"uppercase"}},"textColor":"white","fontFamily":"inter"} -->
						<p class="g2f-hero-eyebrow has-white-color has-text-color has-inter-font-family" style="font-size:12px;line-height:1.2;letter-spacing:0.18em;font-style:normal;font-weight:600;text-transform:uppercase">©2025</p>
						<!-- /wp:paragraph -->

						<!-- wp:heading {"level":1,"className":"g2f-hero-title","style":{"typography":{"fontSize":"72px","fontStyle":"normal","fontWeight":"300","lineHeight":"0.94","letterSpacing":"-3px"}},"textColor":"white","fontFamily":"inter"} -->
						<h1 class="wp-block-heading g2f-hero-title has-white-color has-text-color has-inter-font-family" style="font-size:72px;font-style:normal;font-weight:300;letter-spacing:-3px;line-height:0.94">CRAFT DESIGN<br><strong>SOLUTION.</strong></h1>
						<!-- /wp:heading -->

						<!-- wp:separator {"style":{"spacing":{"margin":{"top":"40px","bottom":"32px"}}},"backgroundColor":"white","className":"is-style-wide g2f-hero-separator"} -->
						<hr class="wp-block-separator has-text-color has-white-color has-alpha-channel-opacity has-white-background-color has-background is-style-wide g2f-hero-separator" style="margin-top:40px;margin-bottom:32px"/>
						<!-- /wp:separator -->

						<!-- wp:paragraph {"className":"g2f-hero-description","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"300","lineHeight":"1.45"}},"textColor":"white","fontFamily":"inter"} -->
						<p class="g2f-hero-description has-white-color has-text-color has-inter-font-family" style="font-size:14px;font-style:normal;font-weight:300;line-height:1.45">Two decades of design experience, relentless curiosity, and a passion for shaping extraordinary visual stories.</p>
						<!-- /wp:paragraph -->

					</div>
					<!-- /wp:group -->

				</div>
				<!-- /wp:group -->

			</div>
		</div>
		<!-- /wp:cover -->

		<!-- RIGHT STRIP -->
		<!-- wp:group {"className":"g2f-vertical-text-strip g2f-vertical-text-strip--right","backgroundColor":"white","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group g2f-vertical-text-strip g2f-vertical-text-strip--right has-white-background-color has-background is-layout-flex wp-block-group-is-layout-flex is-vertical is-content-justification-center" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->

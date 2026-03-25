<?php
/**
 * Title: Services Section
 * Slug: g2f-theme/services-section
 * Categories: g2f-theme
 * Keywords: services, ux, art direction, photography
 * Description: Alternating image+text rows — image bleeds edge, text content opposite side
 */
?>

<!-- ============================================================
     SERVICES WRAPPER
     ============================================================ -->
<!-- wp:group {"tagName":"section","anchor":"services","className":"g2f-services-rows","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"white","layout":{"type":"default"}} -->
<section id="services" class="wp-block-group g2f-services-rows has-white-background-color has-background" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;margin-top:0;margin-bottom:0">

<div class="g2f-services-header">
	<h2 class="g2f-services-title">Services <strong>Tailored For Your</strong> Business.</h2>
	<p class="g2f-services-subtitle">Our services are more than just solutions, they're opportunities to transform your digital presence and achieve your business objectives. We're here to make your digital dreams a reality.</p>
</div>


<!-- ============================================================
     ROW 1: Product Design — Image LEFT, Content RIGHT
     ============================================================ -->
<!-- wp:group {"className":"g2f-service-row g2f-service-row--img-left","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group g2f-service-row g2f-service-row--img-left" style="margin-top:0;margin-bottom:0">

	<!-- Image — bleeds left edge -->
	<!-- wp:group {"className":"g2f-service-row__image","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group g2f-service-row__image" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">
		<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
		<figure class="wp-block-image size-large">
			<img src="<?php echo esc_url(get_site_url()); ?>/wp-content/uploads/2026/03/service-ux.jpg" alt="Product Design" />
		</figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->

	<!-- Content — right side with padding -->
	<!-- wp:group {"className":"g2f-service-row__content","style":{"spacing":{"padding":{"top":"60px","bottom":"60px","left":"60px","right":"60px"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group g2f-service-row__content" style="padding-top:60px;padding-bottom:60px;padding-left:60px;padding-right:60px">

		<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"clamp(28px,3.5vw,44px)","fontWeight":"400","lineHeight":"1.1","letterSpacing":"-1px"}},"textColor":"black","fontFamily":"inter"} -->
		<h2 class="wp-block-heading has-black-color has-text-color has-inter-font-family" style="font-size:clamp(28px,3.5vw,44px);font-weight:400;letter-spacing:-1px;line-height:1.1">Product Design</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","fontWeight":"700","lineHeight":"1.5"}},"textColor":"black","fontFamily":"inter"} -->
		<p class="has-black-color has-text-color has-inter-font-family" style="font-size:15px;font-weight:700;line-height:1.5">Design products that feel inevitable.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","lineHeight":"1.7"}},"textColor":"text-muted","fontFamily":"roboto"} -->
		<p class="has-text-muted-color has-text-color has-roboto-font-family" style="font-size:15px;line-height:1.7">We shape intuitive, user-first experiences—transforming bold ideas into beautifully crafted products that people can't live without.</p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"g2f-button-arrow g2f-button-arrow--sm","style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"20px","right":"20px"},"blockGap":"10px"}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
		<div class="wp-block-group g2f-button-arrow g2f-button-arrow--sm has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px">
			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2","fontSize":"13px"}},"fontFamily":"inter"} -->
			<p class="has-inter-font-family" style="font-style:normal;font-weight:600;line-height:1.2;font-size:13px"><a href="/services/ux-design/">EXPLORE</a></p>
			<!-- /wp:paragraph -->
			<!-- wp:html -->
				<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->


<!-- ============================================================
     ROW 2: Art Direction — Content LEFT, Image RIGHT
     ============================================================ -->
<!-- wp:group {"className":"g2f-service-row g2f-service-row--img-right","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group g2f-service-row g2f-service-row--img-right" style="margin-top:0;margin-bottom:0">

	<!-- Content — left side with padding -->
	<!-- wp:group {"className":"g2f-service-row__content","style":{"spacing":{"padding":{"top":"60px","bottom":"60px","left":"60px","right":"60px"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group g2f-service-row__content" style="padding-top:60px;padding-bottom:60px;padding-left:60px;padding-right:60px">

		<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"clamp(28px,3.5vw,44px)","fontWeight":"400","lineHeight":"1.1","letterSpacing":"-1px"}},"textColor":"black","fontFamily":"inter"} -->
		<h2 class="wp-block-heading has-black-color has-text-color has-inter-font-family" style="font-size:clamp(28px,3.5vw,44px);font-weight:400;letter-spacing:-1px;line-height:1.1">Art Direction</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","fontWeight":"700","lineHeight":"1.5"}},"textColor":"black","fontFamily":"inter"} -->
		<p class="has-black-color has-text-color has-inter-font-family" style="font-size:15px;font-weight:700;line-height:1.5">Design that speaks before you do.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","lineHeight":"1.7"}},"textColor":"text-muted","fontFamily":"roboto"} -->
		<p class="has-text-muted-color has-text-color has-roboto-font-family" style="font-size:15px;line-height:1.7">Through bold art direction and refined visual storytelling, we craft striking identities that leave a lasting impression and elevate every brand moment.</p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"g2f-button-arrow g2f-button-arrow--sm","style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"20px","right":"20px"},"blockGap":"10px"}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
		<div class="wp-block-group g2f-button-arrow g2f-button-arrow--sm has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px">
			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2","fontSize":"13px"}},"fontFamily":"inter"} -->
			<p class="has-inter-font-family" style="font-style:normal;font-weight:600;line-height:1.2;font-size:13px"><a href="/services/art-direction/">EXPLORE</a></p>
			<!-- /wp:paragraph -->
			<!-- wp:html -->
				<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

	<!-- Image — bleeds right edge -->
	<!-- wp:group {"className":"g2f-service-row__image","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group g2f-service-row__image" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">
		<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
		<figure class="wp-block-image size-large">
			<img src="<?php echo esc_url(get_site_url()); ?>/wp-content/uploads/2026/03/service-art.jpg" alt="Art Direction" />
		</figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->


<!-- ============================================================
     ROW 3: Photography — Image LEFT, Content RIGHT
     ============================================================ -->
<!-- wp:group {"className":"g2f-service-row g2f-service-row--img-left","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group g2f-service-row g2f-service-row--img-left" style="margin-top:0;margin-bottom:0">

	<!-- Image — bleeds left edge -->
	<!-- wp:group {"className":"g2f-service-row__image","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group g2f-service-row__image" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0">
		<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
		<figure class="wp-block-image size-large">
			<img src="<?php echo esc_url(get_site_url()); ?>/wp-content/uploads/2026/03/service-photo.jpg" alt="Photography" />
		</figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->

	<!-- Content — right side with padding -->
	<!-- wp:group {"className":"g2f-service-row__content","style":{"spacing":{"padding":{"top":"60px","bottom":"60px","left":"60px","right":"60px"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group g2f-service-row__content" style="padding-top:60px;padding-bottom:60px;padding-left:60px;padding-right:60px">

		<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"clamp(28px,3.5vw,44px)","fontWeight":"400","lineHeight":"1.1","letterSpacing":"-1px"}},"textColor":"black","fontFamily":"inter"} -->
		<h2 class="wp-block-heading has-black-color has-text-color has-inter-font-family" style="font-size:clamp(28px,3.5vw,44px);font-weight:400;letter-spacing:-1px;line-height:1.1">Photography</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","fontWeight":"700","lineHeight":"1.5"}},"textColor":"black","fontFamily":"inter"} -->
		<p class="has-black-color has-text-color has-inter-font-family" style="font-size:15px;font-weight:700;line-height:1.5">Moments that move, frames that speak.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px","lineHeight":"1.7"}},"textColor":"text-muted","fontFamily":"roboto"} -->
		<p class="has-text-muted-color has-text-color has-roboto-font-family" style="font-size:15px;line-height:1.7">We capture the raw, the real, and the remarkable—using photography to tell stories that linger long after the shutter clicks.</p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"g2f-button-arrow g2f-button-arrow--sm","style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"20px","right":"20px"},"blockGap":"10px"}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
		<div class="wp-block-group g2f-button-arrow g2f-button-arrow--sm has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px">
			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2","fontSize":"13px"}},"fontFamily":"inter"} -->
			<p class="has-inter-font-family" style="font-style:normal;font-weight:600;line-height:1.2;font-size:13px"><a href="/services/photography/">EXPLORE</a></p>
			<!-- /wp:paragraph -->
			<!-- wp:html -->
				<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->


</section>
<!-- /wp:group -->

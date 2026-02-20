<?php
/**
 * Title: About Section
 * Slug: g2f-theme/about-section
 * Categories: g2f-theme
 * Keywords: about, introduction, team
 * Description: About us section with image and text content, vertical text on right
 */
?>

<!-- wp:group {"tagName":"section","anchor":"about","className":"g2f-about-section","style":{"spacing":{"padding":{"top":"100px","bottom":"100px"}}},"backgroundColor":"white","layout":{"type":"default"}} -->
<section id="about" class="wp-block-group g2f-about-section has-white-background-color has-background" style="padding-top:100px;padding-bottom:100px">

	<!-- wp:group {"style":{"position":{"type":"relative"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">

		<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"70px"}}}} -->
		<div class="wp-block-columns">

			<!-- wp:column {"width":"490px"} -->
			<div class="wp-block-column" style="flex-basis:490px">

				<!-- wp:image {"sizeSlug":"g2f-about","linkDestination":"none","className":"g2f-about-image","style":{"border":{"radius":"8px"}}} -->
				<figure class="wp-block-image size-g2f-about g2f-about-image" style="border-radius:8px">
					<img src="" alt="About G2F Design"/>
				</figure>
				<!-- /wp:image -->

			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"658px"} -->
			<div class="wp-block-column" style="flex-basis:658px">

				<!-- wp:group {"style":{"spacing":{"blockGap":"32px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group">

					<!-- wp:heading {"level":2,"className":"g2f-fade-in","style":{"typography":{"fontSize":"60px","lineHeight":"1.1","fontWeight":"400"}},"fontFamily":"roboto"} -->
					<h2 class="wp-block-heading g2f-fade-in has-roboto-font-family" style="font-size:60px;font-weight:400;line-height:1.1">We Bring <strong>Creative Ideas</strong> To Life.</h2>
					<!-- /wp:heading -->

					<!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
					<div class="wp-block-group">

						<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","lineHeight":"1.7","fontWeight":"400"}},"fontFamily":"roboto"} -->
						<p class="has-roboto-font-family" style="font-size:20px;font-weight:400;line-height:1.7">Welcome to <strong>G2F Design</strong> — a culmination of two decades of experience, relentless creativity, and a passion for shaping extraordinary visual experiences.</p>
						<!-- /wp:paragraph -->

						<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","lineHeight":"1.7","fontWeight":"400"}},"textColor":"text-muted","fontFamily":"roboto"} -->
						<p class="has-text-muted-color has-text-color has-roboto-font-family" style="font-size:20px;font-weight:400;line-height:1.7">At the heart of <strong>G2F Design</strong> is a commitment to fusing creative design and web technology into seamless visual experiences and functionality. We specialize in creating beautiful digital experiences that not only look stunning but also work flawlessly.</p>
						<!-- /wp:paragraph -->

					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"g2f-button-arrow","style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"24px","right":"24px"},"blockGap":"12px"}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
					<div class="wp-block-group g2f-button-arrow has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:8px;padding-right:24px;padding-bottom:8px;padding-left:24px">

						<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"fontSize":"medium","fontFamily":"inter"} -->
						<p class="has-inter-font-family has-medium-font-size" style="font-style:normal;font-weight:600;line-height:1.2"><a href="#about">ABOUT US</a></p>
						<!-- /wp:paragraph -->

						<!-- wp:outermost/icon-block {"iconName":"g2f-arrows/arrow-right-black","width":"20px","height":"20px"} -->
						<div class="wp-block-outermost-icon-block"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
						<!-- /wp:outermost/icon-block -->

					</div>
					<!-- /wp:group -->

				</div>
				<!-- /wp:group -->

			</div>
			<!-- /wp:column -->

		</div>
		<!-- /wp:columns -->

		<!-- Vertical "About Us" text on the RIGHT side -->
		<!-- wp:paragraph {"className":"g2f-vertical-text g2f-vertical-text-right","style":{"typography":{"fontSize":"50px","fontStyle":"normal","fontWeight":"400"}}} -->
		<p class="g2f-vertical-text g2f-vertical-text-right" style="font-size:50px;font-style:normal;font-weight:400;opacity:0.4">About Us</p>
		<!-- /wp:paragraph -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->

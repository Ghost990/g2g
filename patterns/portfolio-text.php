<?php
/**
 * Title: Portfolio Text Section
 * Slug: g2f-theme/portfolio-text
 * Categories: g2f-theme
 * Keywords: portfolio, text, headline
 * Description: Two-column text section with large stacked typography and CTA
 */
?>

<!-- wp:group {"tagName":"section","className":"g2f-portfolio-split","style":{"spacing":{"padding":{"top":"120px","bottom":"120px","left":"151px","right":"151px"}}},"backgroundColor":"gray-light","layout":{"type":"default"}} -->
<section class="wp-block-group g2f-portfolio-split has-gray-light-background-color has-background" style="padding-top:120px;padding-bottom:120px;padding-left:151px;padding-right:151px">

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"80px"}}}} -->
	<div class="wp-block-columns">

		<!-- Left Column: Large Stacked Typography -->
		<!-- wp:column {"width":"55%"} -->
		<div class="wp-block-column" style="flex-basis:55%">

			<!-- wp:group {"className":"g2f-portfolio-heading","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group g2f-portfolio-heading">

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"72px","fontStyle":"normal","fontWeight":"400","lineHeight":"1.15","letterSpacing":"-2px"}},"fontFamily":"inter"} -->
				<p class="has-inter-font-family" style="font-size:72px;font-style:normal;font-weight:400;letter-spacing:-2px;line-height:1.15">Creative</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"72px","lineHeight":"1.15","letterSpacing":"-2px"}},"fontFamily":"inter"} -->
				<p class="has-inter-font-family" style="font-size:72px;letter-spacing:-2px;line-height:1.15"><strong>Portfolio</strong> With</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"72px","fontStyle":"normal","fontWeight":"400","lineHeight":"1.15","letterSpacing":"-2px"}},"fontFamily":"inter"} -->
				<p class="has-inter-font-family" style="font-size:72px;font-style:normal;font-weight:400;letter-spacing:-2px;line-height:1.15">A Variety Of</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"72px","fontStyle":"normal","fontWeight":"400","lineHeight":"1.15","letterSpacing":"-2px"}},"fontFamily":"inter"} -->
				<p class="has-inter-font-family" style="font-size:72px;font-style:normal;font-weight:400;letter-spacing:-2px;line-height:1.15">Examples.</p>
				<!-- /wp:paragraph -->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

		<!-- Right Column: Description + Button -->
		<!-- wp:column {"width":"45%","verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">

			<!-- wp:group {"className":"g2f-portfolio-content","style":{"spacing":{"blockGap":"32px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group g2f-portfolio-content">

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","lineHeight":"1.7"}},"textColor":"text-muted"} -->
				<p class="has-text-muted-color has-text-color" style="font-size:20px;line-height:1.7">G2F is a culmination from 20+ years of digital experience. Here at <strong>G2F Design</strong> we pride ourselves in providing exceptional customer-friendly service that combines our expertise in creative design, technology, and branding to transform your vision into something extraordinary.</p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"style":{"border":{"radius":"100px"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"32px","right":"32px"}}},"backgroundColor":"black","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
				<div class="wp-block-group has-black-background-color has-background" style="border-radius:100px;padding-top:16px;padding-right:32px;padding-bottom:16px;padding-left:32px">

					<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"textColor":"white","fontSize":"medium","fontFamily":"inter"} -->
					<p class="has-white-color has-text-color has-inter-font-family has-medium-font-size" style="font-style:normal;font-weight:600;line-height:1.2"><a href="#">SOLUTIONS</a></p>
					<!-- /wp:paragraph -->

					<!-- wp:outermost/icon-block {"iconName":"g2f-arrows/arrow-right-white","width":"20px","height":"20px"} -->
					<div class="wp-block-outermost-icon-block"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
					<!-- /wp:outermost/icon-block -->

				</div>
				<!-- /wp:group -->

			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</section>
<!-- /wp:group -->

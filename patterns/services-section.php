<?php
/**
 * Title: Services Section
 * Slug: g2f-theme/services-section
 * Categories: g2f-theme
 * Keywords: services, features, offerings
 * Description: Services section with zig-zag alternating layout
 */
?>

<!-- wp:group {"tagName":"section","anchor":"services","className":"g2f-services-zigzag","style":{"spacing":{"padding":{"top":"100px","bottom":"100px","left":"151px","right":"151px"}}},"backgroundColor":"white","layout":{"type":"default"}} -->
<section id="services" class="wp-block-group g2f-services-zigzag has-white-background-color has-background" style="padding-top:100px;padding-bottom:100px;padding-left:151px;padding-right:151px">

	<!-- wp:group {"style":{"spacing":{"blockGap":"32px","margin":{"bottom":"80px"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group" style="margin-bottom:80px">

		<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"60px","fontStyle":"normal","fontWeight":"400","lineHeight":"1","letterSpacing":"-1.2px"}},"fontFamily":"inter"} -->
		<h2 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-size:60px;font-style:normal;font-weight:400;letter-spacing:-1.2px;line-height:1">Services <strong>Tailored For Your</strong> Business.</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"24px","lineHeight":"1.5","letterSpacing":"-0.24px"}},"textColor":"text-muted","fontFamily":"roboto"} -->
		<p class="has-text-align-center has-text-muted-color has-text-color has-roboto-font-family" style="font-size:24px;letter-spacing:-0.24px;line-height:1.5">Our services are more than just solutions, they're opportunities to transform your digital presence and achieve your business objectives.</p>
		<!-- /wp:paragraph -->

	</div>
	<!-- /wp:group -->

	<!-- Service Row 1: Image Left, Text Right - Product Design -->
	<!-- wp:columns {"className":"g2f-service-row","style":{"spacing":{"blockGap":{"left":"0"},"margin":{"bottom":"0"}}}} -->
	<div class="wp-block-columns g2f-service-row" style="margin-bottom:0">

		<!-- wp:column {"width":"50%"} -->
		<div class="wp-block-column" style="flex-basis:50%">

			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"g2f-service-image-large g2f-slide-left","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-full g2f-service-image-large g2f-slide-left" style="border-radius:8px">
				<img src="" alt="Product Design"/>
			</figure>
			<!-- /wp:image -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"50%","verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">

			<!-- wp:group {"className":"g2f-slide-right","style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group g2f-slide-right">

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"400","letterSpacing":"2px","textTransform":"uppercase"}},"textColor":"text-muted","fontFamily":"inter"} -->
				<p class="has-text-muted-color has-text-color has-inter-font-family" style="font-size:18px;font-style:normal;font-weight:400;letter-spacing:2px;text-transform:uppercase">01</p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"inter"} -->
				<h3 class="wp-block-heading has-inter-font-family" style="font-size:48px;font-style:normal;font-weight:700;line-height:1.1">Product Design</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","lineHeight":"1.7"}},"textColor":"text-muted"} -->
				<p class="has-text-muted-color has-text-color" style="font-size:20px;line-height:1.7"><strong>Design products that feel inevitable.</strong> Simple, intuitive, and impossible to ignore. From concept to launch, we transform complex ideas into experiences people love.</p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"g2f-button-arrow","style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"24px","right":"24px"},"blockGap":"12px"}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
				<div class="wp-block-group g2f-button-arrow has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:12px;padding-right:24px;padding-bottom:12px;padding-left:24px">

					<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"fontSize":"medium","fontFamily":"inter"} -->
					<p class="has-inter-font-family has-medium-font-size" style="font-style:normal;font-weight:600;line-height:1.2"><a href="#">EXPLORE</a></p>
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

	<!-- Service Row 2: Text Left, Image Right - Art Direction -->
	<!-- wp:columns {"className":"g2f-service-row g2f-service-row-reverse","style":{"spacing":{"blockGap":{"left":"0"},"margin":{"bottom":"0"}}}} -->
	<div class="wp-block-columns g2f-service-row g2f-service-row-reverse" style="margin-bottom:0">

		<!-- wp:column {"width":"50%","verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">

			<!-- wp:group {"className":"g2f-slide-right","style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group g2f-slide-right">

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"400","letterSpacing":"2px","textTransform":"uppercase"}},"textColor":"text-muted","fontFamily":"inter"} -->
				<p class="has-text-muted-color has-text-color has-inter-font-family" style="font-size:18px;font-style:normal;font-weight:400;letter-spacing:2px;text-transform:uppercase">02</p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"inter"} -->
				<h3 class="wp-block-heading has-inter-font-family" style="font-size:48px;font-style:normal;font-weight:700;line-height:1.1">Art Direction</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","lineHeight":"1.7"}},"textColor":"text-muted"} -->
				<p class="has-text-muted-color has-text-color" style="font-size:20px;line-height:1.7"><strong>Design that speaks before you do.</strong> We craft visual languages that capture attention, build trust, and create emotional connections that last.</p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"g2f-button-arrow","style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"24px","right":"24px"},"blockGap":"12px"}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
				<div class="wp-block-group g2f-button-arrow has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:12px;padding-right:24px;padding-bottom:12px;padding-left:24px">

					<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"fontSize":"medium","fontFamily":"inter"} -->
					<p class="has-inter-font-family has-medium-font-size" style="font-style:normal;font-weight:600;line-height:1.2"><a href="#">EXPLORE</a></p>
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

		<!-- wp:column {"width":"50%"} -->
		<div class="wp-block-column" style="flex-basis:50%">

			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"g2f-service-image-large g2f-slide-left","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-full g2f-service-image-large g2f-slide-left" style="border-radius:8px">
				<img src="" alt="Art Direction"/>
			</figure>
			<!-- /wp:image -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

	<!-- Service Row 3: Image Left, Text Right - Photography -->
	<!-- wp:columns {"className":"g2f-service-row","style":{"spacing":{"blockGap":{"left":"0"}}}} -->
	<div class="wp-block-columns g2f-service-row">

		<!-- wp:column {"width":"50%"} -->
		<div class="wp-block-column" style="flex-basis:50%">

			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"g2f-service-image-large g2f-slide-left","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-full g2f-service-image-large g2f-slide-left" style="border-radius:8px">
				<img src="" alt="Photography"/>
			</figure>
			<!-- /wp:image -->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"50%","verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">

			<!-- wp:group {"className":"g2f-slide-right","style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group g2f-slide-right">

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"400","letterSpacing":"2px","textTransform":"uppercase"}},"textColor":"text-muted","fontFamily":"inter"} -->
				<p class="has-text-muted-color has-text-color has-inter-font-family" style="font-size:18px;font-style:normal;font-weight:400;letter-spacing:2px;text-transform:uppercase">03</p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1.1"}},"fontFamily":"inter"} -->
				<h3 class="wp-block-heading has-inter-font-family" style="font-size:48px;font-style:normal;font-weight:700;line-height:1.1">Photography</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"style":{"typography":{"fontSize":"20px","lineHeight":"1.7"}},"textColor":"text-muted"} -->
				<p class="has-text-muted-color has-text-color" style="font-size:20px;line-height:1.7"><strong>Moments that move, frames that speak.</strong> We capture the essence of your brand through powerful imagery that tells stories and creates lasting impressions.</p>
				<!-- /wp:paragraph -->

				<!-- wp:group {"className":"g2f-button-arrow","style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"24px","right":"24px"},"blockGap":"12px"}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
				<div class="wp-block-group g2f-button-arrow has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:12px;padding-right:24px;padding-bottom:12px;padding-left:24px">

					<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"fontSize":"medium","fontFamily":"inter"} -->
					<p class="has-inter-font-family has-medium-font-size" style="font-style:normal;font-weight:600;line-height:1.2"><a href="#">EXPLORE</a></p>
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

</section>
<!-- /wp:group -->

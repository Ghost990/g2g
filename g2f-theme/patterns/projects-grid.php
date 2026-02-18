<?php
/**
 * Title: Projects Grid
 * Slug: g2f-theme/projects-grid
 * Categories: g2f-theme
 * Keywords: projects, portfolio, gallery, grid
 * Description: Filterable projects grid with tabs
 */
?>

<!-- wp:group {"tagName":"section","className":"g2f-projects-grid-section","style":{"spacing":{"padding":{"top":"100px","bottom":"100px","left":"151px","right":"151px"}}},"backgroundColor":"white","layout":{"type":"default"}} -->
<section id="gallery" class="wp-block-group g2f-projects-grid-section has-white-background-color has-background" style="padding-top:100px;padding-bottom:100px;padding-left:151px;padding-right:151px">

	<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"60px","fontStyle":"normal","fontWeight":"400","lineHeight":"1.1"},"spacing":{"margin":{"bottom":"48px"}}},"fontFamily":"inter"} -->
	<h2 class="wp-block-heading has-text-align-center has-inter-font-family" style="margin-bottom:48px;font-size:60px;font-style:normal;font-weight:400;line-height:1.1"><strong>Explore</strong> Our Latest Projects.</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"g2f-project-tabs","style":{"spacing":{"blockGap":"40px","margin":{"bottom":"48px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
	<div class="wp-block-group g2f-project-tabs" style="margin-bottom:48px">

		<!-- wp:group {"className":"g2f-project-tab active","style":{"spacing":{"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group g2f-project-tab active" data-category="all">
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"400","textTransform":"uppercase"}},"fontFamily":"inter"} -->
			<p class="has-inter-font-family" style="font-size:18px;font-style:normal;font-weight:400;text-transform:uppercase">All</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-tab","style":{"spacing":{"blockGap":"12px"},"opacity":"0.5"},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group g2f-project-tab" data-category="ux-ui">
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"400","textTransform":"uppercase"}},"fontFamily":"inter"} -->
			<p class="has-inter-font-family" style="font-size:18px;font-style:normal;font-weight:400;text-transform:uppercase">UX/UI</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-tab","style":{"spacing":{"blockGap":"12px"},"opacity":"0.5"},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group g2f-project-tab" data-category="art-direction">
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"400","textTransform":"uppercase"}},"fontFamily":"inter"} -->
			<p class="has-inter-font-family" style="font-size:18px;font-style:normal;font-weight:400;text-transform:uppercase">Art Direction</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-tab","style":{"spacing":{"blockGap":"12px"},"opacity":"0.5"},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group g2f-project-tab" data-category="photography">
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"400","textTransform":"uppercase"}},"fontFamily":"inter"} -->
			<p class="has-inter-font-family" style="font-size:18px;font-style:normal;font-weight:400;text-transform:uppercase">Photography</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"g2f-project-grid","layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
	<div class="wp-block-group g2f-project-grid">

		<!-- wp:group {"className":"g2f-project-card","layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group g2f-project-card" data-category="ux-ui">
			<!-- wp:image {"sizeSlug":"g2f-project","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-g2f-project g2f-project-image" style="border-radius:8px">
				<img src="" alt="AsicMinerz"/>
			</figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"g2f-project-info","layout":{"type":"constrained"}} -->
			<div class="wp-block-group g2f-project-info">
				<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"inter"} -->
				<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-size:20px;font-style:normal;font-weight:700">AsicMinerz</h5>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700"}},"textColor":"text-secondary","fontFamily":"inter"} -->
				<p class="has-text-align-center has-text-secondary-color has-text-color has-inter-font-family" style="font-size:16px;font-style:normal;font-weight:700">Website - UX/UI</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-card","layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group g2f-project-card" data-category="art-direction">
			<!-- wp:image {"sizeSlug":"g2f-project","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-g2f-project g2f-project-image" style="border-radius:8px">
				<img src="" alt="Aeroprodukt"/>
			</figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"g2f-project-info","layout":{"type":"constrained"}} -->
			<div class="wp-block-group g2f-project-info">
				<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"inter"} -->
				<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-size:20px;font-style:normal;font-weight:700">Aeroprodukt</h5>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700"}},"textColor":"text-secondary","fontFamily":"inter"} -->
				<p class="has-text-align-center has-text-secondary-color has-text-color has-inter-font-family" style="font-size:16px;font-style:normal;font-weight:700">Visual identity - Branding</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-card","layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group g2f-project-card" data-category="ux-ui">
			<!-- wp:image {"sizeSlug":"g2f-project","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-g2f-project g2f-project-image" style="border-radius:8px">
				<img src="" alt="Project Name"/>
			</figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"g2f-project-info","layout":{"type":"constrained"}} -->
			<div class="wp-block-group g2f-project-info">
				<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"inter"} -->
				<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-size:20px;font-style:normal;font-weight:700">Project Name</h5>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700"}},"textColor":"text-secondary","fontFamily":"inter"} -->
				<p class="has-text-align-center has-text-secondary-color has-text-color has-inter-font-family" style="font-size:16px;font-style:normal;font-weight:700">Project type</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-card","layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group g2f-project-card" data-category="art-direction">
			<!-- wp:image {"sizeSlug":"g2f-project","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-g2f-project g2f-project-image" style="border-radius:8px">
				<img src="" alt="Medtrend"/>
			</figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"g2f-project-info","layout":{"type":"constrained"}} -->
			<div class="wp-block-group g2f-project-info">
				<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"inter"} -->
				<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-size:20px;font-style:normal;font-weight:700">Medtrend</h5>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700"}},"textColor":"text-secondary","fontFamily":"inter"} -->
				<p class="has-text-align-center has-text-secondary-color has-text-color has-inter-font-family" style="font-size:16px;font-style:normal;font-weight:700">Brochure - Graphic Design</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-card","layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group g2f-project-card" data-category="ux-ui">
			<!-- wp:image {"sizeSlug":"g2f-project","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-g2f-project g2f-project-image" style="border-radius:8px">
				<img src="" alt="Ipari Marketing"/>
			</figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"g2f-project-info","layout":{"type":"constrained"}} -->
			<div class="wp-block-group g2f-project-info">
				<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"inter"} -->
				<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-size:20px;font-style:normal;font-weight:700">Ipari Marketing</h5>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700"}},"textColor":"text-secondary","fontFamily":"inter"} -->
				<p class="has-text-align-center has-text-secondary-color has-text-color has-inter-font-family" style="font-size:16px;font-style:normal;font-weight:700">Website - UX/UI</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"g2f-project-card","layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group g2f-project-card" data-category="photography">
			<!-- wp:image {"sizeSlug":"g2f-project","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
			<figure class="wp-block-image size-g2f-project g2f-project-image" style="border-radius:8px">
				<img src="" alt="Captured in Tones"/>
			</figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"g2f-project-info","layout":{"type":"constrained"}} -->
			<div class="wp-block-group g2f-project-info">
				<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"fontSize":"20px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"inter"} -->
				<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="font-size:20px;font-style:normal;font-weight:700">Captured in Tones</h5>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"700"}},"textColor":"text-secondary","fontFamily":"inter"} -->
				<p class="has-text-align-center has-text-secondary-color has-text-color has-inter-font-family" style="font-size:16px;font-style:normal;font-weight:700">Photography</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"48px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
	<div class="wp-block-group" style="margin-top:48px">

		<!-- wp:group {"style":{"border":{"radius":"100px","width":"1px","style":"solid"},"spacing":{"padding":{"top":"8px","bottom":"8px","left":"24px","right":"24px"}}},"borderColor":"black","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group has-border-color has-black-border-color" style="border-style:solid;border-width:1px;border-radius:100px;padding-top:8px;padding-right:24px;padding-bottom:8px;padding-left:24px">

			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"fontSize":"medium","fontFamily":"inter"} -->
			<p class="has-inter-font-family has-medium-font-size" style="font-style:normal;font-weight:600;line-height:1.2"><a href="#">SEE MORE WORK</a></p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M3.125 10H16.875" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<!-- /wp:html -->

		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->

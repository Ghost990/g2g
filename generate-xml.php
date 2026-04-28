<?php
$xml = '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/1.2/"
>
<channel>
	<title>G2F Design Demo</title>
	<link>http://localhost:8881</link>
	<description>Demo content</description>
	<pubDate>' . gmdate('r') . '</pubDate>
	<language>en-US</language>
	<wp:wxr_version>1.2</wp:wxr_version>
	<wp:base_site_url>http://localhost:8881</wp:base_site_url>
	<wp:base_blog_url>http://localhost:8881</wp:base_blog_url>

	<!-- Terms -->
	<wp:term><wp:term_id>10</wp:term_id><wp:term_taxonomy>project_category</wp:term_taxonomy><wp:term_slug>ux-ui</wp:term_slug><wp:term_name><![CDATA[UX / UI]]></wp:term_name></wp:term>
	<wp:term><wp:term_id>11</wp:term_id><wp:term_taxonomy>project_category</wp:term_taxonomy><wp:term_slug>art-direction</wp:term_slug><wp:term_name><![CDATA[Art Direction]]></wp:term_name></wp:term>
	<wp:term><wp:term_id>12</wp:term_id><wp:term_taxonomy>project_category</wp:term_taxonomy><wp:term_slug>photography</wp:term_slug><wp:term_name><![CDATA[Photography]]></wp:term_name></wp:term>

	<wp:term><wp:term_id>20</wp:term_id><wp:term_taxonomy>project_service</wp:term_taxonomy><wp:term_slug>ux-design</wp:term_slug><wp:term_name><![CDATA[UX Design]]></wp:term_name></wp:term>
	<wp:term><wp:term_id>21</wp:term_id><wp:term_taxonomy>project_service</wp:term_taxonomy><wp:term_slug>art-direction</wp:term_slug><wp:term_name><![CDATA[Art Direction]]></wp:term_name></wp:term>
	<wp:term><wp:term_id>22</wp:term_id><wp:term_taxonomy>project_service</wp:term_taxonomy><wp:term_slug>photography</wp:term_slug><wp:term_name><![CDATA[Photography]]></wp:term_name></wp:term>
';

$post_id = 100;

function add_post($title, $type, $content, $slug='', $meta=array(), $terms=array()) {
	global $xml, $post_id;
	$post_id++;
	if (!$slug) $slug = strtolower(str_replace(' ', '-', $title));
	
	$xml .= "
	<item>
		<title><![CDATA[$title]]></title>
		<link>http://localhost:8881/$slug/</link>
		<pubDate>" . gmdate('r') . "</pubDate>
		<dc:creator><![CDATA[admin]]></dc:creator>
		<description></description>
		<content:encoded><![CDATA[$content]]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>$post_id</wp:post_id>
		<wp:post_date><![CDATA[2025-01-01 00:00:00]]></wp:post_date>
		<wp:post_date_gmt><![CDATA[2025-01-01 00:00:00]]></wp:post_date_gmt>
		<wp:comment_status><![CDATA[closed]]></wp:comment_status>
		<wp:ping_status><![CDATA[closed]]></wp:ping_status>
		<wp:post_name><![CDATA[$slug]]></wp:post_name>
		<wp:status><![CDATA[publish]]></wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type><![CDATA[$type]]></wp:post_type>
		<wp:post_password><![CDATA[]]></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>";
		
	foreach ($meta as $k => $v) {
		$xml .= "
		<wp:postmeta>
			<wp:meta_key><![CDATA[$k]]></wp:meta_key>
			<wp:meta_value><![CDATA[$v]]></wp:meta_value>
		</wp:postmeta>";
	}
	
	foreach ($terms as $tax => $ts) {
		foreach ($ts as $t) {
			$xml .= "
		<category domain=\"$tax\" nicename=\"$t\"><![CDATA[$t]]></category>";
		}
	}
		
	$xml .= "
	</item>";
}

// Pages
add_post('Home', 'page', '
<!-- wp:pattern {"slug":"g2f-theme/hero-section"} /-->
<!-- wp:group {"className":"g2f-content-container","layout":{"type":"default"}} -->
<div class="wp-block-group g2f-content-container">
<!-- wp:pattern {"slug":"g2f-theme/about-section"} /-->
<!-- wp:pattern {"slug":"g2f-theme/services-home"} /-->
<!-- wp:pattern {"slug":"g2f-theme/portfolio-text"} /-->
<!-- wp:pattern {"slug":"g2f-theme/projects-grid"} /-->
<!-- wp:pattern {"slug":"g2f-theme/testimonials"} /-->
<!-- wp:pattern {"slug":"g2f-theme/clients-section"} /-->
</div>
<!-- /wp:group -->');

add_post('About Us', 'page', '
<!-- wp:pattern {"slug":"g2f-theme/hero-banner"} /-->
<!-- wp:group {"className":"g2f-content-container","layout":{"type":"default"}} -->
<div class="wp-block-group g2f-content-container">
<!-- wp:pattern {"slug":"g2f-theme/about-section"} /-->
<!-- wp:pattern {"slug":"g2f-theme/services-home"} /-->
</div>
<!-- /wp:group -->');

add_post('Services', 'page', '
<!-- wp:pattern {"slug":"g2f-theme/hero-banner"} /-->
<!-- wp:group {"className":"g2f-content-container","layout":{"type":"default"}} -->
<div class="wp-block-group g2f-content-container">
<!-- wp:pattern {"slug":"g2f-theme/services-section"} /-->
</div>
<!-- /wp:group -->');

add_post('UX Design', 'page', '
<!-- wp:pattern {"slug":"g2f-theme/hero-banner"} /-->
<!-- wp:group {"className":"g2f-content-container","layout":{"type":"default"}} -->
<div class="wp-block-group g2f-content-container">
<!-- wp:pattern {"slug":"g2f-theme/service-projects-grid"} /-->
</div>
<!-- /wp:group -->', 'ux-design');

add_post('Art Direction', 'page', '
<!-- wp:pattern {"slug":"g2f-theme/hero-banner"} /-->
<!-- wp:group {"className":"g2f-content-container","layout":{"type":"default"}} -->
<div class="wp-block-group g2f-content-container">
<!-- wp:pattern {"slug":"g2f-theme/service-projects-grid"} /-->
</div>
<!-- /wp:group -->', 'art-direction');

add_post('Photography', 'page', '
<!-- wp:pattern {"slug":"g2f-theme/hero-banner"} /-->
<!-- wp:group {"className":"g2f-content-container","layout":{"type":"default"}} -->
<div class="wp-block-group g2f-content-container">
<!-- wp:pattern {"slug":"g2f-theme/service-projects-grid"} /-->
</div>
<!-- /wp:group -->', 'photography');


// Projects
add_post('AsicMinerz', 'project', '<!-- wp:paragraph --><p>This is the amazing project AsicMinerz</p><!-- /wp:paragraph -->', '', [
	'_g2f_client_name' => 'AsicMinerz',
	'_g2f_project_year' => '2025',
	'_g2f_project_role' => 'UX, UI, Web Design',
	'_g2f_project_url' => 'https://asicminerz.com',
	'_g2f_show_homepage' => '1'
], ['project_category' => ['ux-ui'], 'project_service' => ['ux-design']]);

add_post('Aeroprodukt', 'project', '<!-- wp:paragraph --><p>Aeroprodukt Branding</p><!-- /wp:paragraph -->', '', [
	'_g2f_client_name' => 'Aeroprodukt',
	'_g2f_project_year' => '2024',
	'_g2f_project_role' => 'Art Direction',
	'_g2f_show_homepage' => '1'
], ['project_category' => ['art-direction'], 'project_service' => ['art-direction']]);

add_post('Medtrend', 'project', '<!-- wp:paragraph --><p>Medtrend brochure graphics</p><!-- /wp:paragraph -->', '', [
	'_g2f_client_name' => 'Medtrend',
	'_g2f_project_year' => '2023',
	'_g2f_project_role' => 'Brochure Design',
	'_g2f_show_homepage' => '1'
], ['project_category' => ['art-direction'], 'project_service' => ['art-direction']]);

add_post('Ipari Marketing', 'project', '<!-- wp:paragraph --><p>Ipari Marketing amazing digital experience</p><!-- /wp:paragraph -->', '', [
	'_g2f_client_name' => 'Ipari Marketing',
	'_g2f_project_year' => '2024',
	'_g2f_project_role' => 'UX/UI, Development',
	'_g2f_show_homepage' => '1'
], ['project_category' => ['ux-ui'], 'project_service' => ['ux-design']]);

add_post('Captured in Tones', 'project', '<!-- wp:paragraph --><p>Photography portfolio</p><!-- /wp:paragraph -->', '', [
	'_g2f_client_name' => 'Captured in Tones',
	'_g2f_project_year' => '2022',
	'_g2f_project_role' => 'Photography',
	'_g2f_show_homepage' => '1'
], ['project_category' => ['photography'], 'project_service' => ['photography']]);

// Testimonials
add_post('Revitalized my work approach', 'testimonial', 'Lorem ipsum dolor sit amet consectetur eget maecenas sapien fusce egestas', '', [
	'_g2f_testimonial_author' => 'Brian Clark',
	'_g2f_testimonial_position' => 'VP of Marketing at Snapchat'
]);

add_post('Exceptional design quality', 'testimonial', 'Working with G2F Design was a game-changer for our brand. Their attention to detail and creative vision exceeded all expectations.', '', [
	'_g2f_testimonial_author' => 'Sarah Johnson',
	'_g2f_testimonial_position' => 'CEO at TechStart'
]);

add_post('Professional and creative team', 'testimonial', 'The team at G2F Design delivered beyond our expectations. Their creative approach and professional attitude made the entire process seamless.', '', [
	'_g2f_testimonial_author' => 'Michael Chen',
	'_g2f_testimonial_position' => 'Product Director at DesignCo'
]);

$xml .= '
</channel>
</rss>';

file_put_contents('import/g2f-content.xml', $xml);
echo "XML generated successfully!";
?>

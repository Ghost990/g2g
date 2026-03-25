<?php
/**
 * G2F Design Theme Functions
 *
 * @package G2F_Theme
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Setup
 */
function g2f_theme_setup() {
	// Add support for block styles
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Add support for editor styles
	add_theme_support( 'editor-styles' );

	// Add support for post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add support for HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Add support for custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 54,
		'width'       => 106,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Register navigation menus
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'g2f-theme' ),
		'footer'    => __( 'Footer Menu', 'g2f-theme' ),
		'social'    => __( 'Social Links', 'g2f-theme' ),
	) );

	// Add editor styles
	add_editor_style( 'assets/css/editor-style.css' );

	// Load text domain
	load_theme_textdomain( 'g2f-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'g2f_theme_setup' );

/**
 * Enqueue styles and scripts
 */
function g2f_theme_enqueue_assets() {
	// Theme version for cache busting
	$theme_version = wp_get_theme()->get( 'Version' );

	// Custom styles (style.css is auto-enqueued by WordPress FSE system — do not re-enqueue)
	wp_enqueue_style(
		'g2f-theme-custom',
		get_template_directory_uri() . '/assets/css/custom.css',
		array(),
		$theme_version
	);

	// GSAP core
	wp_enqueue_script(
		'gsap',
		'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
		array(),
		'3.12.5',
		true
	);

	// GSAP ScrollTrigger
	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.5',
		true
	);

	// Frontend scripts
	wp_enqueue_script(
		'g2f-theme-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'gsap', 'gsap-scrolltrigger' ),
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'g2f_theme_enqueue_assets' );

/**
 * Enqueue editor assets
 */
function g2f_theme_enqueue_editor_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'g2f-theme-editor',
		get_template_directory_uri() . '/assets/css/editor-style.css',
		array(),
		$theme_version
	);
}
add_action( 'enqueue_block_editor_assets', 'g2f_theme_enqueue_editor_assets' );

/**
 * Register block patterns
 */
function g2f_theme_register_block_patterns() {
	// Register pattern category
	register_block_pattern_category(
		'g2f-theme',
		array(
			'label'       => __( 'G2F Design', 'g2f-theme' ),
			'description' => __( 'Custom patterns for G2F Design theme', 'g2f-theme' ),
		)
	);

	// Helper: register a PHP pattern by executing it and capturing output
	$php_patterns = array(
		'hero-section'          => array( 'title' => 'Hero Section' ),
		'hero-about'            => array( 'title' => 'Hero — About Us' ),
		'hero-service'          => array( 'title' => 'Hero — Service Page' ),
		'hero-banner'           => array( 'title' => 'Hero Banner' ),
		'about-section'         => array( 'title' => 'About Section (Homepage)' ),
		'about-page-intro'      => array( 'title' => 'About Page — Intro' ),
		'about-page-founder'    => array( 'title' => 'About Page — Founder' ),
		'services-section'      => array( 'title' => 'Services Section (Homepage)' ),
		'services-detail-blocks'=> array( 'title' => 'Services Detail Blocks' ),
		'service-projects-grid' => array( 'title' => 'Service Projects Grid (filtered)' ),
		'projects-grid'         => array( 'title' => 'Projects Grid' ),
		'portfolio-text'        => array( 'title' => 'Portfolio Text' ),
		'testimonials'          => array( 'title' => 'Testimonials' ),
		'clients-section'       => array( 'title' => 'Clients Section' ),
		'cta-divider'           => array( 'title' => 'CTA Divider' ),
		'cta-divider-compact'   => array( 'title' => 'CTA Divider — Compact' ),
		'cta-service'           => array( 'title' => 'CTA — Service Pages' ),
		'button-arrow'          => array( 'title' => 'Button Arrow' ),
		'button-arrow-light'    => array( 'title' => 'Button Arrow (Light)' ),
		'project-info'          => array( 'title' => 'Project Info' ),
		'project-sidebar'       => array( 'title' => 'Project Sidebar' ),
		'hero-project'          => array( 'title' => 'Project Hero' ),
		'project-gallery'       => array( 'title' => 'Project Gallery Slider' ),
		'project-view-live'     => array( 'title' => 'Project — View Live Button' ),
	);

	foreach ( $php_patterns as $slug => $args ) {
		$file = get_theme_file_path( "patterns/{$slug}.php" );
		if ( ! file_exists( $file ) ) continue;

		// Save title BEFORE include — pattern files may define $args for WP_Query,
		// which would overwrite the foreach $args variable in shared scope.
		$pattern_title = $args['title'];

		// WP 6.x auto-registers file-header patterns — unregister before re-registering
		unregister_block_pattern( "g2f-theme/{$slug}" );

		ob_start();
		include $file;
		$content = ob_get_clean();

		register_block_pattern(
			"g2f-theme/{$slug}",
			array(
				'title'      => $pattern_title,
				'categories' => array( 'g2f-theme' ),
				'content'    => $content,
			)
		);
	}
}
// Priority 20 — WP auto-registers file-header patterns at priority 9.
// We unregister those first, then re-register with ob_start() so PHP executes.
add_action( 'init', 'g2f_theme_register_block_patterns', 20 );

/**
 * Register block styles
 */
function g2f_theme_register_block_styles() {
	// Button styles
	register_block_style(
		'core/button',
		array(
			'name'  => 'g2f-outline',
			'label' => __( 'G2F Outline', 'g2f-theme' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'g2f-solid',
			'label' => __( 'G2F Solid (fekete)', 'g2f-theme' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'g2f-outline-white',
			'label' => __( 'G2F Outline White', 'g2f-theme' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'g2f-solid-white',
			'label' => __( 'G2F Solid White', 'g2f-theme' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'g2f-ghost',
			'label' => __( 'G2F Ghost', 'g2f-theme' ),
		)
	);

	// Image styles
	register_block_style(
		'core/image',
		array(
			'name'  => 'g2f-rounded',
			'label' => __( 'G2F Rounded', 'g2f-theme' ),
		)
	);

	// Group styles
	register_block_style(
		'core/group',
		array(
			'name'  => 'g2f-section',
			'label' => __( 'G2F Section', 'g2f-theme' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'g2f-card',
			'label' => __( 'G2F Card', 'g2f-theme' ),
		)
	);
}
add_action( 'init', 'g2f_theme_register_block_styles' );

/**
 * Add custom image sizes
 */
function g2f_theme_add_image_sizes() {
	add_image_size( 'g2f-hero', 1688, 868, true );
	add_image_size( 'g2f-service', 609, 500, true );
	add_image_size( 'g2f-about', 490, 601, true );
	add_image_size( 'g2f-project', 386, 316, true );
	add_image_size( 'g2f-avatar', 64, 64, true );
}
add_action( 'after_setup_theme', 'g2f_theme_add_image_sizes' );

/**
 * Make custom image sizes selectable
 */
function g2f_theme_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'g2f-hero'    => __( 'G2F Hero', 'g2f-theme' ),
		'g2f-service' => __( 'G2F Service', 'g2f-theme' ),
		'g2f-about'   => __( 'G2F About', 'g2f-theme' ),
		'g2f-project' => __( 'G2F Project', 'g2f-theme' ),
		'g2f-avatar'  => __( 'G2F Avatar', 'g2f-theme' ),
	) );
}
add_filter( 'image_size_names_choose', 'g2f_theme_custom_image_sizes' );

/**
 * Disable WordPress emoji scripts
 */
function g2f_theme_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'g2f_theme_disable_emojis' );

/**
 * Add theme color to head
 */
function g2f_theme_add_theme_color() {
	echo '<meta name="theme-color" content="#000000">' . "\n";
}
add_action( 'wp_head', 'g2f_theme_add_theme_color', 1 );


/**
 * Register Project custom post type, taxonomies, Testimonial CPT
 */
function g2f_register_project_cpt() {

	// Project CPT
	register_post_type( 'project', array(
		'labels' => array(
			'name'          => __( 'Projects', 'g2f-theme' ),
			'singular_name' => __( 'Project', 'g2f-theme' ),
			'add_new_item'  => __( 'Add New Project', 'g2f-theme' ),
			'edit_item'     => __( 'Edit Project', 'g2f-theme' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'menu_icon'    => 'dashicons-portfolio',
		'menu_position' => 5,
		'rewrite'      => array( 'slug' => 'projects' ),
	) );

	// Project Category Taxonomy (hierarchical)
	register_taxonomy( 'project_category', 'project', array(
		'labels' => array(
			'name'          => __( 'Project Categories', 'g2f-theme' ),
			'singular_name' => __( 'Project Category', 'g2f-theme' ),
		),
		'public'       => true,
		'show_in_rest' => true,
		'hierarchical' => true,
		'rewrite'      => array( 'slug' => 'project-category' ),
	) );

	// Project Service Taxonomy (flat — for service sub-page filtering)
	// Terms: ux-design, art-direction, photography
	register_taxonomy( 'project_service', 'project', array(
		'labels' => array(
			'name'          => __( 'Services', 'g2f-theme' ),
			'singular_name' => __( 'Service', 'g2f-theme' ),
		),
		'public'       => true,
		'show_in_rest' => true,
		'hierarchical' => false,
		'rewrite'      => array( 'slug' => 'service' ),
	) );

	// Testimonial CPT (private, for dynamic testimonials block)
	register_post_type( 'testimonial', array(
		'labels' => array(
			'name'          => __( 'Testimonials', 'g2f-theme' ),
			'singular_name' => __( 'Testimonial', 'g2f-theme' ),
			'add_new_item'  => __( 'Add Testimonial', 'g2f-theme' ),
		),
		'public'       => false,
		'show_ui'      => true,
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'custom-fields' ),
		'menu_icon'    => 'dashicons-format-quote',
		'menu_position' => 6,
	) );
}
add_action( 'init', 'g2f_register_project_cpt' );

/**
 * Register project and testimonial custom meta fields
 */
function g2f_register_meta_fields() {
	$project_fields = array(
		'_g2f_client_name'   => array( 'type' => 'string',  'cb' => 'sanitize_text_field' ),
		'_g2f_project_year'  => array( 'type' => 'string',  'cb' => 'sanitize_text_field' ),
		'_g2f_project_role'  => array( 'type' => 'string',  'cb' => 'sanitize_text_field' ),
		'_g2f_project_url'   => array( 'type' => 'string',  'cb' => 'esc_url_raw' ),
		'_g2f_show_homepage' => array( 'type' => 'boolean', 'cb' => 'rest_sanitize_boolean' ),
	);
	foreach ( $project_fields as $key => $args ) {
		register_post_meta( 'project', $key, array(
			'single'            => true,
			'type'              => $args['type'],
			'sanitize_callback' => $args['cb'],
			'show_in_rest'      => true,
			'default'           => $args['type'] === 'boolean' ? true : '',
		) );
	}
	register_post_meta( 'testimonial', '_g2f_testimonial_author', array( 'single' => true, 'type' => 'string', 'sanitize_callback' => 'sanitize_text_field', 'show_in_rest' => true ) );
	register_post_meta( 'testimonial', '_g2f_testimonial_role',   array( 'single' => true, 'type' => 'string', 'sanitize_callback' => 'sanitize_text_field', 'show_in_rest' => true ) );
}
add_action( 'init', 'g2f_register_meta_fields' );

/**
 * Meta boxes for project info and testimonial author
 */
function g2f_add_meta_boxes() {
	add_meta_box( 'g2f_project_info',      __( 'Project Info', 'g2f-theme' ), 'g2f_project_info_meta_box',      'project',     'side', 'high' );
	add_meta_box( 'g2f_project_gallery',   __( 'Project Gallery', 'g2f-theme' ), 'g2f_project_gallery_meta_box', 'project',   'normal', 'high' );
	add_meta_box( 'g2f_testimonial_info',  __( 'Author Info', 'g2f-theme' ),  'g2f_testimonial_info_meta_box',  'testimonial', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'g2f_add_meta_boxes' );

function g2f_project_info_meta_box( $post ) {
	wp_nonce_field( 'g2f_project_meta', 'g2f_project_nonce' );
	$fields = array( '_g2f_client_name' => 'Client', '_g2f_project_year' => 'Year', '_g2f_project_role' => 'Role / Deliverable', '_g2f_project_url' => 'Live URL' );
	foreach ( $fields as $key => $label ) {
		$val = get_post_meta( $post->ID, $key, true );
		$type = $key === '_g2f_project_url' ? 'url' : 'text';
		echo "<p><label>{$label}<br><input type='{$type}' name='{$key}' value='" . esc_attr( $val ) . "' style='width:100%'></label></p>";
	}
	$show = get_post_meta( $post->ID, '_g2f_show_homepage', true );
	$show = $show === '' ? true : (bool) $show;
	echo '<p><label><input type="checkbox" name="_g2f_show_homepage" value="1" ' . checked( $show, true, false ) . '> Show on homepage</label></p>';
}

function g2f_project_gallery_meta_box( $post ) {
	wp_nonce_field( 'g2f_gallery_meta', 'g2f_gallery_nonce' );
	$gallery_ids = get_post_meta( $post->ID, '_g2f_gallery_ids', true );
	$ids_str     = is_array( $gallery_ids ) ? implode( ',', $gallery_ids ) : '';
	?>
	<style>
	#g2f-gallery-preview { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; min-height:60px; }
	#g2f-gallery-preview .g2f-gallery-thumb { position:relative; width:100px; height:80px; }
	#g2f-gallery-preview .g2f-gallery-thumb img { width:100%; height:100%; object-fit:cover; border-radius:3px; border:1px solid #ddd; }
	#g2f-gallery-preview .g2f-gallery-thumb .remove { position:absolute; top:-6px; right:-6px; background:#cc0000; color:#fff; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer; font-size:12px; line-height:20px; text-align:center; padding:0; }
	.g2f-gallery-btns { display:flex; gap:8px; }
	</style>
	<div id="g2f-gallery-preview">
		<?php if ( $gallery_ids ) : foreach ( $gallery_ids as $img_id ) :
			$src = wp_get_attachment_image_url( $img_id, 'thumbnail' );
			if ( $src ) : ?>
				<div class="g2f-gallery-thumb" data-id="<?php echo $img_id; ?>">
					<img src="<?php echo esc_url( $src ); ?>">
					<button class="remove" type="button" title="Remove">×</button>
				</div>
			<?php endif; endforeach; endif; ?>
	</div>
	<input type="hidden" name="_g2f_gallery_ids" id="g2f-gallery-ids" value="<?php echo esc_attr( $ids_str ); ?>">
	<div class="g2f-gallery-btns">
		<button type="button" id="g2f-gallery-add" class="button">+ Add Images</button>
		<button type="button" id="g2f-gallery-clear" class="button">Clear All</button>
	</div>
	<script>
	jQuery(function($){
		var frame;
		$('#g2f-gallery-add').on('click', function(){
			if (frame) { frame.open(); return; }
			frame = wp.media({ title: 'Select Gallery Images', multiple: true, library: { type: 'image' } });
			frame.on('select', function(){
				var ids = ($('#g2f-gallery-ids').val() ? $('#g2f-gallery-ids').val().split(',') : []);
				frame.state().get('selection').each(function(att){
					var id = att.id, src = att.get('sizes') && att.get('sizes').thumbnail ? att.get('sizes').thumbnail.url : att.get('url');
					if (ids.indexOf(String(id)) === -1) {
						ids.push(id);
						$('#g2f-gallery-preview').append('<div class="g2f-gallery-thumb" data-id="'+id+'"><img src="'+src+'"><button class="remove" type="button" title="Remove">×</button></div>');
					}
				});
				$('#g2f-gallery-ids').val(ids.join(','));
			});
			frame.open();
		});
		$('#g2f-gallery-preview').on('click', '.remove', function(){
			var id = String($(this).closest('.g2f-gallery-thumb').data('id'));
			$(this).closest('.g2f-gallery-thumb').remove();
			var ids = $('#g2f-gallery-ids').val().split(',').filter(function(v){ return v && v !== id; });
			$('#g2f-gallery-ids').val(ids.join(','));
		});
		$('#g2f-gallery-clear').on('click', function(){
			$('#g2f-gallery-preview').empty();
			$('#g2f-gallery-ids').val('');
		});
	});
	</script>
	<?php
}

function g2f_testimonial_info_meta_box( $post ) {
	wp_nonce_field( 'g2f_testimonial_meta', 'g2f_testimonial_nonce' );
	$author = get_post_meta( $post->ID, '_g2f_testimonial_author', true );
	$role   = get_post_meta( $post->ID, '_g2f_testimonial_role', true );
	echo "<p><label>Author Name<br><input type='text' name='_g2f_testimonial_author' value='" . esc_attr( $author ) . "' style='width:100%'></label></p>";
	echo "<p><label>Author Role / Company<br><input type='text' name='_g2f_testimonial_role' value='" . esc_attr( $role ) . "' style='width:100%'></label></p>";
}

function g2f_save_meta_boxes( $post_id ) {
	if ( isset( $_POST['g2f_project_nonce'] ) && wp_verify_nonce( $_POST['g2f_project_nonce'], 'g2f_project_meta' ) ) {
		$string_fields = array( '_g2f_client_name', '_g2f_project_year', '_g2f_project_role' );
		foreach ( $string_fields as $f ) {
			if ( isset( $_POST[ $f ] ) ) update_post_meta( $post_id, $f, sanitize_text_field( $_POST[ $f ] ) );
		}
		if ( isset( $_POST['_g2f_project_url'] ) ) update_post_meta( $post_id, '_g2f_project_url', esc_url_raw( $_POST['_g2f_project_url'] ) );
		update_post_meta( $post_id, '_g2f_show_homepage', isset( $_POST['_g2f_show_homepage'] ) ? true : false );
	}
	if ( isset( $_POST['g2f_gallery_nonce'] ) && wp_verify_nonce( $_POST['g2f_gallery_nonce'], 'g2f_gallery_meta' ) ) {
		$raw = isset( $_POST['_g2f_gallery_ids'] ) ? sanitize_text_field( $_POST['_g2f_gallery_ids'] ) : '';
		$ids = array_filter( array_map( 'absint', explode( ',', $raw ) ) );
		update_post_meta( $post_id, '_g2f_gallery_ids', array_values( $ids ) );
	}
	if ( isset( $_POST['g2f_testimonial_nonce'] ) && wp_verify_nonce( $_POST['g2f_testimonial_nonce'], 'g2f_testimonial_meta' ) ) {
		if ( isset( $_POST['_g2f_testimonial_author'] ) ) update_post_meta( $post_id, '_g2f_testimonial_author', sanitize_text_field( $_POST['_g2f_testimonial_author'] ) );
		if ( isset( $_POST['_g2f_testimonial_role'] ) ) update_post_meta( $post_id, '_g2f_testimonial_role', sanitize_text_field( $_POST['_g2f_testimonial_role'] ) );
	}
}
add_action( 'save_post', 'g2f_save_meta_boxes' );

function g2f_admin_enqueue_media( $hook ) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'g2f_admin_enqueue_media' );

/**
 * Back to top button (injected via wp_footer)
 */
function g2f_back_to_top_button() {
	?>
	<button class="g2f-back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'g2f-theme' ); ?>">
		<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<path d="M10 15V5M10 5L5 10M10 5L15 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</button>
	<?php
}
add_action( 'wp_footer', 'g2f_back_to_top_button' );

/**
 * Polylang: register translatable theme strings
 */
add_action( 'pll_init', function() {
	if ( function_exists( 'pll_register_string' ) ) {
		pll_register_string( 'cta_button',   'Get In Touch',                      'G2F Theme' );
		pll_register_string( 'cta_headline', "Have a project in mind? Let's talk.", 'G2F Theme' );
	}
} );

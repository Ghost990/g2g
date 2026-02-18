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

	// Main stylesheet (already enqueued by block theme)
	wp_enqueue_style(
		'g2f-theme-style',
		get_stylesheet_uri(),
		array(),
		$theme_version
	);

	// Custom styles
	wp_enqueue_style(
		'g2f-theme-custom',
		get_template_directory_uri() . '/assets/css/custom.css',
		array( 'g2f-theme-style' ),
		$theme_version
	);

	// Frontend scripts
	wp_enqueue_script(
		'g2f-theme-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
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
}
add_action( 'init', 'g2f_theme_register_block_patterns' );

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
			'label' => __( 'G2F Solid', 'g2f-theme' ),
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
 * Add preconnect for Google Fonts fallback
 */
function g2f_theme_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
			'crossorigin',
		);
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'g2f_theme_resource_hints', 10, 2 );

/**
 * Add theme color to head
 */
function g2f_theme_add_theme_color() {
	echo '<meta name="theme-color" content="#000000">' . "\n";
}
add_action( 'wp_head', 'g2f_theme_add_theme_color', 1 );

/**
 * Register custom arrow icon library for The Icon Block plugin
 *
 * This allows SVG arrows to render properly in the WordPress editor.
 * Requires "The Icon Block" plugin: https://wordpress.org/plugins/icon-block/
 */
function g2f_theme_register_icon_library( $libraries ) {
	$libraries['g2f-arrows'] = array(
		'name'  => __( 'G2F Arrows', 'g2f-theme' ),
		'icons' => array(
			array(
				'name' => 'arrow-right-black',
				'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			),
			array(
				'name' => 'arrow-right-white',
				'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			),
		),
	);
	return $libraries;
}
add_filter( 'icon_block_libraries', 'g2f_theme_register_icon_library' );

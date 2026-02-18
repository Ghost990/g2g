<?php
/**
 * Plugin Name: G2F Functionality
 * Plugin URI: https://g2fdesign.com
 * Description: Functionality plugin for G2F Design theme - Custom Post Types, Taxonomies, and Gutenberg Blocks.
 * Version: 1.0.0
 * Requires at least: 6.4
 * Requires PHP: 8.0
 * Author: G2F Design
 * Author URI: https://g2fdesign.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: g2f-functionality
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Constants
 */
define( 'G2F_FUNCTIONALITY_VERSION', '1.0.0' );
define( 'G2F_FUNCTIONALITY_PATH', plugin_dir_path( __FILE__ ) );
define( 'G2F_FUNCTIONALITY_URL', plugin_dir_url( __FILE__ ) );

/**
 * Main Plugin Class
 */
class G2F_Functionality {

	/**
	 * Instance
	 *
	 * @var G2F_Functionality
	 */
	private static $instance = null;

	/**
	 * Get Instance
	 *
	 * @return G2F_Functionality
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Include required files
	 */
	private function includes() {
		// Post Types
		require_once G2F_FUNCTIONALITY_PATH . 'includes/post-types/projects.php';
		require_once G2F_FUNCTIONALITY_PATH . 'includes/post-types/testimonials.php';
		require_once G2F_FUNCTIONALITY_PATH . 'includes/post-types/clients.php';

		// Taxonomies
		require_once G2F_FUNCTIONALITY_PATH . 'includes/taxonomies/project-category.php';

		// Admin
		if ( is_admin() ) {
			require_once G2F_FUNCTIONALITY_PATH . 'includes/admin/settings.php';
		}
	}

	/**
	 * Initialize hooks
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
		add_action( 'after_setup_theme', array( $this, 'add_image_sizes' ) );

		// Register REST API endpoints
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * Load text domain
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'g2f-functionality',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}

	/**
	 * Register custom Gutenberg blocks
	 */
	public function register_blocks() {
		// Project Grid Block
		register_block_type( G2F_FUNCTIONALITY_PATH . 'includes/blocks/project-grid' );

		// Testimonial Slider Block
		register_block_type( G2F_FUNCTIONALITY_PATH . 'includes/blocks/testimonial-slider' );

		// Client Marquee Block
		register_block_type( G2F_FUNCTIONALITY_PATH . 'includes/blocks/client-marquee' );
	}

	/**
	 * Enqueue frontend assets
	 */
	public function enqueue_frontend_assets() {
		wp_enqueue_style(
			'g2f-functionality-blocks',
			G2F_FUNCTIONALITY_URL . 'assets/css/blocks.css',
			array(),
			G2F_FUNCTIONALITY_VERSION
		);

		wp_enqueue_script(
			'g2f-functionality-blocks',
			G2F_FUNCTIONALITY_URL . 'assets/js/blocks.js',
			array(),
			G2F_FUNCTIONALITY_VERSION,
			true
		);

		// Pass data to JS
		wp_localize_script(
			'g2f-functionality-blocks',
			'g2fFunctionality',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'g2f_functionality_nonce' ),
				'restUrl' => rest_url( 'g2f/v1/' ),
			)
		);
	}

	/**
	 * Enqueue editor assets
	 */
	public function enqueue_editor_assets() {
		wp_enqueue_style(
			'g2f-functionality-editor',
			G2F_FUNCTIONALITY_URL . 'assets/css/editor.css',
			array(),
			G2F_FUNCTIONALITY_VERSION
		);
	}

	/**
	 * Add custom image sizes
	 */
	public function add_image_sizes() {
		add_image_size( 'g2f-client-logo', 200, 50, false );
	}

	/**
	 * Register REST API routes
	 */
	public function register_rest_routes() {
		// Projects endpoint
		register_rest_route(
			'g2f/v1',
			'/projects',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_projects' ),
				'permission_callback' => '__return_true',
				'args'                => array(
					'category' => array(
						'type'              => 'string',
						'sanitize_callback' => 'sanitize_text_field',
					),
					'per_page' => array(
						'type'              => 'integer',
						'default'           => 6,
						'sanitize_callback' => 'absint',
					),
				),
			)
		);

		// Testimonials endpoint
		register_rest_route(
			'g2f/v1',
			'/testimonials',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_testimonials' ),
				'permission_callback' => '__return_true',
				'args'                => array(
					'per_page' => array(
						'type'              => 'integer',
						'default'           => 5,
						'sanitize_callback' => 'absint',
					),
				),
			)
		);

		// Clients endpoint
		register_rest_route(
			'g2f/v1',
			'/clients',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'get_clients' ),
				'permission_callback' => '__return_true',
				'args'                => array(
					'per_page' => array(
						'type'              => 'integer',
						'default'           => 20,
						'sanitize_callback' => 'absint',
					),
				),
			)
		);
	}

	/**
	 * Get projects for REST API
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response
	 */
	public function get_projects( $request ) {
		$args = array(
			'post_type'      => 'project',
			'posts_per_page' => $request->get_param( 'per_page' ),
			'post_status'    => 'publish',
		);

		$category = $request->get_param( 'category' );
		if ( $category && 'all' !== $category ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'project_category',
					'field'    => 'slug',
					'terms'    => $category,
				),
			);
		}

		$query    = new WP_Query( $args );
		$projects = array();

		foreach ( $query->posts as $post ) {
			$categories = wp_get_post_terms( $post->ID, 'project_category', array( 'fields' => 'names' ) );

			$projects[] = array(
				'id'          => $post->ID,
				'title'       => $post->post_title,
				'slug'        => $post->post_name,
				'link'        => get_permalink( $post->ID ),
				'excerpt'     => $post->post_excerpt,
				'image'       => get_the_post_thumbnail_url( $post->ID, 'g2f-project' ),
				'categories'  => $categories,
				'category'    => ! empty( $categories ) ? $categories[0] : '',
			);
		}

		return rest_ensure_response( $projects );
	}

	/**
	 * Get testimonials for REST API
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response
	 */
	public function get_testimonials( $request ) {
		$args = array(
			'post_type'      => 'testimonial',
			'posts_per_page' => $request->get_param( 'per_page' ),
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		);

		$query        = new WP_Query( $args );
		$testimonials = array();

		foreach ( $query->posts as $post ) {
			$testimonials[] = array(
				'id'      => $post->ID,
				'quote'   => get_post_meta( $post->ID, '_g2f_testimonial_quote', true ) ?: $post->post_title,
				'content' => $post->post_content,
				'name'    => get_post_meta( $post->ID, '_g2f_testimonial_name', true ),
				'role'    => get_post_meta( $post->ID, '_g2f_testimonial_role', true ),
				'company' => get_post_meta( $post->ID, '_g2f_testimonial_company', true ),
				'avatar'  => get_the_post_thumbnail_url( $post->ID, 'g2f-avatar' ),
			);
		}

		return rest_ensure_response( $testimonials );
	}

	/**
	 * Get clients for REST API
	 *
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response
	 */
	public function get_clients( $request ) {
		$args = array(
			'post_type'      => 'client',
			'posts_per_page' => $request->get_param( 'per_page' ),
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		);

		$query   = new WP_Query( $args );
		$clients = array();

		foreach ( $query->posts as $post ) {
			$clients[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title,
				'logo' => get_the_post_thumbnail_url( $post->ID, 'g2f-client-logo' ),
				'url'  => get_post_meta( $post->ID, '_g2f_client_url', true ),
			);
		}

		return rest_ensure_response( $clients );
	}
}

/**
 * Initialize the plugin
 */
function g2f_functionality_init() {
	return G2F_Functionality::get_instance();
}
add_action( 'plugins_loaded', 'g2f_functionality_init' );

/**
 * Activation hook
 */
function g2f_functionality_activate() {
	// Require post type files
	require_once plugin_dir_path( __FILE__ ) . 'includes/post-types/projects.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/post-types/testimonials.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/post-types/clients.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/taxonomies/project-category.php';

	// Flush rewrite rules
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'g2f_functionality_activate' );

/**
 * Deactivation hook
 */
function g2f_functionality_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'g2f_functionality_deactivate' );

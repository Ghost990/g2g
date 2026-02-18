<?php
/**
 * Project Category Taxonomy
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Project Category Taxonomy
 */
function g2f_register_project_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Project Categories', 'Taxonomy general name', 'g2f-functionality' ),
		'singular_name'              => _x( 'Project Category', 'Taxonomy singular name', 'g2f-functionality' ),
		'search_items'               => __( 'Search Project Categories', 'g2f-functionality' ),
		'popular_items'              => __( 'Popular Project Categories', 'g2f-functionality' ),
		'all_items'                  => __( 'All Project Categories', 'g2f-functionality' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Project Category', 'g2f-functionality' ),
		'update_item'                => __( 'Update Project Category', 'g2f-functionality' ),
		'add_new_item'               => __( 'Add New Project Category', 'g2f-functionality' ),
		'new_item_name'              => __( 'New Project Category Name', 'g2f-functionality' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'g2f-functionality' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'g2f-functionality' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'g2f-functionality' ),
		'not_found'                  => __( 'No categories found.', 'g2f-functionality' ),
		'menu_name'                  => __( 'Categories', 'g2f-functionality' ),
		'back_to_items'              => __( '&larr; Back to Categories', 'g2f-functionality' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'project-category' ),
		'show_in_rest'          => true,
		'rest_base'             => 'project-categories',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	);

	register_taxonomy( 'project_category', array( 'project' ), $args );
}
add_action( 'init', 'g2f_register_project_category_taxonomy' );

/**
 * Add default project categories on activation
 */
function g2f_add_default_project_categories() {
	$default_categories = array(
		'ux-ui'         => __( 'UX/UI', 'g2f-functionality' ),
		'art-direction' => __( 'Art Direction', 'g2f-functionality' ),
		'photography'   => __( 'Photography', 'g2f-functionality' ),
		'branding'      => __( 'Branding', 'g2f-functionality' ),
		'graphic-design'=> __( 'Graphic Design', 'g2f-functionality' ),
		'web-design'    => __( 'Web Design', 'g2f-functionality' ),
	);

	foreach ( $default_categories as $slug => $name ) {
		if ( ! term_exists( $slug, 'project_category' ) ) {
			wp_insert_term(
				$name,
				'project_category',
				array( 'slug' => $slug )
			);
		}
	}
}
add_action( 'g2f_functionality_activate', 'g2f_add_default_project_categories' );

// Also run on init to ensure categories exist
add_action( 'init', 'g2f_add_default_project_categories', 20 );

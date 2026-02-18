<?php
/**
 * Projects Custom Post Type
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Projects CPT
 */
function g2f_register_projects_cpt() {
	$labels = array(
		'name'                  => _x( 'Projects', 'Post type general name', 'g2f-functionality' ),
		'singular_name'         => _x( 'Project', 'Post type singular name', 'g2f-functionality' ),
		'menu_name'             => _x( 'Projects', 'Admin Menu text', 'g2f-functionality' ),
		'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'g2f-functionality' ),
		'add_new'               => __( 'Add New', 'g2f-functionality' ),
		'add_new_item'          => __( 'Add New Project', 'g2f-functionality' ),
		'new_item'              => __( 'New Project', 'g2f-functionality' ),
		'edit_item'             => __( 'Edit Project', 'g2f-functionality' ),
		'view_item'             => __( 'View Project', 'g2f-functionality' ),
		'all_items'             => __( 'All Projects', 'g2f-functionality' ),
		'search_items'          => __( 'Search Projects', 'g2f-functionality' ),
		'parent_item_colon'     => __( 'Parent Projects:', 'g2f-functionality' ),
		'not_found'             => __( 'No projects found.', 'g2f-functionality' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'g2f-functionality' ),
		'featured_image'        => _x( 'Project Cover Image', 'Overrides the "Featured Image" phrase', 'g2f-functionality' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'g2f-functionality' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'g2f-functionality' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'g2f-functionality' ),
		'archives'              => _x( 'Project archives', 'The post type archive label', 'g2f-functionality' ),
		'insert_into_item'      => _x( 'Insert into project', 'Overrides the "Insert into post" phrase', 'g2f-functionality' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this project', 'Overrides the "Uploaded to this post" phrase', 'g2f-functionality' ),
		'filter_items_list'     => _x( 'Filter projects list', 'Screen reader text', 'g2f-functionality' ),
		'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text', 'g2f-functionality' ),
		'items_list'            => _x( 'Projects list', 'Screen reader text', 'g2f-functionality' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'project' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
		'template'           => array(
			array( 'core/paragraph', array( 'placeholder' => 'Add project description...' ) ),
		),
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'g2f_register_projects_cpt' );

/**
 * Add custom meta boxes for Projects
 */
function g2f_add_project_meta_boxes() {
	add_meta_box(
		'g2f_project_details',
		__( 'Project Details', 'g2f-functionality' ),
		'g2f_project_details_callback',
		'project',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'g2f_add_project_meta_boxes' );

/**
 * Project details meta box callback
 *
 * @param WP_Post $post Post object.
 */
function g2f_project_details_callback( $post ) {
	wp_nonce_field( 'g2f_project_details', 'g2f_project_details_nonce' );

	$client = get_post_meta( $post->ID, '_g2f_project_client', true );
	$date   = get_post_meta( $post->ID, '_g2f_project_date', true );
	$url    = get_post_meta( $post->ID, '_g2f_project_url', true );
	?>
	<p>
		<label for="g2f_project_client"><?php esc_html_e( 'Client Name', 'g2f-functionality' ); ?></label>
		<input type="text" id="g2f_project_client" name="g2f_project_client" value="<?php echo esc_attr( $client ); ?>" class="widefat">
	</p>
	<p>
		<label for="g2f_project_date"><?php esc_html_e( 'Project Date', 'g2f-functionality' ); ?></label>
		<input type="date" id="g2f_project_date" name="g2f_project_date" value="<?php echo esc_attr( $date ); ?>" class="widefat">
	</p>
	<p>
		<label for="g2f_project_url"><?php esc_html_e( 'Project URL', 'g2f-functionality' ); ?></label>
		<input type="url" id="g2f_project_url" name="g2f_project_url" value="<?php echo esc_url( $url ); ?>" class="widefat" placeholder="https://">
	</p>
	<?php
}

/**
 * Save project meta
 *
 * @param int $post_id Post ID.
 */
function g2f_save_project_meta( $post_id ) {
	if ( ! isset( $_POST['g2f_project_details_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['g2f_project_details_nonce'], 'g2f_project_details' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['g2f_project_client'] ) ) {
		update_post_meta( $post_id, '_g2f_project_client', sanitize_text_field( $_POST['g2f_project_client'] ) );
	}

	if ( isset( $_POST['g2f_project_date'] ) ) {
		update_post_meta( $post_id, '_g2f_project_date', sanitize_text_field( $_POST['g2f_project_date'] ) );
	}

	if ( isset( $_POST['g2f_project_url'] ) ) {
		update_post_meta( $post_id, '_g2f_project_url', esc_url_raw( $_POST['g2f_project_url'] ) );
	}
}
add_action( 'save_post_project', 'g2f_save_project_meta' );

/**
 * Add custom columns to Projects list
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function g2f_project_columns( $columns ) {
	$new_columns = array();

	foreach ( $columns as $key => $value ) {
		if ( 'title' === $key ) {
			$new_columns[ $key ]       = $value;
			$new_columns['thumbnail']  = __( 'Image', 'g2f-functionality' );
			$new_columns['category']   = __( 'Category', 'g2f-functionality' );
		} else {
			$new_columns[ $key ] = $value;
		}
	}

	return $new_columns;
}
add_filter( 'manage_project_posts_columns', 'g2f_project_columns' );

/**
 * Populate custom columns
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function g2f_project_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'thumbnail':
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array( 60, 60 ) );
			} else {
				echo '—';
			}
			break;

		case 'category':
			$terms = wp_get_post_terms( $post_id, 'project_category', array( 'fields' => 'names' ) );
			echo ! empty( $terms ) ? esc_html( implode( ', ', $terms ) ) : '—';
			break;
	}
}
add_action( 'manage_project_posts_custom_column', 'g2f_project_column_content', 10, 2 );

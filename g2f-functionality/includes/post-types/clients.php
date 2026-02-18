<?php
/**
 * Clients Custom Post Type
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Clients CPT
 */
function g2f_register_clients_cpt() {
	$labels = array(
		'name'                  => _x( 'Clients', 'Post type general name', 'g2f-functionality' ),
		'singular_name'         => _x( 'Client', 'Post type singular name', 'g2f-functionality' ),
		'menu_name'             => _x( 'Clients', 'Admin Menu text', 'g2f-functionality' ),
		'name_admin_bar'        => _x( 'Client', 'Add New on Toolbar', 'g2f-functionality' ),
		'add_new'               => __( 'Add New', 'g2f-functionality' ),
		'add_new_item'          => __( 'Add New Client', 'g2f-functionality' ),
		'new_item'              => __( 'New Client', 'g2f-functionality' ),
		'edit_item'             => __( 'Edit Client', 'g2f-functionality' ),
		'view_item'             => __( 'View Client', 'g2f-functionality' ),
		'all_items'             => __( 'All Clients', 'g2f-functionality' ),
		'search_items'          => __( 'Search Clients', 'g2f-functionality' ),
		'not_found'             => __( 'No clients found.', 'g2f-functionality' ),
		'not_found_in_trash'    => __( 'No clients found in Trash.', 'g2f-functionality' ),
		'featured_image'        => _x( 'Client Logo', 'Overrides the "Featured Image" phrase', 'g2f-functionality' ),
		'set_featured_image'    => _x( 'Set logo', 'Overrides the "Set featured image" phrase', 'g2f-functionality' ),
		'remove_featured_image' => _x( 'Remove logo', 'Overrides the "Remove featured image" phrase', 'g2f-functionality' ),
		'use_featured_image'    => _x( 'Use as logo', 'Overrides the "Use as featured image" phrase', 'g2f-functionality' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-building',
		'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'client', $args );
}
add_action( 'init', 'g2f_register_clients_cpt' );

/**
 * Add custom meta boxes for Clients
 */
function g2f_add_client_meta_boxes() {
	add_meta_box(
		'g2f_client_details',
		__( 'Client Details', 'g2f-functionality' ),
		'g2f_client_details_callback',
		'client',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'g2f_add_client_meta_boxes' );

/**
 * Client details meta box callback
 *
 * @param WP_Post $post Post object.
 */
function g2f_client_details_callback( $post ) {
	wp_nonce_field( 'g2f_client_details', 'g2f_client_details_nonce' );

	$url = get_post_meta( $post->ID, '_g2f_client_url', true );
	?>
	<p>
		<label for="g2f_client_url"><?php esc_html_e( 'Client Website URL', 'g2f-functionality' ); ?></label>
		<input type="url" id="g2f_client_url" name="g2f_client_url" value="<?php echo esc_url( $url ); ?>" class="widefat" placeholder="https://">
	</p>
	<p class="description"><?php esc_html_e( 'Optional: Link to client website', 'g2f-functionality' ); ?></p>
	<?php
}

/**
 * Save client meta
 *
 * @param int $post_id Post ID.
 */
function g2f_save_client_meta( $post_id ) {
	if ( ! isset( $_POST['g2f_client_details_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['g2f_client_details_nonce'], 'g2f_client_details' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['g2f_client_url'] ) ) {
		update_post_meta( $post_id, '_g2f_client_url', esc_url_raw( $_POST['g2f_client_url'] ) );
	}
}
add_action( 'save_post_client', 'g2f_save_client_meta' );

/**
 * Add custom columns to Clients list
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function g2f_client_columns( $columns ) {
	$new_columns = array(
		'cb'    => $columns['cb'],
		'logo'  => __( 'Logo', 'g2f-functionality' ),
		'title' => $columns['title'],
		'url'   => __( 'Website', 'g2f-functionality' ),
		'date'  => $columns['date'],
	);

	return $new_columns;
}
add_filter( 'manage_client_posts_columns', 'g2f_client_columns' );

/**
 * Populate custom columns
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function g2f_client_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'logo':
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array( 100, 50 ), array( 'style' => 'max-height: 30px; width: auto;' ) );
			} else {
				echo '—';
			}
			break;

		case 'url':
			$url = get_post_meta( $post_id, '_g2f_client_url', true );
			if ( $url ) {
				printf(
					'<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
					esc_url( $url ),
					esc_html( parse_url( $url, PHP_URL_HOST ) )
				);
			} else {
				echo '—';
			}
			break;
	}
}
add_action( 'manage_client_posts_custom_column', 'g2f_client_column_content', 10, 2 );

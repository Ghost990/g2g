<?php
/**
 * Testimonials Custom Post Type
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Testimonials CPT
 */
function g2f_register_testimonials_cpt() {
	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post type general name', 'g2f-functionality' ),
		'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'g2f-functionality' ),
		'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'g2f-functionality' ),
		'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'g2f-functionality' ),
		'add_new'               => __( 'Add New', 'g2f-functionality' ),
		'add_new_item'          => __( 'Add New Testimonial', 'g2f-functionality' ),
		'new_item'              => __( 'New Testimonial', 'g2f-functionality' ),
		'edit_item'             => __( 'Edit Testimonial', 'g2f-functionality' ),
		'view_item'             => __( 'View Testimonial', 'g2f-functionality' ),
		'all_items'             => __( 'All Testimonials', 'g2f-functionality' ),
		'search_items'          => __( 'Search Testimonials', 'g2f-functionality' ),
		'not_found'             => __( 'No testimonials found.', 'g2f-functionality' ),
		'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'g2f-functionality' ),
		'featured_image'        => _x( 'Avatar', 'Overrides the "Featured Image" phrase', 'g2f-functionality' ),
		'set_featured_image'    => _x( 'Set avatar', 'Overrides the "Set featured image" phrase', 'g2f-functionality' ),
		'remove_featured_image' => _x( 'Remove avatar', 'Overrides the "Remove featured image" phrase', 'g2f-functionality' ),
		'use_featured_image'    => _x( 'Use as avatar', 'Overrides the "Use as featured image" phrase', 'g2f-functionality' ),
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
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-format-quote',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'g2f_register_testimonials_cpt' );

/**
 * Add custom meta boxes for Testimonials
 */
function g2f_add_testimonial_meta_boxes() {
	add_meta_box(
		'g2f_testimonial_details',
		__( 'Testimonial Details', 'g2f-functionality' ),
		'g2f_testimonial_details_callback',
		'testimonial',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'g2f_add_testimonial_meta_boxes' );

/**
 * Testimonial details meta box callback
 *
 * @param WP_Post $post Post object.
 */
function g2f_testimonial_details_callback( $post ) {
	wp_nonce_field( 'g2f_testimonial_details', 'g2f_testimonial_details_nonce' );

	$quote   = get_post_meta( $post->ID, '_g2f_testimonial_quote', true );
	$name    = get_post_meta( $post->ID, '_g2f_testimonial_name', true );
	$role    = get_post_meta( $post->ID, '_g2f_testimonial_role', true );
	$company = get_post_meta( $post->ID, '_g2f_testimonial_company', true );
	?>
	<table class="form-table">
		<tr>
			<th scope="row">
				<label for="g2f_testimonial_quote"><?php esc_html_e( 'Quote Headline', 'g2f-functionality' ); ?></label>
			</th>
			<td>
				<input type="text" id="g2f_testimonial_quote" name="g2f_testimonial_quote" value="<?php echo esc_attr( $quote ); ?>" class="regular-text">
				<p class="description"><?php esc_html_e( 'Short quote headline (e.g., "Revitalized my work approach")', 'g2f-functionality' ); ?></p>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="g2f_testimonial_name"><?php esc_html_e( 'Name', 'g2f-functionality' ); ?></label>
			</th>
			<td>
				<input type="text" id="g2f_testimonial_name" name="g2f_testimonial_name" value="<?php echo esc_attr( $name ); ?>" class="regular-text">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="g2f_testimonial_role"><?php esc_html_e( 'Role / Job Title', 'g2f-functionality' ); ?></label>
			</th>
			<td>
				<input type="text" id="g2f_testimonial_role" name="g2f_testimonial_role" value="<?php echo esc_attr( $role ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g., VP of Marketing', 'g2f-functionality' ); ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="g2f_testimonial_company"><?php esc_html_e( 'Company', 'g2f-functionality' ); ?></label>
			</th>
			<td>
				<input type="text" id="g2f_testimonial_company" name="g2f_testimonial_company" value="<?php echo esc_attr( $company ); ?>" class="regular-text">
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save testimonial meta
 *
 * @param int $post_id Post ID.
 */
function g2f_save_testimonial_meta( $post_id ) {
	if ( ! isset( $_POST['g2f_testimonial_details_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['g2f_testimonial_details_nonce'], 'g2f_testimonial_details' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array( 'quote', 'name', 'role', 'company' );

	foreach ( $fields as $field ) {
		$key = 'g2f_testimonial_' . $field;
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, '_' . $key, sanitize_text_field( $_POST[ $key ] ) );
		}
	}
}
add_action( 'save_post_testimonial', 'g2f_save_testimonial_meta' );

/**
 * Add custom columns to Testimonials list
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function g2f_testimonial_columns( $columns ) {
	$new_columns = array(
		'cb'      => $columns['cb'],
		'avatar'  => __( 'Avatar', 'g2f-functionality' ),
		'title'   => $columns['title'],
		'name'    => __( 'Name', 'g2f-functionality' ),
		'company' => __( 'Company', 'g2f-functionality' ),
		'date'    => $columns['date'],
	);

	return $new_columns;
}
add_filter( 'manage_testimonial_posts_columns', 'g2f_testimonial_columns' );

/**
 * Populate custom columns
 *
 * @param string $column  Column name.
 * @param int    $post_id Post ID.
 */
function g2f_testimonial_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'avatar':
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array( 40, 40 ), array( 'style' => 'border-radius: 50%;' ) );
			} else {
				echo '—';
			}
			break;

		case 'name':
			$name = get_post_meta( $post_id, '_g2f_testimonial_name', true );
			echo $name ? esc_html( $name ) : '—';
			break;

		case 'company':
			$role    = get_post_meta( $post_id, '_g2f_testimonial_role', true );
			$company = get_post_meta( $post_id, '_g2f_testimonial_company', true );
			$output  = array();

			if ( $role ) {
				$output[] = $role;
			}
			if ( $company ) {
				$output[] = $company;
			}

			echo ! empty( $output ) ? esc_html( implode( ' at ', $output ) ) : '—';
			break;
	}
}
add_action( 'manage_testimonial_posts_custom_column', 'g2f_testimonial_column_content', 10, 2 );

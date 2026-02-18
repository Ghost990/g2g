<?php
/**
 * Admin Settings
 *
 * @package G2F_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin Settings Class
 */
class G2F_Admin_Settings {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Add admin menu
	 */
	public function add_admin_menu() {
		add_options_page(
			__( 'G2F Settings', 'g2f-functionality' ),
			__( 'G2F Settings', 'g2f-functionality' ),
			'manage_options',
			'g2f-settings',
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Register settings
	 */
	public function register_settings() {
		register_setting( 'g2f_settings_group', 'g2f_settings' );

		add_settings_section(
			'g2f_general_section',
			__( 'General Settings', 'g2f-functionality' ),
			array( $this, 'general_section_callback' ),
			'g2f-settings'
		);

		add_settings_field(
			'projects_per_page',
			__( 'Projects per page', 'g2f-functionality' ),
			array( $this, 'projects_per_page_callback' ),
			'g2f-settings',
			'g2f_general_section'
		);

		add_settings_field(
			'testimonials_autoplay',
			__( 'Testimonials Autoplay', 'g2f-functionality' ),
			array( $this, 'testimonials_autoplay_callback' ),
			'g2f-settings',
			'g2f_general_section'
		);

		add_settings_field(
			'clients_marquee_speed',
			__( 'Client Logos Marquee Speed', 'g2f-functionality' ),
			array( $this, 'marquee_speed_callback' ),
			'g2f-settings',
			'g2f_general_section'
		);
	}

	/**
	 * General section callback
	 */
	public function general_section_callback() {
		echo '<p>' . esc_html__( 'Configure the G2F Functionality plugin settings.', 'g2f-functionality' ) . '</p>';
	}

	/**
	 * Projects per page callback
	 */
	public function projects_per_page_callback() {
		$options = get_option( 'g2f_settings' );
		$value   = isset( $options['projects_per_page'] ) ? $options['projects_per_page'] : 6;
		?>
		<input type="number" name="g2f_settings[projects_per_page]" value="<?php echo esc_attr( $value ); ?>" min="1" max="24" class="small-text">
		<p class="description"><?php esc_html_e( 'Number of projects to display in the grid.', 'g2f-functionality' ); ?></p>
		<?php
	}

	/**
	 * Testimonials autoplay callback
	 */
	public function testimonials_autoplay_callback() {
		$options = get_option( 'g2f_settings' );
		$value   = isset( $options['testimonials_autoplay'] ) ? $options['testimonials_autoplay'] : 1;
		?>
		<label>
			<input type="checkbox" name="g2f_settings[testimonials_autoplay]" value="1" <?php checked( 1, $value ); ?>>
			<?php esc_html_e( 'Enable autoplay for testimonials slider', 'g2f-functionality' ); ?>
		</label>
		<?php
	}

	/**
	 * Marquee speed callback
	 */
	public function marquee_speed_callback() {
		$options = get_option( 'g2f_settings' );
		$value   = isset( $options['marquee_speed'] ) ? $options['marquee_speed'] : 30;
		?>
		<input type="number" name="g2f_settings[marquee_speed]" value="<?php echo esc_attr( $value ); ?>" min="10" max="120" class="small-text">
		<span><?php esc_html_e( 'seconds', 'g2f-functionality' ); ?></span>
		<p class="description"><?php esc_html_e( 'Duration for one complete scroll cycle.', 'g2f-functionality' ); ?></p>
		<?php
	}

	/**
	 * Settings page
	 */
	public function settings_page() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'g2f_settings_group' );
				do_settings_sections( 'g2f-settings' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}

// Initialize
new G2F_Admin_Settings();

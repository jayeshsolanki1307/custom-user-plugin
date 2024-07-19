<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create Admin_Settings class.
 */
class Admin_Settings {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'cup_add_admin_menu_page' ) );
	}

	public function cup_add_admin_menu_page() {
		add_menu_page(
			__( 'Custom User Plugin', 'cup' ),
			__( 'Custom User Plugin', 'cup' ),
			'manage_options',
			'custom-user-plugin-page',
			array( $this, 'cup_display_menu_page' ),
			'dashicons-admin-users',
			110
		);
	}

	public function cup_display_menu_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Custom User Plugin', 'cup' ); ?></h1>
			<p><?php esc_html_e( 'Use following shortcodes to display the registration and login forms', 'cup' ); ?>:</p>
			<ul>
				<li><code>[cup_registration_form]</code> - Displays the registration form.</li>
				<li><code>[cup_login_form]</code> - Displays the login form.</li>
			</ul>
		</div>
		<?php
	}
}

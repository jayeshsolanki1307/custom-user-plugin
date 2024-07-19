<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create a User_Login class.
 */
class User_Login {

	public function __construct() {
		// User login ajax hook.
		add_action( 'wp_ajax_nopriv_cup_user_login', array( $this, 'cup_user_login_callback' ) );
		add_action( 'wp_ajax_cup_user_login', array( $this, 'cup_user_login_callback' ) );
	}

	/**
	 * Custom login callback.
	 */
	public function cup_user_login_callback() {
		$response_arr = array();
		if ( isset( $_POST['security'] ) &&
			wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['security'] ) ), 'user_nonce' ) ) {
			$login_user = sanitize_text_field( $_POST['login_user'] );
			$login_pass = sanitize_text_field( $_POST['login_pass'] );

			// Check if the provided value is an email or username
			if ( is_email( $login_user ) ) {
				$user = get_user_by( 'email', $login_user );
			} else {
				$user = get_user_by( 'login', $login_user );
			}

			// Check if user exists
			if ( $user ) {
				$credentials = array(
					'user_login'    => $user->user_login,
					'user_password' => $login_pass,
					'remember'      => true,
				);

				// Authenticate the user
				$user = wp_signon( $credentials, false );

				if ( ! is_wp_error( $user ) ) {
					// Login successful
					$response_arr = array(
						'status'       => true,
						'redirect_url' => home_url( '/welcome' ),
						'message'      => __( 'Login successful..!', 'cup' ),
					);
				} else {
					// Login failed due to incorrect password
					$response_arr = array(
						'status'  => false,
						'message' => $user->get_error_message(),
					);
				}
			} else {
				// User does not exist
				$response_arr = array(
					'status'  => false,
					'message' => __( 'User not exists.', 'cup' ),
				);
			}
		} else {
			$response_arr = array(
				'status'  => false,
				'message' => __( 'Something went wrong, Please try again later', 'cup' ),
			);
		}
		wp_send_json( $response_arr );
		die();
	}
}

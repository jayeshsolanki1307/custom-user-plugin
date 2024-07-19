<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create a User_Welcome
 */
class User_Welcome {

	/**
	 * Create welcome page callback on activation.
	 */
	public static function cup_create_welcome_page() {
		// Check if page already exits.
		if ( ! get_page_by_path( 'welcome' ) ) {

			// Create welcome page.
			$page_args = array(
				'post_title'   => 'Welcome',
				'page_content' => 'Welcome to our site!',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_name'    => 'welcome',
			);

			wp_insert_post( $page_args );
		}
	}

	/**
	 * Remove welcome page callback on deactivation.
	 */
	public static function cup_remove_welcome_page() {
		// Find the welcome page.
		$page = get_page_by_path( 'welcome' );

		// Delete the welcome page if it exists.
		if ( $page ) {
			wp_delete_post( $page->ID, true );
		}

		// Get all users with the CUP User role
		$cup_users = get_users( array( 'role' => 'cup_user' ) );

		// Loop through each user and delete them
		foreach ( $cup_users as $user ) {
			wp_delete_user( $user->ID );
		}
	}
}

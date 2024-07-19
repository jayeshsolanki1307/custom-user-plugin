<?php
/**
 * Include Style and JS.
 *
 * @package cup
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create a User_Assets class.
 */
class User_Assets {

	/**
	 * User_Assets constructor.
	 */
	public function __construct() {
		// Enqueue styles and scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'cup_enqueue_scripts' ) );
	}

	/**
	 * Enqueue styles and scripts callback.
	 */
	public function cup_enqueue_scripts() {
		wp_enqueue_style( 'cup-bootstrap', CUP_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), CUP_PLUGIN_VER );
		wp_enqueue_style( 'cup-style', CUP_PLUGIN_URL . 'assets/css/style.css', array(), CUP_PLUGIN_VER );
		wp_enqueue_script( 'cup-bootstrap', CUP_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), CUP_PLUGIN_VER, true );
		wp_enqueue_script( 'cup-validate', CUP_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array( 'jquery' ), CUP_PLUGIN_VER, true );
		wp_enqueue_script( 'cup-script', CUP_PLUGIN_URL . 'assets/js/user-script.js', array( 'jquery' ), CUP_PLUGIN_VER, true );
		wp_localize_script(
			'cup-script',
			'ajax_object',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'user_nonce' ),
			)
		);
	}
}

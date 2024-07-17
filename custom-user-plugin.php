<?php
/**
 * Plugin Name: Custom User Plugin
 * Description: A custom plugin for user registration and login.
 * Version: 1.0.0
 * Author: Jayesh Solanki
 * Text Domain: cup
*/

// Exit if accessed directly.
if(!defined('ABSPATH')){
    exit; 
}

// Define plugin constants.
define( 'CUP_PLUGIN_VER', '1.0.0' );
define( 'CUP_PLUGIN_FILE', __FILE__ );
define( 'CUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CUP_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Include required files. 
require_once CUP_PLUGIN_DIR . 'admin/class-admin-settings.php';
require_once CUP_PLUGIN_DIR . 'inc/class-user-assets.php';
require_once CUP_PLUGIN_DIR . 'inc/class-user-shortcodes.php';
require_once CUP_PLUGIN_DIR . 'inc/class-user-registration.php';
require_once CUP_PLUGIN_DIR . 'inc/class-user-login.php';
require_once CUP_PLUGIN_DIR . 'inc/class-user-welcome.php';

// Initialize the plugin.
function cup_init(){
    new Admin_Settings();
    new User_Assets();
    new User_Shortocde();
    new User_Registration();
    new User_Login();
    new User_Welcome();
}
add_action( 'plugins_loaded', 'cup_init' );

// Create a welcome page on plugin activation.
register_activation_hook( CUP_PLUGIN_FILE, array( 'User_Welcome', 'cup_create_welcome_page' ) );

// Delete a welcome page on plugin deactivation.
register_deactivation_hook( CUP_PLUGIN_FILE, array( 'User_Welcome', 'cup_remove_welcome_page' ) );
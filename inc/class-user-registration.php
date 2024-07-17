<?php
// Exit if accessed directly.
if( !defined( 'ABSPATH' ) ){
    exit; 
}

/**
 * Create a User_Registration class.
 */
class User_Registration {
    
    public function __construct() {
        // User register ajax hook.
        add_action( 'wp_ajax_nopriv_cup_user_register', [ $this, 'cup_user_register_callback' ] );
        add_action( 'wp_ajax_cup_user_register', [ $this, 'cup_user_register_callback' ] );
    }

    /**
     * Custom registation callback.
     */
    public function cup_user_register_callback() {
        $response_arr = array();
        if ( isset($_POST['security']) &&
            wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['security'] )), 'user_nonce' )) {
            $first_name = sanitize_text_field( $_POST['first_name'] );
            $last_name  = sanitize_text_field( $_POST['last_name'] );
            $user_name  = sanitize_text_field( $_POST['user_name'] );
            $user_email = sanitize_email( $_POST['user_email'] );
            $user_password = $_POST['user_password'];

            // Check if user already exists
            if ( username_exists( $user_name ) ) {
                $response_arr = array(
                    'status' => false,
                    'message' => __( 'Username already exists.', 'cup' )
                );
            } elseif ( email_exists( $user_email ) ) {
                $response_arr = array(
                    'status' => false,
                    'message' => __( 'Email already exists.', 'cup' )
                );
            } else {
                // Create new user
                $user_id = wp_create_user( $user_name, $user_password, $user_email );

                // Check if user was successfully created
                if ( is_wp_error ( $user_id ) ) {
                    $response_arr = array(
                        'status'  => false,
                        'message' => $user_id->get_error_message()
                    );
                } else {
                    // Set user meta for first and last name
                    update_user_meta( $user_id, 'first_name', $first_name );
                    update_user_meta( $user_id, 'last_name', $last_name );

                    $this->cup_set_user_role( $user_id );

                    $response_arr = array(
                        'status' => true,
                        'message' => __( 'Registration Successfull..!', 'cup' )
                    );
                }
            }
        } else {
            $response_arr = array(
                'status' => false,
                'message' => __( 'Something went wrong, Please try again later', 'cup' )
            );
        }
        wp_send_json( $response_arr );
        die();
    }

    /**
     * Set custom user role
     */
    private function cup_set_user_role( $user_id ) {
        $role = 'cup_user'; 
        $user = new WP_User( $user_id );
        $user->set_role( $role );
    }
}
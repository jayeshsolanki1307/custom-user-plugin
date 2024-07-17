<?php
// Exit if accessed directly.
if( !defined( 'ABSPATH' ) ){
    exit; 
}

/**
 * Create a User_Shortocde class.
 */
class User_Shortocde {

    public function __construct() {
        // Hook to create user registration form shortcode.
        add_shortcode( 'cup_registration_form', [ $this, 'cup_registration_form' ] );
        
        // Hook to create user login form shortcode.
        add_shortcode( 'cup_login_form', [ $this, 'cup_login_form' ] );
    }

    /**
     * User registration shortcode callback.
     */
    public function cup_registration_form() {
        ob_start(); ?>
        <section id="registration-section" class="registration-section">
            <div class="container">
                <div class="user-sign-up-form-main">
                    <div class="row w-100">
                        <?php
                            if( !is_user_logged_in()){
                            ?>
                            <div class="col">
                                <form id="cup_registration_form" method="post">
                                    <div class="form-group mt-3">
                                        <label for="first_name">
                                            <?php esc_html_e( 'First Name', 'cup' );?>:
                                        </label>
                                        <input type="text" id="first_name" name="first_name" placeholder="Enter firstname" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="last_name">
                                            <?php esc_html_e( 'Last Name', 'cup' );?>:
                                        </label>
                                        <input type="text" id="last_name" name="last_name" placeholder="Enter lastname" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="user_name">
                                            <?php esc_html_e( 'Username', 'cup' );?>:
                                        </label>
                                        <input type="text" id="user_name" name="user_name" placeholder="Enter username" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="user_email">
                                            <?php esc_html_e( 'E-mail', 'cup' );?>:
                                        </label>
                                        <input type="user_email" id="user_email" name="user_email" placeholder="E-mail" placeholder="Enter e-mail" class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="user_password">
                                            <?php esc_html_e( 'Password', 'cup' );?>:
                                        </label>
                                        <input type="password" id="user_password" name="user_password" placeholder="Enter password" class="form-control">
                                    </div>
                                    <div class="submit-btn gap-4 justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Register', 'cup' );?></button>
                                    </div>
                                </form>
                                <div class="my-3">
                                    <div class="registration-message"></div>
                                </div>
                            </div>
                            <?php } else{?>
                            <div class="col">
                                <p><?php esc_html_e( 'User already logged in', 'cup' ); ?></p>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </section>
        <?php return ob_get_clean();
    }

    /**
     * User login shortcode callback.
     */
    public function cup_login_form() {
        ob_start(); ?>
        <section id="login-section" class="login-section">
            <div class="container">
                <div class="user-sign-up-form-main">
                    <div class="row w-100">
                        <?php
                            if( !is_user_logged_in()){
                            ?>
                            <div class="col">
                                <form id="cup_login_form" method="post">
                                    <div class="form-group mt-3">
                                        <label for="login_user">
                                            <?php esc_html_e( 'Username or E-mail', 'cup' );?>:
                                        </label>
                                        <input type="text" id="login_user" name="login_user" placeholder="Enter username or e-mail" class="form-control">
                                    </div>                                    
                                    <div class="form-group mt-3">
                                        <label for="login_password">
                                            <?php esc_html_e( 'Password', 'cup' );?>:
                                        </label>
                                        <input type="password" id="login_password" name="login_password" placeholder="Enter password" class="form-control">
                                    </div>
                                    <div class="submit-btn gap-4 justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Login', 'cup' );?></button>
                                    </div>
                                </form>
                                <div class="my-3">
                                    <div class="login-message"></div>
                                </div>
                            </div>
                            <?php } else{?>
                            <div class="col">
                                <p><?php esc_html_e( 'User already logged in', 'cup' ); ?></p>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </section>
        <?php return ob_get_clean();
    }
}
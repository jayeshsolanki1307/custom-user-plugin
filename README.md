=== Custom User Registration and Login Plugin ===
Contributors: Jayesh Solanki
Tags: user registration, login form, custom roles, user meta
Requires at least: 5.0
Tested up to: 6.2
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The Custom User Registration and Login Plugin provides seamless user registration with custom roles and metadata. It features a secure, shortcode-based login form that redirects logged-in users to a welcome page.

== Description ==

The Custom User Registration and Login Plugin is designed to provide a seamless and user-friendly experience for user registration and login. This plugin adds custom functionality to register users with additional metadata and a custom role, and it offers a shortcode for displaying a login form. It ensures secure user interactions by utilizing nonce verification and redirects logged-in users to a welcome page.

== Features ==

- User registration with first name, last name, username, email, and password fields.
- Assigns custom user roles upon registration.
- Stores additional user information (first name and last name) in user metadata.
- Shortcode `[cup_login_form]` to display a login form.
- Redirects logged-in users to a welcome page.
- Uses nonce verification for secure form submissions.
- Sanitizes all user inputs to prevent vulnerabilities.

== Installation ==

1. Download the plugin files and upload them to your WordPress installation under the `/wp-content/plugins/` directory.
2. Go to the WordPress admin dashboard, navigate to Plugins, and activate the "Custom User Registration and Login Plugin."
3. Use the `[cup_login_form]` shortcode on any page where you want to display the login form.

== Usage ==

### Registration Form

The registration form is implemented in the `cup_user_register_callback` function. It handles form submissions, validates user input, and creates new users with a custom role and additional metadata.

### Login Form

The login form is implemented in the `cup_login_form` function and can be displayed using the `[cup_login_form]` shortcode. If the user is already logged in, they are redirected to a welcome page.

== Customization ==

- **Change Custom Role**: Modify the role assigned to new users in the `cup_user_register_callback` function.

```php
$role = 'cup_user'; // Change this to your desired role
```

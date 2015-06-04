<?php

/* Account activation email customisation */

add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
add_filter( 'wpmu_signup_user_notification_subject', 'my_activation_subject', 10, 4 );
add_filter('wpmu_signup_user_notification_email', 'my_custom_email_message', 10, 4);

function new_mail_from($old) {
	return 'notifications@veterinarygraduatelink.co.uk';
}
function new_mail_from_name($old) {
return 'Veterinary Graduate Link';
}
function my_activation_subject( $text ) {

//Here is where to input the new subject for the activation email:

return 'Please activate your account';
}

function my_custom_email_message($message, $user, $user_email, $key) {

//Here is the new message:

$message = sprintf(__(( "To activate your new account, please click the following link:\n\n%s\n\n After you activate you will be able to log in.\n\n" ),
$user, $user_email, $key, $meta),site_url( "?page=gf_activation&key=$key" ));
return sprintf($message);
}

/* Registration confirmation email customisation */

// Redefine user notification function
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message  = sprintf(__('New user registration on your blog %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
        $message .= wp_login_url() . "\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n\r\n";
        $message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Adios!');

        wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);

    }
}
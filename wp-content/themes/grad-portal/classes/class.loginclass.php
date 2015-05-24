<?php
if ( !class_exists('loginclass') ) {

class loginclass {


		var $user_id;
		var $current_form_id;
		var $message;
		var $action;
		var $confirm_key;
		var $user_key;
		var $user_email;
		var $user_login;


		function __construct(){
			if(isset($_REQUEST['action'])) $this->action = $_REQUEST['action'];
			if(isset($_GET['key'])) $this->confirm_key = $_GET['key'];
			$this->current_form_id = 'login';
			if(isset($_GET['action']) and $_GET['action']=='lostpassword') $this->current_form_id = 'reset_pwd';
			$this->_process();
		}

public function _show_current_form(){
	switch($this->current_form_id){
	case "login":
	get_template_part('login-form');
	break;
	case "reset_pwd":
	get_template_part('reset-password-form');
	break;
	case "update_pwd":
	get_template_part('update-password-form');
	break;
}
}

private function _validate_url() {
  		global $post;
  		$page_url = esc_url(get_permalink( $post->ID ));
  		$urlget = strpos($page_url, "?");
 		 if ($urlget === false) {
    		$concate = "?";
  		} else {
    		$concate = "&";
  		}
 		 return $page_url.$concate;
		}

	private function _sendPasswordResetEmail(){
    //send  password reset confirmation email
    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= get_option('siteurl') . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $this->user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= $this->_validate_url() . "action=reset_pwd_confirm&key=".$this->user_key."&login=" . rawurlencode($this->user_login) . "\r\n";
    if ( $message && !wp_mail($this->user_email, 'Password Reset Request', $message) ):
      return false;
    endif;
    return true;
		}

		public function _process(){

			global $wpdb;

//----------------------- handle login  -----------------------------//

	if($this->action=='login'):
				$error=false;
   	$status['show_form_id'] = 'login';
  	$username = $_POST['user_email'];
  	$password = $_POST['user_pass'];
  if(empty($username) and empty($password)):
$error=true;
endif;
if(empty($username) and !empty($password)):
$this->message = "The email field is empty.";
$error=true;
endif;
if(!empty($username) and empty($password)):
$this->message = "The password field is empty.";
$error=true;
  endif;
  if(!$error):
$creds['user_login'] = $username;
$creds['user_password'] =  $password;
$creds['remember'] = false;
$user = wp_signon( $creds, false );
if(is_wp_error($user)):
  //login failed
  $this->message = $user->get_error_message();
	$this->message = "Registered email address or password incorrect.";
else:
  //login ok, redirect
	wp_redirect(get_permalink(64));
		endif;
		endif;
		endif;

//----------------------- handle password reset link from email  -----------------------------//

		if(!empty($this->confirm_key) && $this->action == "reset_pwd_confirm"):
			  // die('check key');
    $reset_key = $_GET['key'];
    $user_login = $_GET['login'];
    $user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));
    
    $this->user_login = $user_data->user_login;
    $this->user_email = $user_data->user_email;
    
    if(!empty($reset_key) && !empty($user_data)): //if user found

      //ok, show update password form
      $this->message = 'Enter your new password.';
      $this->current_form_id = "update_pwd";
      $this->user_id = $user_data->ID;
		else:
	 $this->message = 'Key expired or invalid. Please request password reset again.';
      $this->current_form_id = "reset_pwd";
	 endif;
  	endif;

 //----------------------- Handle update password submit  -----------------------------//

if($this->action == "update_pwd"):
      $this->current_form_id = "update_pwd";
     $error=false;
        $pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/'; //at least 8 chars long containing an uppercase letter and number;
  if(!wp_verify_nonce( $_POST['update_pwd_nonce'], "update_pwd_nonce")):
     $this->message = "No trick please";
   else:
   
    $pwd = $_POST['user_pwd'];
    $user_id = $_POST['user_id'];
    $pwd_confirm = $_POST['user_pwd_confirm'];
     if(empty($pwd)): //if username not entered, flag error.
     $this->message = "Please enter a password";
     $error=true;
     endif;
     if($pwd!=$pwd_confirm):
        $this->message = "Passwords does not match";
      $error=true;
      endif;
      if(!preg_match($pattern, $pwd)):
        $this->message = "Password must be at least 8 chars long containing at least one uppercase letter and number";
      $error=true;
        endif;
      if(!$error):
      //password ok, update user details
       
      wp_set_password($pwd,$user_id);
     $this->current_form_id  = "login";
     $this->message = "Your password has been successfully reset. Please login.";
      endif;
       endif; 
endif;

  //----------------------- Handle username submit to request password reset -----------------------------//

  if($this->action == "reset_pwd"):
  		global $wpdb;

      $this->current_form_id  = "reset_pwd";
    if ( !wp_verify_nonce( $_POST['reset_pwd_nonce'], "reset_pwd_nonce")):
      $this->message = "No trick please";
    else: //nonce ok
	
    if(empty($_POST['user_email'])): //if username not entered, flag error.
    $this->message = "Please enter your registered email address.";
     else:
      $user_email = $wpdb->escape(trim($_POST['user_email']));
      $user_data = get_user_by_email($user_email);
      $is_admin = isset($user_data->caps['administrator']) ? true : false;
      if(empty($user_data) || $is_admin)://delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
      $this->message = "No user found with that email address.";
      else:
        $this->user_login = $user_data->user_login;
        $this->user_email = $user_data->user_email;

        $this->user_key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $this->user_login));
        if(empty($this->user_key))://generate reset key
          $this->user_key = wp_generate_password(20, false);
          
          $wpdb->update($wpdb->users, array('user_activation_key' => $this->user_key), array('user_login' => $this->user_login));
          //$this->user_key = $user_key;
          endif;  
          
          if($this->_sendPasswordResetEmail()):
			$this->message = "Check your email for the confirmation link to reset your password.";
            $this->current_form_id  = "login";
          else:
			$this->message = "Request failed, please try again.";
            $this->current_form_id  = "reset_pwd";
            endif;
     
      endif; //end if user data
    endif;

    endif; //end nonce ok
//
endif;

		}

	}
}
?>
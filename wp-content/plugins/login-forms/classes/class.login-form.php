<?php

  class login_form {

  		var $_user_id;
		var $_current_form_id;
		var $_message;
		var $_action;
		var $_success;
		var $_confirm_key;
		var $_user_key;
		var $_user_email;
		var $_user_login;
    var $_use_ajax;
		var $_username='';
		var $_password='';

	function __construct() {

  //  add_action( 'init', array($this,'enqueue_scripts'), 0 );

	//	 add_action('wp_ajax_get_login', array($this, 'ajax_login')); //logged in user
   //  add_action('wp_ajax_get_login', array($this, 'ajax_login')); //not logged in user
  

		if(isset($_REQUEST['action'])) $this->_action = $_REQUEST['action'];
			if(isset($_GET['key'])) $this->_confirm_key = $_GET['key'];
			if(isset($_GET['success'])) $this->_success = $_GET['success'];
			$this->init_form();
      $this->_use_ajax = !empty(get_option('use_ajax')) ? get_option('use_ajax') : 0;
	}



 

 	function init_form(){

 		global $wpdb;

//handle confirm messages on redirect


//----------------------- handle login  -----------------------------//

	if($this->_action=='login'):
		
		if(!empty($_POST)):
		//handle login form post
		$error=false;
		$use_remember_me = get_option('login_remember_me') ? 1 : 0;
   	//	$status['show_form_id'] = 'login';
  	$this->_user_email = $_POST['user_email'];
  	$this->_user_pass = $_POST['user_pass'];
	$this->_remember = isset($_POST['user_remember']) ? $_POST['user_remember'] : 0;
  if(empty($this->_user_email) and empty($this->_user_pass)):
$error=true;
endif;
if(empty($this->_user_email) and !empty($this->_user_pass)):
	$msg = get_option('login_empty_email_error_msg');
	$msg = !empty($msg) ? $msg : 'Please enter your email address.';
	$this->_message = $msg;
	$error=true;
endif;
if(!empty($this->_user_email) and empty($this->_user_pass)):
	$msg = get_option('login_empty_pwd_error_msg');
	$msg = !empty($msg) ? $msg : 'Please enter a password.';
	$this->_message = $msg;
	$error=true;
  endif;
if(!$error):
$creds['user_login'] = $this->_user_email;
$creds['user_password'] = $this->_user_pass;
$creds['remember'] = $this->_remember;
$user = wp_signon( $creds, false );
if(is_wp_error($user)):
  //login failed
		
	$msg = get_option('login_failed_error_msg');
	$msg = !empty($msg) ? $msg : "Registered email address or password incorrect.";
  $this->_message =$msg;
else:
  //login ok, redirect
	$redirect_id = get_option('login_redirect_page_id');
	wp_redirect(get_permalink($redirect_id));
		endif;
		endif;

		else:
				//handle login redirect
				if($this->_success == 'pwd_reset'):
					//if password reset successfully
					$msg = get_option('update_pwd_success_msg');
      				$msg = !empty($msg) ? $msg : "Your password has been successfully reset. Please login.";
      				$this->_message = $msg;
				endif;
		endif;
		endif;

 //----------------------- Handle email/username submit to request password reset -----------------------------//

  if($this->_action == "reset_pwd"):
  		global $wpdb;
$error=false;
      //$this->current_form_id  = "reset_pwd";
    if ( !wp_verify_nonce( $_POST['reset_pwd_nonce'], "reset_pwd_nonce")):
      $this->_message = "No trick please";
    else: //nonce ok
	
    if(empty($_POST['user_email'])): //if username not entered, flag error.
    $this->_message = "Please enter your registered email address.";
    $error = true;
     else:
      $this->_user_email = trim($_POST['user_email']);
      $user_data = get_user_by('email',$this->_user_email); 
      $is_admin = isset($user_data->caps['administrator']) ? true : false;
      if(empty($user_data) || $is_admin)://delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
      $msg = get_option('reset_pwd_no_user_msg');
      $msg = !empty($msg) ? $msg : 'No user found with that email address.';
      $this->_message = $msg;
      $error = true;
      else:
        $this->user_login = $user_data->user_login;
        $this->user_email = $user_data->user_email;

        $this->_user_key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $this->_user_email));
        if(empty($this->_user_key))://generate reset key
          $this->_user_key = wp_generate_password(20, false);
          
          $wpdb->update($wpdb->users, array('user_activation_key' => $this->_user_key), array('user_login' => $this->_user_email));
          //$this->user_key = $user_key;
          endif;  
          //$admin =  new login_forms_admin();
          if($admin->_sendPasswordResetEmail()):
          $msg = get_option('reset_pwd_link_sent_msg');
     	  $msg = !empty($msg) ? $msg : 'Check your email for the confirmation link to reset your password.';
      	  $this->_message = $msg;
      	  //redirect to login page
      	 // $redirect_id = get_option('login_page_id');
      	 // wp_redirect(get_permalink($redirect_id));
           // $this->current_form_id  = "login";
          else:
          $msg = get_option('reset_pwd_link_sent_error_msg');
     	  $msg = !empty($msg) ? $msg : 'Password reset request failed, please try again.';
      	  $this->_message = $msg;
           // $this->current_form_id  = "reset_pwd";
          endif;
     
      endif; //end if user data
    endif;

    endif; //end nonce ok
//
endif;


//----------------------- handle password reset key from email  -----------------------------//

		if(!empty($this->_confirm_key) && $this->_action == "reset_pwd_confirm"):
			  // die('check key');
    $reset_key = $_GET['key'];
    $user_login = $_GET['login'];
    $user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));
    
    $this->_user_login = $user_data->user_login;
    $this->_user_email = $user_data->user_email;
    
    if(!empty($reset_key) && !empty($user_data)): //if user found

      //ok, show update password form
      $this->_message = 'Enter your new password.';
    //  $this->current_form_id = "update_pwd";
      $this->user_id = $user_data->ID;
		else:
		$msg = get_option('reset_pwd_expired_key_error_msg');
		$msg = !empty($msg) ? $msg : 'Key expired or invalid. Please request password reset again.';
	 $this->_message = get_option('reset_pwd_expired_key_error_msg');
      //$this->current_form_id = "reset_pwd";
	 endif;
  	endif;

//----------------------- Handle update password submit  -----------------------------//

if($this->_action == "update_pwd"):
    //  $this->current_form_id = "update_pwd";
     $error=false;
     $pattern = get_option('reset_pwd_valid_pattern');
     $pattern = !empty($pattern) ? $pattern : '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/'; //at least 8 chars long containing an uppercase letter and number;
  if(!wp_verify_nonce( $_POST['update_pwd_nonce'], "update_pwd_nonce")):
     $this->_message = "No trick please";
   else:
   
    $pwd = $_POST['user_pwd'];
    $user_id = $_POST['user_id'];
    $pwd_confirm = $_POST['user_pwd_confirm'];
     if(empty($pwd)): //if username not entered, flag error.
     $msg = get_option('reset_pwd_empty_pwd_error_msg');
     $msg = !empty($msg) ? $msg : 'Please enter a password';
     $this->_message = $msg;
     $error=true;
     endif;
     if($pwd!=$pwd_confirm):
     	$msg = get_option('reset_pwd_no_match_error_msg');
     	$msg = !empty($msg) ? $msg : 'Passwords do not match';
     	$this->_message = $msg;
      $error=true;
      endif;
      if(!preg_match($pattern, $pwd)):
      	$msg = get_option('reset_pwd_format_error_msg');
      	$msg = !empty($msg) ? $msg : "Password must be at least 8 chars long containing at least one uppercase letter and number";
      	$this->_message = $msg;
      $error=true;
        endif;
      if(!$error):
      //password ok, update user details
     wp_set_password($pwd,$user_id);
	//redirect to login page
      	  $redirect_id = get_option('login_page_id');
      	  wp_redirect(get_permalink($redirect_id).'?action=login&success=pwd_reset');

      endif;
endif;
endif;
 	}

}
//$login = new login_form();
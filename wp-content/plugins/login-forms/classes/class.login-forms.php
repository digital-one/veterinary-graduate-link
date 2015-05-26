<?php

  class login_forms {

  		var $_user_id;
		var $_current_form_id;
		var $_message;
		var $_action;
		var $_success;
		var $_confirm_key;
    var $_use_ajax;
		var $_user_key;
		var $_user_email;
		var $_user_login;

	function __construct() {

      $this->_use_ajax = !empty(get_option('use_ajax')) ? get_option('use_ajax') : 0;

  // add_action('wp_ajax_reset_pwd', array($this, 'ajax_reset_pwd')); //logged in user
   // add_action( 'wp_ajax_nopriv_reset_pwd', array($this, 'ajax_reset_pwd')); //not logged in user
// add_action('init', array($this,'init_forms'),0);
		//$this->load_dependencies();

	}

function setup_admin(){
  add_action( 'init', array($this,'enqueue_scripts'), 0 );
  add_action( 'init', array($this,'register_form_shortcodes'), 0 );
    //add_action('init',array($this,'plugin_options'),0);
  add_action('admin_menu',array($this,'plugin_menu'),0);
  add_action( 'admin_init', array($this,'register_plugin_settings'),0 );
  add_action('wp_ajax_login', array($this, 'process_login')); //logged in user
  add_action( 'wp_ajax_nopriv_login', array($this, 'process_login')); //not logged in user
  add_action('wp_ajax_reset_pwd', array($this, 'process_reset_password')); //logged in user
  add_action( 'wp_ajax_nopriv_reset_pwd', array($this, 'process_reset_password')); //not logged in user
    add_action('wp_ajax_update_pwd', array($this, 'process_update_password')); //logged in user
  add_action( 'wp_ajax_nopriv_update_pwd', array($this, 'process_update_password')); //not logged in user
}

function enqueue_scripts(){
  if(!is_admin()):
  //wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'login_forms', plugin_dir_url( __FILE__ ). '../libraries/login-forms.js', array(), '1.0.0', false );
 wp_enqueue_script( 'login_forms' );
  wp_localize_script( 'login_forms', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    endif;
}

function ajax_login(){

$creds['user_login'] = $_POST['user_email'];
$creds['user_password'] = $_POST['user_pass'];
$creds['remember'] = isset($_POST['user_remember']) ? 1 : 0;
$response = array();
  $user = wp_signon( $creds, false );
  if(is_wp_error($user)):
    $msg = get_option('login_failed_error_msg');
  $msg = !empty($msg) ? $msg : "Registered email address or password incorrect.";
  $this->_message =$msg;
$response['message'] = $this->_message;
$response['success'] = 0;
  else:
    $redirect_id = get_option('login_redirect_page_id');
$response['redirect'] = get_permalink($redirect_id);
$response['success'] = 1;
  endif;
echo json_encode($response);
   die();
        exit();
 }


function process_login(){

if(!empty($_POST)):
    //handle login form post
 $error=false;
  $redirect = !empty(get_option('login_redirect_page_id')) ? get_permalink(get_option('login_redirect_page_id')) : '';
    $use_remember_me = get_option('login_remember_me') ? 1 : 0;
    //  $status['show_form_id'] = 'login';
    $this->_user_email = $_POST['user_email'];
    $this->_user_pass = $_POST['user_pass'];
  $this->_remember = isset($_POST['user_remember']) ? 1 : 0;
  if(empty($this->_user_email) and empty($this->_user_pass)):
    $msg = get_option('login_empty_email_pwd_error_msg');
  $msg = !empty($msg) ? $msg : 'Please enter your email address and password.';
  $this->_message = $msg;
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
    $error=true;
  $msg = get_option('login_failed_error_msg');
  $msg = !empty($msg) ? $msg : "Registered email address or password incorrect.";
  $this->_message =$msg;
else:
  //login ok, redirect
  if(!$this->_use_ajax):
  wp_redirect($redirect);
  endif;

    endif;
    endif;

    if($this->_use_ajax):
      $response = array('error'=>$error,'message'=>$this->_message,'redirect'=> $redirect);
      echo json_encode($response);
  die();
  exit();
  endif;
      
    endif;


}

function process_reset_password(){
  global $wpdb;
 
  $error=false;
      //$this->current_form_id  = "reset_pwd";
    if ( !wp_verify_nonce( $_POST['reset_pwd_nonce'], "reset_pwd_nonce")):
      $this->_message = "No trick please";
    $error = true;
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
          if($this->sendPasswordResetEmail()):
          $msg = get_option('reset_pwd_link_sent_msg');
        $msg = !empty($msg) ? $msg : $user_data->user_login.' Check your email for the confirmation link to reset your password. url='.strtolower($this->_validate_url() . "action=reset_pwd_confirm&key=".$this->_user_key."&login=" . rawurlencode($user_data->user_login));
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

    if($this->_use_ajax):
      $response = array('error'=>$error,'message'=>$this->_message,'redirect'=>'');
      echo json_encode($response);
  die();
  exit();
  endif;

}
function process_confirm_key(){
     global $wpdb;
  $reset_key = $_GET['key'];
    $user_login = $_GET['login'];
    $user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));
   
    
    if(!empty($reset_key) && !empty($user_data)): //if user found
     $this->_user_login = $user_data->user_login;
    $this->_user_email = $user_data->user_email;
      //key ok, remove the key from the database so it cant be re-used.
     $wpdb->update($wpdb->users, array('user_activation_key' => ''), array('user_login' => $this->_user_email));
      $this->_message = 'Enter your new password.';
      //$this->current_form_id = "update_pwd";
      $this->user_id = $user_data->ID;
    else:
      //key expired or invalid, redirect to password reset
       $redirect_id = get_option('reset_pwd_page_id');
          wp_redirect(get_permalink($redirect_id).'?action=invalid_key');
 /*
    $msg = get_option('reset_pwd_expired_key_error_msg');
    $msg = !empty($msg) ? $msg : 'Key expired or invalid. Please request password reset again.';
   $this->_message = get_option('reset_pwd_expired_key_error_msg');
  */
   endif;

}

function process_update_password(){

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
         $redirect_url = !empty(get_option('login_page_id')) ? get_permalink(get_option('login_page_id')).'?action=reset_success' : '';
      if(!$error):
      //password ok, update user details
     wp_set_password($pwd,$user_id);
  //redirect to login page
         

          if(!$this->_use_ajax):
          wp_redirect($redirect_url); //redirect is not using ajax
       endif;
    endif; //end if errors

if($this->_use_ajax):
    $response = array('error'=>$error,'message'=>$this->_message,'redirect'=>$redirect_url);
      echo json_encode($response);
      die();
      endif;

  endif; // end verify nonce

}

function get_requests(){
  if(isset($_REQUEST['action'])) $this->_action = $_REQUEST['action'];
    if(isset($_GET['key'])) $this->_confirm_key = $_GET['key'];
}

  function init_form(){


    $this->get_requests();

//handle confirm messages on redirect


//----------------------- handle login post -----------------------------//

  if($this->_action=='login'):
      $this->process_login();
 endif;

//----------------------- handle redirects -----------------------------//

 if($this->_action=='invalid_key'):
    $msg = get_option('reset_pwd_expired_key_error_msg');
    $msg = !empty($msg) ? $msg : 'Key expired or invalid. Please request password reset again.';
    $this->_message = $msg;
  endif;
  if($this->_action=='reset_success'):
    $msg = get_option('update_pwd_success_msg');
    $msg = !empty($msg) ? $msg : 'Your password has been updated. Please login.';
    $this->_message = $msg;
    endif;

 //----------------------- Handle email/username submit to request password reset -----------------------------//

  if($this->_action == "reset_pwd"):
  $this->process_reset_password();
  endif;


//----------------------- handle password reset key from email  -----------------------------//

    if(!empty($this->_confirm_key) && $this->_action == "reset_pwd_confirm"):
      $this->process_confirm_key();
    endif;

//----------------------- Handle update password submit  -----------------------------//

if($this->_action == "update_pwd"):
  $this->process_update_password();

endif;
  }



	function plugin_menu() {
		add_options_page( 'Login Form Options', 'Login Form Options', 'manage_options', 'my-unique-identifier', array($this,'my_plugin_options') );
	}


	function my_plugin_options() {
	
	load_template( plugin_dir_path(dirname( __FILE__ )). '/options/template-options-page.php' );
}

/*

	function register_plugin_options_page(){ 
		add_options_page('Login Form Options', 'Login Form Options', 'manage_options', 'login-forms/login-forms.php', array($this,'loginforms_plugin_options_page'));
	} 
	function loginforms_plugin_options_page(){
		load_template( dirname( __FILE__ ) . '/options/template-options-page.php' );
	}
	
*/
	function register_plugin_settings() { 
	 register_setting( 'login-form-settings-group', 'login_page_id' );
	 register_setting( 'login-form-settings-group', 'reset_pwd_page_id' );
	 register_setting( 'login-form-settings-group', 'update_pwd_page_id' );
	 register_setting( 'login-form-settings-group', 'login_remember_me' );
   register_setting( 'login-form-settings-group', 'use_ajax' );
  register_setting( 'login-form-settings-group', 'login_redirect_page_id');
register_setting( 'login-form-settings-group', 'reset_pwd_redirect_page_id');
register_setting( 'login-form-settings-group', 'update_pwd_redirect_page_id');
	 register_setting( 'login-form-settings-group', 'login_empty_email_error_msg' );
	 register_setting( 'login-form-settings-group', 'login_empty_pwd_error_msg' );
	 register_setting( 'login-form-settings-group', 'login_failed_error_msg' );
	}

	function register_form_shortcodes(){
		add_shortcode('login-form', array($this,'login_form_shortcode'));
		add_shortcode('reset-password-form', array($this,'reset_pwd_form_shortcode'));
		add_shortcode('update-password-form', array($this,'update_pwd_form_shortcode'));
	}

	function login_form_shortcode($atts){
  extract(shortcode_atts(array(
      'posts' => 'yes',
   ), $atts));

load_template( plugin_dir_path( dirname( __FILE__ )) . '/templates/template-login-form.php' );



 	}

 	function reset_pwd_form_shortcode($atts){
	/*
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
 	*/
load_template( plugin_dir_path( dirname( __FILE__ )) . '/templates/template-reset-password-form.php' );
 	}

 	function update_pwd_form_shortcode($atts){
	/*
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
 	*/
load_template( plugin_dir_path( dirname( __FILE__ ))  . '/templates/template-update-password-form.php' );
 	}


private function _validate_url() {
  		global $post;
  		$reset_page_id = get_option('reset_pwd_page_id');
  		$page_url = esc_url(get_permalink($reset_page_id));
  		$urlget = strpos($page_url, "?");
 		 if ($urlget === false) {
    		$concate = "?";
  		} else {
    		$concate = "&";
  		}
 		 return $page_url.$concate;
		}

	private function sendPasswordResetEmail(){
    //send  password reset confirmation email
    $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
    $message .= get_option('siteurl') . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $this->_user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= $this->_validate_url() . "action=reset_pwd_confirm&key=".$this->_user_key."&login=" . rawurlencode($this->_user_login) . "\r\n";
    if ( $message && !wp_mail($this->_user_email, 'Password Reset Request', $message) ):
      return false;
    endif;
    return true;
		}



}

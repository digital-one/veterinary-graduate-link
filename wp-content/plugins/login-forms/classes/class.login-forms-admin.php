<?php

  class login_forms_admin {

  		var $_user_id;
		var $_current_form_id;
		var $_message;
		var $_action;
		var $_success;
		var $_confirm_key;
		var $_user_key;
		var $_user_email;
		var $_user_login;

	function __construct() {

    add_action( 'init', array($this,'enqueue_scripts'), 0 );
		add_action( 'init', array($this,'register_form_shortcodes'), 0 );
		//add_action('init',array($this,'plugin_options'),0);
		add_action('admin_menu',array($this,'plugin_menu'),0);
		add_action( 'admin_init', array($this,'register_plugin_settings'),0 );

     add_action('wp_ajax_get_login', array($this, 'ajax_login')); //logged in user
   add_action( 'wp_ajax_nopriv_get_login', array($this, 'ajax_login')); //not logged in user


	//	add_action('init', array($this,'init_forms'),0);
		$this->load_dependencies();
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


	function load_dependencies(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class.login-form.php';
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
	/*
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
 	*/
 	load_template( plugin_dir_path( dirname( __FILE__ ) )  . '/templates/template-login-form.php' );
 	}

 	function reset_pwd_form_shortcode($atts){
	/*
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
 	*/
load_template( plugin_dir_path( dirname( __FILE__ ) ) . '/templates/template-reset-password-form.php' );
 	}

 	function update_pwd_form_shortcode($atts){
	/*
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
 	*/
load_template( plugin_dir_path( dirname( __FILE__ ) )  . '/templates/template-update-password-form.php' );
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

	private function _sendPasswordResetEmail(){
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

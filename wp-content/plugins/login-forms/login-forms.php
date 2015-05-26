<?php
 /**
 * Plugin Name: Login Forms
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Login, Reset Password, Update Password Forms & Functionality
 * Version: 0.1
 * Author: Digital One
 * Author URI: http://www.digital-one.co.uk
 * License: Private. Only Digital One customers are allowed to use this plugin
 */

require_once plugin_dir_path( __FILE__ ) . 'classes/class.login-forms.php';

function run_login_forms() {

  $admin = new login_forms();
  $admin->setup_admin();

}

run_login_forms();
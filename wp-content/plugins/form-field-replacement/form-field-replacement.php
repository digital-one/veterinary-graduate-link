<?php
 /**
 * Plugin Name: Form Field Replacement
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Replaces default select, file input and checkboxes
 * Version: 0.1
 * Author: Digital One
 * Author URI: http://www.digital-one.co.uk
 * License: Private. Only Digital One customers are allowed to use this plugin
 */
 class form_field_replacement {
function __construct() {
	add_action( 'init', array($this,'enqueue_scripts'), 0 );
 
}
function enqueue_scripts(){
if(!is_admin()):
	//wp_deregister_script( 'jquery' );
	  wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
	  wp_enqueue_script( 'jquery' );
wp_register_script( 'select2', plugin_dir_url( __FILE__ ) . 'libraries/select2/select2.full.min.js', array(), null, false );
    wp_enqueue_script('select2');
    wp_register_style( 'select2_css', plugin_dir_url( __FILE__ ) . 'libraries/select2/select2.min.css', array(), '', 'all' );
    wp_enqueue_style( 'select2_css' ); 
wp_register_script( 'form_field_replace', plugin_dir_url( __FILE__ ) . 'libraries/form-field-replacement.js', array(), '1.0.0', false );
 wp_enqueue_script( 'form_field_replace' );
endif;
}

}
 $ffr = new form_field_replacement();
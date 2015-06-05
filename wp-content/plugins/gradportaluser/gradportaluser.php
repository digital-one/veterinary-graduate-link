<?php
 /**
 * Plugin Name: Grad Portal User
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Controls User functions
 * Version: 0.1
 * Author: Digital One
 * Author URI: http://www.digital-one.co.uk
 * License: Private. Only Digital One customers are allowed to use this plugin
 */

class gradportaluser {

	private $_wp_user;
	private $_user_meta;
	private $_shortlist;


		function __construct($user){
			add_action( 'init', array($this,'enqueue_scripts'), 0 );
			add_action('wp_ajax_shortlist_add_me', array($this, 'ajax_add_to_shortlist')); 
  			add_action( 'wp_ajax_nopriv_shortlist_add_me', array($this, 'ajax_add_to_shortlist')); //not logged in user
  			add_action('wp_ajax_shortlist_remove_me', array($this, 'ajax_remove_from_shortlist')); 
  			add_action( 'wp_ajax_nopriv_shortlist_remove_me', array($this, 'ajax_remove_from_shortlist')); //not logged in user
			$this->set_user($user);
			//$this->_user_meta = get_user_meta($this->get_id());
			//$this->_shortlist = $this->_user_meta["_shortlist"][0];	
		}

		function enqueue_scripts(){
  if(!is_admin()):
  //wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'gradportaluser', plugin_dir_url( __FILE__ ). '/libraries/gradportaluser.js', array(), '1.0.0', false );
 wp_enqueue_script( 'gradportaluser' );
  wp_localize_script( 'gradportaluser', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    endif;
	}


		protected function set_user($user) {
			$this->_wp_user = $user;
		}	
		protected function get_user() {
			return $this->_wp_user;
		}
		public function get_user_role() {
			$roles = $this->roles;
			$role = array_shift($roles);
			return $role;
		}
		public function __get($key) {
			return $this->get_user()->$key;
		}
		public function __set($key, $value) {
			return $this->get_user()->$key = $value;
		}
		public function logout() {
			return wp_logout();
		}
		public function is_admin() {
			if(in_array("administrator", $this->roles)):
				return true;
			else:
				return false;
			endif;
		}
		public function is_candidate(){
			if(in_array("candidate", $this->roles)):
				return true;
			else:
				return false;
			endif;
		}
		public function is_employer(){
			if(in_array("employer", $this->roles)):
				return true;
			else:
				return false;
			endif;
		}
		public function is_logged_in() {
			return $this->get_user()->ID > 0;
		}
		public function get_id() {
			return $this->ID;
		}
		public function get_firstname() {
			return $this->_user_meta["first_name"][0];
		}

		public function get_surname() {
			return $this->_user_meta["last_name"][0];		
		}

		public function get_email() {
			return $this->user_email;
		}

		public function get_profile_url(){
			if($this->is_candidate()):
				return get_permalink(27);
			elseif($this->is_employer()):
					return get_permalink(29);
				else:
					return admin_url();
					endif;
		}

		public function has_shortlist(){
			if(get_user_meta($this->get_id(),'_shortlist',true)):
			//if($shortlist):
				return true;
			else:
  			return false;
  		endif;
  		}

  		public function get_shortlist_candidates(){
  			$_shortlist = $this->get_shortlist();
  			if (strpos($_shortlist,',') !== false):
  			$_shortlist_arr = explode(',',$this->_shortlist);
  			else:
  			$_shortlist_arr = array($this->_shortlist);
  			endif;
  			return $_shortlist_arr;
  		}

  		public function shortlist_total(){
  			$_total = count($this->get_shortlist_candidates());
  			return $_total;
  		}

  		public function candidate_on_shortlist($_candidate){
  			if($this->has_shortlist()):
  			$_shortlist_arr = $this->get_shortlist_candidates();
  			if(in_array($_candidate,$_shortlist_arr)):
  				return true;
			endif;
			endif;
		return false;
  		}

  		function ajax_add_to_shortlist(){
  			$_candidate = $_POST['candidate_id'];
  			//$_error = false;
  			//$resp = get_user_meta($this->get_id(),'_shortlist',true);
  		//	$resp = array($this->get_id());
  			$resp='';
  			if($this->has_shortlist()):
  				$resp = $_candidate;
  			endif;
  			/*
  				$_shortlist_arr = $this->get_shortlist_candidates();
  				array_push($_shortlist_arr, $_candidate );
  				$_shortlist_str = implode(',',$_shortlist_arr);
  				*/
  				//else:
  				//	$resp = 'no shortlist';
  					//$_shortlist_str = $_candidate;
  			//	endif;
  			//	update_user_meta($this->get_id(), '_shortlist', $_shortlist_str);
  			//$_shortlist_length = $this->shortlist_total();
  			//	echo json_encode(array('error'=>$_error,'candidates'=>$_shortlist_length));
  			echo json_encode($resp);
  				die();
  	}

  		function ajax_remove_from_shortlist($_candidate){
  			$_error=true;
  			$_shortlist_arr = $this->get_shortlist_candidates();
  			for($i=0;$i< count($_shortlist_arr);$i++):
  				if($_shortlist_arr[$i] == $_candidate):
  					unset($_shortlist_arr[$i]);
  					$_error= false;
  					endif;
  				endfor;
  				$_shortlist_length = $this->shortlist_total();
  				echo json_encode(array('error'=>$_error,'candidates'=>$_shortlist_length));
  				die();
  			}
  			//
	}
	global $current_user;
	new gradportaluser($current_user);
	?>
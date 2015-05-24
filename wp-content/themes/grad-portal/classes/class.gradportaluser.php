<?php

class gradportaluser {

	private $_wp_user;
	private $_user_meta;


		function __construct($user){
			$this->set_user($user);
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
		public function get_profile_url(){
			if($this->is_candidate()):
				return get_permalink(27);
			elseif($this->is_employer()):
					return get_permalink(29);
				else:
					return admin_url();
					endif;
		}

	}

	?>
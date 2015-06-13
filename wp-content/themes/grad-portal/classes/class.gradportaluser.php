<?php

class gradportaluser {

	private $_wp_user;
	private $_user_meta;


		function __construct($user){
			
			$this->set_user($user);
			$this->_user_meta = get_user_meta($this->get_id());
			//$this->_shortlist = $this->_user_meta["_shortlist"][0];	
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
		public function get_reference(){
			return $this->_user_meta["reference"][0];
		}
		public function get_organisation(){
			return $this->_user_meta["organisation_name"][0];
		}
		public function get_postcode(){
			return $this->_user_meta["postcode"][0];
		}
		public function get_telephone(){
			return $this->_user_meta["telephone_no"][0];
		}
		public function get_locations(){
			return $this->_user_meta["locations"][0];
		}
		public function get_university(){
			return $this->_user_meta["university"][0];
		}
		public function get_graduation_year(){
			return $this->_user_meta["graduation_year"][0];
		}
		public function get_profile_single_url(){
			$url = home_url().'/candidate-alerts/candidate/'.$this->get_id();
			return $url;
		}
		public function get_email() {
			return $this->user_email;
		}
		public function is_deleted(){
			return $this->_user_meta["deleted"][0];
		}
		public function is_searchable(){
			return $this->_user_meta["searchable"][0];
		}
		public function is_subscribed_to_candidate_alerts(){
			if(isset($this->_user_meta["ca_signup"][0])):
			return true;
			endif;
			return false;
		}
		public function get_candidate_alert_meta(){
			$meta = array();
			$meta['locations'] = isset($this->_user_meta["ca_locations"][0]) ? $this->_user_meta["ca_locations"][0] : '';
			$meta['university'] = isset($this->_user_meta["ca_university"][0]) ? $this->_user_meta["ca_university"][0] : '';
			$meta['out_of_hours'] = isset($this->_user_meta["ca_out_of_hours"][0]) ? $this->_user_meta["ca_out_of_hours"][0] : '';
			$meta['weekends'] = isset($this->_user_meta["ca_weekends"][0]) ? $this->_user_meta["ca_weekends"][0] : '';
			$meta['nights'] = isset($this->_user_meta["ca_nights"][0]) ? $this->_user_meta["ca_nights"][0] : '';
			$meta['internship'] = isset($this->_user_meta["ca_internship"][0]) ? $this->_user_meta["ca_internship"][0] : '';
			$meta['small_animal'] = isset($this->_user_meta["ca_small_animal"][0]) ? $this->_user_meta["ca_small_animal"][0] : '';
			$meta['farm_animal'] = isset($this->_user_meta["ca_farm_animal"][0]) ? $this->_user_meta["ca_farm_animal"][0] : '';
			$meta['equine'] = isset($this->_user_meta["ca_equine"][0]) ? $this->_user_meta["ca_equine"][0] : '';
			$meta['exotics'] = isset($this->_user_meta["ca_exotics"][0]) ? $this->_user_meta["ca_exotics"][0]  : '';
			$meta['medicine'] = isset($this->_user_meta["ca_medicine"][0]) ? $this->_user_meta["ca_medicine"][0] : '';
			$meta['surgery'] = isset($this->_user_meta["ca_surgery"][0]) ? $this->_user_meta["ca_surgery"][0] : '';
			return $meta;
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

		
  			//
	}

	?>
<?php

  class shortlist {

  	var $_shortlist;
  	var $_shortlist_user;

  	function __construct(){

  			add_action('wp_ajax_shortlist_add', array($this, 'ajax_add_to_shortlist')); 
  			add_action( 'wp_ajax_nopriv_shortlist_add', array($this, 'ajax_add_to_shortlist')); //not logged in user
  			$current_user = wp_get_current_user();
  			$this->_gpuser = new gradportaluser($current_user);
  			$this->_shortlist = $this->get_shortlist();
  	}

  	function get_shortlist(){
  		return get_user_meta($this->_gpuser->ID,'_shortlist',true);
  	}

  	function is_on_shortlist($_candidate){
  		if($this->_shortlist):
  			$_shortlist_arr = explode(',',$this->_shortlist);
  			if(in_array($_candidate,$_shortlist_arr)):
  				return true;
			endif;
		endif
		return false;
  	}

  	function shortlist_total(){
  		$_total = count($this->_shortlist);
  		return $_total;
  	}

  	function ajax_add_to_shortlist($_candidate){

  		//get logged in user;
  		
  		if($this->_shortlist_user->is_employer()):
  			if($this->_shortlist):
  				$_shortlist_arr = explode(',',$this->_shortlist);
  				array_push($_shortlist_arr, $_candidate );
  				$_shortlist_length = $this->shortlist_total();
  				$_shortlist_str = implode(',',$_shortlist_arr);
  				else:
  					$_shortlist_str = $_candidate;
  				endif;
  				update_user_meta($gp_user->ID, '_shortlist', $_shortlist_str);
  				echo json_encode(array('error'=>false,'candidates'=>$_shortlist_length));
  				exit();
  			endif;
  			endif;
  			echo json_encode(array('error'=>true));
  			exit();
  	}

  	function ajax_remove_from_shortlist($_candidate){
  		if($this->_gpuser->is_employer()):
  			$_shortlist_arr = explode(',',$this->_shortlist);
  			for($i=0;$i< count($_shortlist_arr);$i++):
  				if($_shortlist_arr[$i] == $_candidate):
  					unset($_shortlist_arr[$i]);
  					$_shortlist_length = $this->shortlist_total();
  				echo json_encode(array('error'=>false,'candidates'=>$_shortlist_length));
  				exit();
  					endif;
  				endfor;
  				echo json_encode(array('error'=>true));
  				exit();
			endif;
  		}


  }
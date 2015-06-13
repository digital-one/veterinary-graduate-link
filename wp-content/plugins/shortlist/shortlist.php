<?php
 /**
 * Plugin Name: Grad Portal User Shortlist
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Shortlist functionality
 * Version: 0.1
 * Author: Digital One
 * Author URI: http://www.digital-one.co.uk
 * License: Private. Only Digital oci_new_collection(connection, tdo) customers are allowed to use this plugin
 */
  class shortlist {

  	var $_shortlist;
    var $_shortlist_archive;
  	var $_shortlist_user;  
  	var $_user;
  	var $_user_id;

  	function __construct(){
  		
  			
  		}

  		function set_admin(){
  			add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts'), 0 );
  			add_action( 'wp_loaded', array($this,'set_current_user'), 0 );
  			add_action('wp_ajax_shortlist_add_me', array($this, 'ajax_add_to_shortlist')); 
  			add_action( 'wp_ajax_nopriv_shortlist_add_me', array($this, 'ajax_add_to_shortlist')); //not logged in user
  			add_action('wp_ajax_shortlist_remove_me', array($this, 'ajax_remove_from_shortlist')); 
  			add_action( 'wp_ajax_nopriv_shortlist_remove_me', array($this, 'ajax_remove_from_shortlist')); 
  		}

  			function enqueue_scripts(){
  if(!is_admin()):
  //wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'shortlist', plugin_dir_url( __FILE__ ). '/libraries/shortlist.js', array(), '1.0.0', false );
 wp_enqueue_script( 'shortlist' );
  wp_localize_script( 'shortlist', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    endif;
	}

	 function set_current_user($user){
			global $current_user;
      $this->_user = $current_user;
			$this->_user_id = $current_user->ID;
	} 

  	function get_shortlist(){
			if($this->_shortlist = get_user_meta($this->_user_id,'_shortlist',true)):
				return $this->_shortlist;
			endif;
  			return false;
  		}
      function get_shortlist_archive(){
        if($this->_shortlist_archive = get_user_meta($this->_user_id,'_shortlist_archive',true)):
      return $this->_shortlist_archive;
      endif;
      return false;
      }

      function get_shortlist_candidate_refs(){
        $refs='';
        if($candidates = $this->get_shortlist_candidates()):
          foreach($candidates as $candidate):
            if($_user = get_user_by( 'id', $candidate)):
            $_gp_user = new gradportaluser($_user);
            if(!empty($refs)) $refs.=', ';
            $profile_url = get_edit_user_link($candidate);
            $refs.= '<a href="'.$profile_url.'" target="_blank">'.$_gp_user->get_reference().'</a>';
            endif;
            endforeach;
          endif;
          return $refs;
      }

  		function get_shortlist_candidates(){
  			if($this->get_shortlist()):
  			if (strpos($this->_shortlist,',') !== false):
  			$_shortlist_arr = explode(',',$this->_shortlist);
  			else:

  			$_shortlist_arr = array($this->_shortlist);
  			endif;
        return $_shortlist_arr;
  			endif;
  			return false;
  		}

      function get_archive_shortlist_candidates(){
        if($this->get_shortlist_archive()):
        if (strpos($this->_shortlist_archive,',') !== false):
        $_shortlist_arr = explode(',',$this->_shortlist_archive);
        else:
        $_shortlist_arr = array($this->_shortlist_archive);
        endif;
        return $_shortlist_arr;
        endif;
        return false;
      }
      function candidate_is_in_archive($candidate_id){
        if($archive = $this->get_archive_shortlist_candidates()):
          if(in_array($candidate_id, $archive)):
            return true;
          endif;
          endif;
          return false;
      }

      function add_shortlist_to_archive(){
         if($candidates = $this->get_shortlist_candidates()):
          $archive = array();
         if($get = $this->get_archive_shortlist_candidates()) $archive = $get;
            foreach($candidates as $candidate_id):
                if(!in_array($candidate_id, $archive)):
                  $archive[] = $candidate_id; //add candidate to archive
                endif;
              endforeach;
              $_shortlist_str = implode(',',$archive);
                update_user_meta($this->_user_id, '_shortlist_archive', $_shortlist_str);
              return true;
            endif;
            return false;
      }
      function deleted_candidates_in_shortlist(){
         $number = 0;
        if($candidates = $this->get_shortlist_candidates()):
          foreach($candidates as $candidate):
            if(get_user_meta($candidate,'deleted',true)==1):
              $number++;
            endif;
            if( get_userdata($candidate)===false):
              $number++;
              endif;
            endforeach;
            endif;
            return $number;
      }

      function delete_shortlist(){
        if($this->get_shortlist()):
          $added_to_archive = $this->add_shortlist_to_archive();
        if($added_to_archive):
        delete_user_meta($this->_user_id, '_shortlist');
      return true;
      endif;
      endif;
      return false;
      }

  		function has_candidates(){
  			if($this->get_shortlist()):
  			$_shortlist_arr = $this->get_shortlist_candidates();
  			if(count($_shortlist_arr)>0):
  				return true;
  			endif;
  			endif;
  			return false;
  		}
  		function total_shortlist_candidates(){
  			$total=0;
  			if($this->get_shortlist()):
  			$_shortlist_arr = $this->get_shortlist_candidates();
  			$total = count($_shortlist_arr);
  			endif;
  			return $total;
  		}
      function total_archive_shortlist_candidates(){
        $total=0;
        if($this->get_shortlist()):
        $_shortlist_arr = $this->get_shortlist_archive_candidates();
        $_total = count($_shortlist_arr);
        endif;
        return $_total;
      }


  		function shortlist_total(){
  			$_total=0;
  			if($this->get_shortlist()):
  			$_shortlist_arr = $this->get_shortlist_candidates();
  			$_total = count($_shortlist_arr);
  			endif;
  			$_label = ' Candidate';
  			if($_total!=1) $_label = $_label.'s';
  			return $_total.$_label;
  		}

  		function candidate_added($_candidate){
  			if($this->get_shortlist()):
  				$_shortlist_arr = $this->get_shortlist_candidates();
  			if(in_array($_candidate,$_shortlist_arr)):
  				return true;
			endif;
			endif;
		return false;
  		}

      function submit_shortlist(){
        //send shortlist email to admin
        $email = new wp_email('shortlist-submission-admin');
        $message = $email->get_message();
        $user = $this->_user;
        $title = $email->get_title();
        $shortlist = $this->get_shortlist_candidates();
        $find = array('%title%','%shortlist%','%user_email%');
        $replace = array($title, $first_name, $login_url, $user_email );
        $html = str_replace($find, $replace, $message);
        @wp_mail(get_option('admin_email'), $email->get_subject(), $html);
        //send shortlist email to client
         $email = new wp_email('shortlist-submission');
        $message = $email->get_message();
        $title = $email->get_title();
        $first_name = $user->first_name;
        $user_email = $user->user_email;
        $find = array('%title%','%first_name%','%user_email%');
        $replace = array($title, $first_name, $user_email );
        $html = str_replace($find, $replace, $message);
        @wp_mail($user_email, $email->get_subject(), $html);
      }

  		function ajax_add_to_shortlist(){

  			$_error = false;
  			$_user_id  = $_POST['user_id'];
  			$_candidate = $_POST['candidate_id'];
  			$_meta = get_user_meta( $_user_id );
  			if($this->get_shortlist()):
  				$_shortlist_arr = $this->get_shortlist_candidates();
  			if(!in_array($_candidate,$_shortlist_arr)):
  				array_push($_shortlist_arr, $_candidate ); //add the candidate to the shortlist
  			endif;
  				$_shortlist_str = implode(',',$_shortlist_arr); //convert back to comma string
  			else: 
			$_shortlist_str = $_candidate;
  			endif;
  			update_user_meta($_user_id, '_shortlist', $_shortlist_str);
  			$this->_shortlist = $_shortlist_str;
  			$_shortlist_length = $this->shortlist_total($_user_id);

  			echo json_encode(array('error'=>$_error,'meta'=>get_user_meta($this->_user_id,'_shortlist',true),'shortlist'=>$_shortlist_str,'candidates'=>$_shortlist_length,'total'=>$this->total_shortlist_candidates()));
  			die();
  	}

  		function ajax_remove_from_shortlist(){
  			$_error=true;
  			$_user_id  = $_POST['user_id'];
  			$_candidate = $_POST['candidate_id'];
  			//if($this->get_shortlist()):
  			$_shortlist_arr = $this->get_shortlist_candidates();
  			for($i=0;$i<= count($_shortlist_arr);$i++):
  				if($_shortlist_arr[$i] == $_candidate):
  					if(count($_shortlist_arr)>=1):
  					unset($_shortlist_arr[$i]);
  				//$_new_shortlist_arr = array_values($_shortlist_arr);
  				//$_shortlist_arr = $_new_shortlist_arr;
  					else:
  						$_shortlist_arr = array();
  						endif;

  					
  					
  					
  				if(count($_shortlist_arr)>1):
  				$_shortlist_str = implode(',',$_shortlist_arr);
  				endif;
  				if(count($_shortlist_arr)==1):
  					$_shortlist_str= end($_shortlist_arr);
  					endif;
  				if(count($_shortlist_arr)==0):
  					$_shortlist_str='';
  				endif;
  				update_user_meta($_user_id, '_shortlist', $_shortlist_str);
  				//echo json_encode($_shortlist_arr);
  				//$this->_shortlist = $_shortlist_str;
  					$_error= false;
  					endif;
  				endfor;
  				//endif;
  				$_shortlist_length = count($_shortlist_arr);
  				echo json_encode(array('error'=>$_error,'meta'=>get_user_meta($this->_user_id,'_shortlist',true),'shortlist'=> $_shortlist_str,'candidates'=>$_shortlist_length,'total'=>0));
  				
  				
  				die();
  			}

  		
  }
  $shortlist = new shortlist();
  $shortlist->set_admin();

  	
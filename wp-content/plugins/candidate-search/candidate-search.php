<?php
/**
 * Plugin Name: Candidate Search
 * Description: Returns candidate search results
 * Version: 1.0
 * Author: Neil Mills
 * Author URI: http://www.digital-one.co.uk
 */

class candidate_search {

  	function __construct(){
  		add_action( 'init', array($this,'enqueue_scripts'), 0 );
  		add_action('wp_ajax_candidate_search', array($this, 'ajax_search_has_results')); 
  add_action( 'wp_ajax_nopriv_candidate_search', array($this, 'ajax_search_has_results')); //not logged in user
  		add_action( 'init', array($this,'register_shortcodes'), 0 );
  	}

  	function enqueue_scripts(){
  if(!is_admin()):
  //wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
   wp_enqueue_script( 'jquery' );
  wp_register_script( 'candidate_search', plugin_dir_url( __FILE__ ). 'libraries/candidate-search.js', false,null);
 wp_enqueue_script( 'candidate_search' );
 wp_localize_script( 'candidate_search', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    endif;
}


  	function get_search_query(){

 $meta = array(
  'reference',
  'graduation_year',
  'university',
  'out_of_hours',
  'weekends',
  'nights',
  'internship',
  'small_animal',
  'farm_animal',
  'equine',
  'exotics',
  'medicine',
  'surgery'
  );
$join="";
$and = "";
$or = "";
$j=2;
$c=1;
for($i=0; $i<count($meta);$i++):
if(isset($_POST[$meta[$i]]) and !empty($_POST[$meta[$i]])):
  $c++;
  $join.= " LEFT JOIN wp_usermeta AS um".$c." ON u.ID = um".$c.".user_id";
  $and .= " AND um".$c.".meta_key = '".$meta[$i]."' AND um".$c.".meta_value = '".$_POST[$meta[$i]]."'";
  $j = $c+1;
  endif;
endfor;


  if(isset($_POST['locations']) and !empty($_POST['locations'])):
    $join.= " LEFT JOIN wp_usermeta AS um".$j." ON u.ID = um".$j.".user_id";
    $locations = $_POST['locations'];
  $and .= " AND (";
foreach($locations as $location_id):
  if(!empty($or)):
    $or .=" OR ";
  endif;
$or .= "um".$j.".meta_key ='locations' AND FIND_IN_SET('".$location_id."', um".$j.".meta_value)";
  endforeach;
  $or.=")";
endif;
$sql = "SELECT u.ID
FROM wp_users AS u 
LEFT JOIN wp_usermeta AS um1 ON u.ID = um1.user_id";
$sql.= $join;
$sql.= " WHERE  um1.meta_key = 'wp_capabilities' AND um1.meta_value LIKE '%candidate%'";
$sql.= $and;
$sql.= $or;

return $sql;
  	}

  	function register_shortcodes(){
  		add_shortcode('candidate-search-results', array($this,'candidate_search_results'));
  	}


  	function candidate_search_results(){
      global $wpdb;
 if(!empty($_POST) and $_POST['search']==1):
  		ob_start();
  		$sql = $this->get_search_query();
   
  $candidates = $wpdb->get_results($sql);
 //print_r($candidates);
  		//$user_query = new WP_User_Query( $args );
  		$number = 10;
  		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
  		$offset = ($page - 1) * $number;
  		//$candidates = $user_query->get_results();
      $total_results = count($candidates);
		$total_pages = intval($total_results / $number) + 1;
		if(!empty($candidates)):
			foreach($candidates as $user):
      $user_id = $user->ID;
      //echo $user_id;
        include( locate_template( 'partials/content-candidate-loop.php' ));
			endforeach;
		endif;
		$output = ob_get_contents();
  		ob_end_clean();
  		return $output;
      endif;
  	}

  	function ajax_search_has_results(){
      global $wpdb;
  	$sql = $this->get_search_query();
    $candidates = $wpdb->get_results($sql);
		$total_results = count($candidates);
		if($total_results):
      echo json_encode(array('error'=>false,'total_results'=> $total_results));
		else:
    echo json_encode(array('error'=>true,'total_results'=> $total_results));
		endif;
		die();
  	}
//
  }

$search = new candidate_search();


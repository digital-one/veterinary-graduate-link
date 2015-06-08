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


  	function get_search_query($page,$number_posts, $order){

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
$j=2;
$c=1;

$or = "";

for($i=0; $i<count($meta);$i++):
if(isset($_REQUEST[$meta[$i]]) and !empty($_REQUEST[$meta[$i]])):
  $c++;
  $join.= " LEFT JOIN wp_usermeta AS um".$c." ON u.ID = um".$c.".user_id";
  $and .= " AND um".$c.".meta_key = '".$meta[$i]."' AND um".$c.".meta_value = '".$_REQUEST[$meta[$i]]."'";
  $j = $c+1;
  endif;
endfor;


  if(isset($_REQUEST['locations']) and !empty($_REQUEST['locations'])):
    $join.= " LEFT JOIN wp_usermeta AS um".$j." ON u.ID = um".$j.".user_id";
    $locations = $_REQUEST['locations'];
  $and .= " AND (";
foreach($locations as $location_id):
  if(!empty($or)):
    $or .=" OR ";
  endif;
$or .= "um".$j.".meta_key ='locations' AND FIND_IN_SET('".$location_id."', um".$j.".meta_value)";
  endforeach;
  $or.=")";
endif;
$sql = "SELECT u.ID, um.meta_value as ref
FROM wp_users AS u
LEFT JOIN wp_usermeta AS um1 ON u.ID = um1.user_id";
$sql.= " LEFT JOIN wp_usermeta um ON u.ID = um.user_id AND um.meta_key = 'reference'";
$sql.= $join;
$sql.= " WHERE um1.meta_key = 'wp_capabilities' AND um1.meta_value LIKE '%candidate%'";
$sql.= $and;
$sql.= $or;

$sql.= ' ORDER BY ref '.$order;

if($page):
  $start = ($page - 1) * $number_posts;
$sql.= ' LIMIT '.$start.', '.$number_posts;
  endif;

return $sql;
  	}

  	function register_shortcodes(){
  		add_shortcode('candidate-search-results', array($this,'candidate_search_results'));
  	}


  	function candidate_search_results($atts){
      global $post;
      global $wpdb;
       extract (shortcode_atts(array(
            'order'=>'DESC',
            'number_posts' => 2
            ),$atts));

 if(!empty($_REQUEST) and $_REQUEST['search']==1 or get_query_var('paged')):
  		ob_start();
    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
  	$sql = $this->get_search_query(0, -1,$order);
    //echo $sql.'<hr />';
    $all_candidates = $wpdb->get_results($sql);
    $total_candidates = count($all_candidates);
    $sql = $this->get_search_query($page, $number_posts,$order);
    // echo $sql.'<hr />';
    $candidates = $wpdb->get_results($sql);
 //print_r($candidates);
  		//$user_query = new WP_User_Query( $args );

  		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
  		//$offset = ($page - 1) * $number;
  		//$candidates = $user_query->get_results();
      $total_results = count($candidates);
      $total_pages = intval($total_candidates/ $number_posts) + 1;
echo '<div id="posts">';
		if(!empty($candidates)):
			foreach($candidates as $user):
      $user_id = $user->ID;
      //echo $user_id;
        include( locate_template( 'partials/content-candidate-loop.php' ));
			endforeach;
		endif;
echo '</div>';
   $current_page = max(1, get_query_var('paged'));
    if ($current_page < $total_pages):
  $next_page = $current_page+1;
    echo '<footer id="posts-footer"><a href="'.get_permalink($post->ID).'page/'.$next_page.'/" class="more-posts"><i class="fa fa-cog fa-spin"></i> Loading more results</a></footer>';
endif;
/*
    if ($total_candidates > $total_results):
        echo '<div id="pagination" class="clearfix">';
        echo '<span class="pages">Pages:</span>';
          $current_page = max(1, get_query_var('paged'));
          echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => 'page/%#%/',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_next'    => false,
                'type'         => 'list',
            ));
        echo '</div>';
    endif;
*/
		$output = ob_get_contents();
  		ob_end_clean();
  		return $output;
      endif;
  	}

  	function ajax_search_has_results(){
      global $wpdb;
  	$sql = $this->get_search_query(0, -1,'DESC');
    $candidates = $wpdb->get_results($sql);
		$total_results = count($candidates);
   // echo json_encode(array('sql'=>$sql,'results'=>$total_results));
   // die();
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


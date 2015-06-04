<?php

 class wp_email{

        
        var $_wp_email;
        
    function __construct($term) {

    	$this->set_email($term);
    }

    function get_subject(){
    	return get_post_meta( $this->_wp_email->ID, '_email_subject', true ); 
    }
    function get_title(){
    	return $this->_wp_email->post_title;
    }
    function get_body(){
    	return $this->_wp_email->post_content;
    }
	function get_header(){
		ob_start();
include plugin_dir_path( dirname( __FILE__ )) . '/templates/header.php';
$header= ob_get_contents();
ob_end_clean();
        return $header;
    }
    function get_footer(){
    	ob_start();
include plugin_dir_path( dirname( __FILE__ )) . '/templates/footer.php';
$footer= ob_get_contents();
ob_end_clean();
        return $footer;
    }
    function get_message(){
        $message  = $this->get_header();
        $message .= $this->get_body();
        $message.= $this->get_footer();
        return $message;
    }
	function set_email($term){
        $args = array(
        'post_type'=>'cpt-email',
        'post_status'=>'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'email_type',
                'field' => 'slug',
                'terms' => $term,
                'include_children' => false
            	)
        	)
   		);
        if($emails = get_posts($args)):
            $this->_wp_email =  $emails[0];
        endif;

    }

}


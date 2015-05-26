<?php
define( 'WP_USE_THEMES', FALSE );
require( '../../../wp-load.php' );
 if(isset($_POST)):
 	$role = $_POST['role'];
 	switch($role){
 	case 'employer':
 	$redirect = get_permalink(25);
 	break;
 	case 'candidate':
 	$redirect = get_permalink(21);
 	break;
 }
 	wp_redirect($redirect);
 	exit();
 endif;
 ?>
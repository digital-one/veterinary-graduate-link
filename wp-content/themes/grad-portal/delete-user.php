<?php
	define( 'WP_USE_THEMES', FALSE );
	require( '../../../wp-load.php' );
	require_once(ABSPATH.'wp-admin/includes/user.php' );
	$current_user = wp_get_current_user();
	$vgl_user = new gradportaluser($current_user);
	if($vgl_user->is_candidate()):
		update_user_meta($current_user->ID,'deleted',1); //if candidate update meta
	else:
	wp_delete_user( $current_user->ID ); // if employer, delete user
	endif;
	wp_logout();

	wp_redirect(home_url().'/?account-deleted=1');
	exit();
?>

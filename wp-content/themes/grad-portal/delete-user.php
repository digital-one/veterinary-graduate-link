<?php
	define( 'WP_USE_THEMES', FALSE );
	require( '../../../wp-load.php' );
	require_once(ABSPATH.'wp-admin/includes/user.php' );
	$current_user = wp_get_current_user();
	wp_delete_user( $current_user->ID );
	wp_logout();
	wp_redirect(home_url().'/?account-deleted=1');
	exit();
?>

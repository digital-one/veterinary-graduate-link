<?php

add_theme_support( 'menus' );

class navWalker extends Walker_Nav_Menu{

  function start_el (&$output, $item, $depth=0, $args=array(), $id=0){
  		global $vgl_user;
$item_output = '<a  href="' . $item->url. '">' . $item->title . '</a>';
  if($item->object_id==10):
  	if(!$vgl_user->is_logged_in()):
$item_output= '<a  class="notification-btn" rel="role-selection">Register</a>';
  		endif;
  		if($vgl_user->is_logged_in()):
  			$permalink = $vgl_user->get_profile_url();
$item_output= '<a  href="' . $permalink. '">' . $item->title . '</a>';
  			endif;
  		endif;

$classes = implode(" ",$item->classes);
    $output .= '<li class="'.$classes.'">' . apply_filters ('walker_nav_menu_start_el', $item_output, $item,  $depth, $args);
 //   $output .= '<li class="'.$classes.'">' . apply_filters ('walker_nav_menu_start_el', $item_output, $item,  $depth, $args);
   }
 }

 ?>
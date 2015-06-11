<?php

// Add custom functions
get_template_part('classes/class.gradportaluser');

require_once( 'includes/custom-functions.php' ); 
get_template_part('includes/users');
get_template_part('includes/gravity-forms');
get_template_part('includes/menus');
get_template_part('includes/post-types');
get_template_part('includes/images');
//get_template_part('includes/email');
//Classes

add_editor_style('css/style.css');
add_editor_style('css/editor-style.css');


function get_excerpt($post,$count){

  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'&hellip;';
  return $excerpt;
}


add_filter('manage_post_posts_columns', 'posts_columns_head', 10);
add_action('manage_post_posts_custom_column', 'posts_columns_content', 10, 2);


 function posts_columns_head($defaults) {
    $defaults['featured']  = 'Featured';
    $defaults['popular'] = 'Most Popular';
    return $defaults;
}
 
function posts_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured') {
        $featured = get_field('featured_post',$post_ID) ? 'Yes' : 'No';
        echo $featured;
    }
    if ($column_name == 'popular') {
         $popular = get_field('popular_post',$post_ID) ? 'Yes' : 'No';
        echo $popular;
    }
}

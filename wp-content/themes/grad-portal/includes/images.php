<?php 
// Add theme support post thumbnails
add_theme_support('post-thumbnails');


// Add image sizes
add_image_size( 'square-image', 320, 320, true );
//add_image_size( 'image', 800, 475, true );
//add_image_size( 'profile_image', 100, 100, true );
set_post_thumbnail_size( 180, 180,false); 

?>
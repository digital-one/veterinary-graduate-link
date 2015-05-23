<?php
global $wpseo_admin;
// Extend Users

add_action( 'show_user_profile', 'show_extra_profile_fields' );
add_action( 'edit_user_profile', 'show_extra_profile_fields' );
add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );

function save_extra_profile_fields( $user_id ) {
 
     if ( !current_user_can( 'edit_user', $user_id ) )
          return false;
 
     update_usermeta( $user_id, 'please_tell_us_about_yourself', $_POST['please_tell_us_about_yourself'] );
     update_usermeta( $user_id, 'title', $_POST['title'] );
     update_usermeta( $user_id, 'address', $_POST['address'] );
     update_usermeta( $user_id, 'address_2', $_POST['address_2'] );
     update_usermeta( $user_id, 'address_3', $_POST['address_3'] );
     update_usermeta( $user_id, 'town_city', $_POST['town_city'] );
     update_usermeta( $user_id, 'county', $_POST['county'] );
     update_usermeta( $user_id, 'postcode', $_POST['postcode'] );
     update_usermeta( $user_id, 'country', $_POST['country'] );
     update_usermeta( $user_id, 'date_of_birth', $_POST['date_of_birth'] );
     update_usermeta( $user_id, 'telephone', $_POST['telephone'] );
}

function show_extra_profile_fields($user){
echo '<h3>Extra Profile Information</h3>
<table class="form-table">
<tbody>';
echo '<tr><th><label for="title">Title</label></th><td><input id="title" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'title', $user->ID)).'" name="title" /></td></tr>';
echo '<tr><th><label for="please_tell_us_about_yourself">Member Type</label></th><td><input id="please_tell_us_about_yourself" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'please_tell_us_about_yourself', $user->ID)).'" name="please_tell_us_about_yourself" /></td></tr>';
echo '<tr><th><label for="address">Address</label></th><td><input id="address" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'address', $user->ID)).'" name="address" /></td></tr>';
echo '<tr><th><label for="address_2">Address 2</label></th><td><input id="address_2" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'address_2', $user->ID)).'" name="address_2" /></td></tr>';
echo '<tr><th><label for="address_3">Address 3</label></th><td><input id="address_3" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'address_3', $user->ID)).'" name="address_3" /></td></tr>';
echo '<tr><th><label for="town_city">Town/City</label></th><td><input id="town_city" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'town_city', $user->ID)).'" name="town_city" /></td></tr>';
echo '<tr><th><label for="county">County</label></th><td><input id="county" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'county', $user->ID)).'" name="county" /></td></tr>';
echo '<tr><th><label for="postcode">Postcode</label></th><td><input id="postcode" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'postcode', $user->ID)).'" name="postcode" /></td></tr>';
echo '<tr><th><label for="country">Country</label></th><td><input id="country" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'country', $user->ID)).'" name="country" /></td></tr>';
echo '<tr><th><label for="date_of_birth">Date of Birth</label></th><td><input id="date_of_birth" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'date_of_birth', $user->ID)).'" name="date_of_birth" /></td></tr>';
echo '<tr><th><label for="telephone">Telephone</label></th><td><input id="telephone" class="regular-text" type="text" value="'.esc_attr( get_the_author_meta( 'telephone', $user->ID)).'" name="telephone" /></td></tr>';
echo '</tbody></table>';
}

add_role(
    'candidate',
    __( 'Candidate' ),
    array(
        'read'         => true,  
        'edit_posts'   => false,
        'delete_posts' => false 
    )
);
add_role(
    'employer',
    __( 'Employer' ),
    array(
        'read'         => true,  
        'edit_posts'   => false,
        'delete_posts' => false 
    )
);


# this removes when editing 'YOUR PROFILE'
remove_action( 'show_user_profile', array( $wpseo_admin, 'user_profile' ) );

# this removes when editing 'EDIT PROFILE'
remove_action( 'edit_user_profile', array( $wpseo_admin, 'user_profile' ) );




?>
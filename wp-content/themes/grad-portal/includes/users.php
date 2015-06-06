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
    
    $user = get_user_by('id',$user_id);
      $gp_user = new gradportaluser($user);
      if($gp_user->is_candidate()):

        $out_of_hours = isset($_POST['out_of_hours']) ? $_POST['out_of_hours'] : '';
        $weekends = isset($_POST['weekends']) ? $_POST['weekends'] : '';
        $nights = isset($_POST['nights']) ? $_POST['nights'] : '';
        $internship = isset($_POST['internship']) ? $_POST['internship'] : '';
        $small_animal = isset($_POST['small_animal']) ? $_POST['small_animal'] : '';
        $farm_animal = isset($_POST['farm_animal']) ? $_POST['farm_animal'] : '';
        $equine = isset($_POST['equine']) ? $_POST['equine'] : '';
        $exotics = isset($_POST['exotics']) ? $_POST['exotics'] : '';
        $medicine = isset($_POST['medicine']) ? $_POST['medicine'] : '';
        $surgery = isset($_POST['surgery']) ? $_POST['surgery'] : '';
        $locations = isset($_POST['locations']) ? $_POST['locations'] : '';
         update_user_meta( $user_id, 'reference', $_POST['reference'] );
     update_user_meta( $user_id, 'telephone_no', $_POST['telephone_no'] );
     update_user_meta( $user_id, 'mobile_no', $_POST['mobile_no'] );
     update_user_meta( $user_id, 'postcode', $_POST['postcode'] );
     update_user_meta( $user_id, 'graduation_year', $_POST['graduation_year'] );
     update_user_meta( $user_id, 'university', $_POST['university'] );
     update_user_meta( $user_id, 'locations', $locations );
     update_user_meta( $user_id, 'out_of_hours', $out_of_hours);
     update_user_meta( $user_id, 'weekends', $weekends);
     update_user_meta( $user_id, 'nights', $nights );
     update_user_meta( $user_id, 'internship', $internship );
     update_user_meta( $user_id, 'small_animal', $small_animal );
     update_user_meta( $user_id, 'farm_animal', $farm_animal );
     update_user_meta( $user_id, 'equine', $equine);
     update_user_meta( $user_id, 'exotics', $exotics );
     update_user_meta( $user_id, 'medicine', $medicine );
     update_user_meta( $user_id, 'surgery', $surgery);
     endif;
     if($gp_user->is_employer()):
    // print_r($_POST);
 //die();
        $out_of_hours = isset($_POST['ca_out_of_hours']) ? $_POST['ca_out_of_hours'] : '';
        $weekends = isset($_POST['ca_weekends']) ? $_POST['ca_weekends'] : '';
        $nights = isset($_POST['ca_nights']) ? $_POST['ca_nights'] : '';
        $internship = isset($_POST['ca_internship']) ? $_POST['ca_internship'] : '';
        $small_animal = isset($_POST['ca_small_animal']) ? $_POST['ca_small_animal'] : '';
        $farm_animal = isset($_POST['ca_farm_animal']) ? $_POST['ca_farm_animal'] : '';
        $equine = isset($_POST['ca_equine']) ? $_POST['ca_equine'] : '';
        $exotics = isset($_POST['ca_exotics']) ? $_POST['ca_exotics'] : '';
        $medicine = isset($_POST['ca_medicine']) ? $_POST['ca_medicine'] : '';
        $surgery = isset($_POST['ca_surgery']) ? $_POST['ca_surgery'] : '';
        $locations = isset($_POST['ca_locations']) ? $_POST['ca_locations'] : '';
     update_user_meta( $user_id, 'organisation_name', $_POST['organisation_name'] );  
     update_user_meta( $user_id, 'telephone_no', $_POST['telephone_no'] );
    update_user_meta( $user_id, 'postcode', $_POST['postcode'] );
     update_user_meta( $user_id, 'ca_graduation_year', $_POST['ca_graduation_year'] );
       update_user_meta( $user_id, 'ca_university', $_POST['ca_university'] );
     update_user_meta( $user_id, 'ca_locations', $locations );
     update_user_meta( $user_id, 'ca_out_of_hours', $out_of_hours );
     update_user_meta( $user_id, 'ca_weekends', $weekends );
     update_user_meta( $user_id, 'ca_nights', $nights );
     update_user_meta( $user_id, 'ca_internship', $internship );
     update_user_meta( $user_id, 'ca_small_animal', $small_animal);
     update_user_meta( $user_id, 'ca_farm_animal', $farm_animal );
     update_user_meta( $user_id, 'ca_equine', $equine );
     update_user_meta( $user_id, 'ca_exotics', $exotics );
     update_user_meta( $user_id, 'ca_medicine', $medicine );
     update_user_meta( $user_id, 'ca_surgery', $surgery );
     endif;
}

function show_extra_profile_fields($user){
    $gp_user = new gradportaluser($user);
    if($gp_user->is_candidate()):
        ?>
<h3>Candidate Profile Information</h3>
<table class="form-table">
<tbody>
  <tr><th><label for="reference">Reference</label></th><td><input id="reference" class="regular-text" type="text" value="<?php echo esc_attr( get_the_author_meta( 'reference', $user->ID))?>" name="reference" /></td></tr>
<tr><th><label for="telephone_no">Telephone</label></th><td><input id="telephone_no" class="regular-text" type="text" value="<?php echo esc_attr( get_the_author_meta( 'telephone_no', $user->ID))?>" name="telephone_no" /></td></tr>
<tr><th><label for="mobile_no">Mobile</label></th><td><input id="mobile_no" class="regular-text" type="text" value="<?php echo  esc_attr( get_the_author_meta( 'mobile_no', $user->ID)) ?>" name="mobile_no" /></td></tr>
<tr><th><label for="postcode">Postcode</label></th><td><input id="postcode" class="regular-text" type="text" value="<?php echo  esc_attr( get_the_author_meta( 'postcode', $user->ID)) ?>" name="postcode" /></td></tr>
<tr><th><label for="graduation_year">Graduation Year</label></th><td>
<select id="graduation_year" name="graduation_year">
    <option value="">Graduation Year</option>
   <?php
    $year = date('Y');
      for($i=0;$i<10;$i++):
         $val = $year-$i;
        $selected = get_the_author_meta( 'graduation_year', $user->ID)== $val ? ' selected="selected"' : '';
    echo '<option value="'.$val.'"'.$selected.'>'.$val.'</option>';
      endfor;
    ?>
</select>
</td></tr>
<tr><th><label for="university">University</label></th><td>
<select id="university" name="university">
    <option value="">University</option>
  <?php
  $args = array(
    'post_type' => 'cpt-university',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
    );
      if($unis= get_posts($args)):
        foreach($unis as $uni):
           $selected = get_the_author_meta( 'university', $user->ID)== $uni->ID ? ' selected="selected"' : '';  
            echo '<option value="'.$uni->ID.'"'.$selected.'>'.$uni->post_title.'</option>';
          endforeach;
      endif;
?>
</select>
</td></tr>
<tr><th><label for="locations">Locations</label></th><td>
 <?php  
 if(is_array(get_the_author_meta( 'locations', $user->ID))):
 $selected_locations = get_the_author_meta( 'locations', $user->ID);
else :
$selected_locations = explode(',',get_the_author_meta( 'locations', $user->ID));
    endif;
  ?>
<select multiple id="locations" name="locations[]">
    <option value="">Locations</option>
 <?php
       $args = array(
          'orderby'=>'title',
          'order'=>'ASC',
          'hide_empty'=>0
          );
    if($terms = get_terms('region',$args)):
      foreach($terms as $term):
        //check if region has more than 1 location
    $args = array(
    'post_type' => 'cpt-location',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => array(
      array(
      'taxonomy' => 'region',
      'field' => 'id',
      'terms' => $term->term_id
      )
    ),
    'orderby' => 'name',
    'order' => 'ASC'
    );
  $locations = get_posts($args);
  $num_locations = count($locations);
  if($num_locations>1):
    echo '<optgroup label="'.$term->name.'">';
  endif;
      // get the associated locations
  if($locations):
  foreach($locations as $location):
         $selected = in_array($location->ID, $selected_locations) ? ' selected="selected"' : '';  
    echo '<option value="'.$location->ID.'"'.$selected.'>'.$location->post_title.'</option>';
      endforeach;
    endif;
     if($num_locations>1):
    echo '</optgroup>';
  endif;
    endforeach;
    endif;
    ?>
</select>
</td></tr>
<tr><th><label for="cv">CV</label></th><td><input id="cv" class="regular-text" type="text" value="<?php echo esc_attr( get_the_author_meta( 'cv', $user->ID)) ?>" name="cv" /></td></tr>

<tr>
<th scope="row">Please select if you are willing to work:</th>
<td>
    <fieldset><legend class="screen-reader-text"><span></span></legend>
         <?php $checked = get_the_author_meta( 'out_of_hours', $user->ID)=='out of hours' ? ' checked="checked"' : ''; ?>
    <label for="out_of_hours"><input type="checkbox" name="out_of_hours" value="out of hours"<?php echo $checked ?>> Out of hours</label><br>
      <?php $checked = get_the_author_meta( 'weekends', $user->ID)=='weekends' ? ' checked="checked"' : ''; ?>
    <label for="weekends"><input type="checkbox" name="weekends" value="weekends"<?php echo $checked ?>> Weekends</label><br>
     <?php $checked = get_the_author_meta( 'nights', $user->ID)=='nights' ? ' checked="checked"' : ''; ?>
    <label for="nights"><input type="checkbox" name="nights" value="nights"<?php echo $checked ?>> Nights</label><br>
      <?php $checked = get_the_author_meta( 'internship', $user->ID)=='internship' ? ' checked="checked"' : ''; ?>
    <label for="internship"><input type="checkbox" name="internship" value="internship"<?php echo $checked ?>> Internship</label>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row">Please select your basic interests:</th>
<td>
    <fieldset><legend class="screen-reader-text"><span></span></legend>
         <?php $checked = get_the_author_meta( 'small_animal', $user->ID)=='small animal' ? ' checked="checked"' : ''; ?>
    <label for="small_animal"><input type="checkbox" name="small_animal" value="small animal"<?php echo $checked ?>> Small Animal</label><br>
      <?php $checked = get_the_author_meta( 'farm_animal', $user->ID)=='farm animal' ? ' checked="checked"' : ''; ?>
    <label for="farm_animal"><input type="checkbox" name="farm_animal" value="farm animal"<?php echo $checked ?>> Farm Animal</label><br>
     <?php $checked = get_the_author_meta( 'equine', $user->ID)=='equine' ? ' checked="checked"' : ''; ?>
    <label for="equine"><input type="checkbox" name="equine" value="equine"<?php echo $checked ?>> Equine</label><br>
      <?php $checked = get_the_author_meta( 'exotics', $user->ID)=='exotics' ? ' checked="checked"' : ''; ?>
    <label for="exotics"><input type="checkbox" name="exotics" value="exotics"<?php echo $checked ?>> Exotics</label>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row">Please select your further interests:</th>
<td>
    <fieldset><legend class="screen-reader-text"><span></span></legend>
         <?php $checked = get_the_author_meta( 'medicine', $user->ID)=='medicine' ? ' checked="checked"' : ''; ?>
    <label for="medicine"><input type="checkbox" name="medicine" value="medicine"<?php echo $checked ?>> Medicine</label><br>
      <?php $checked = get_the_author_meta( 'surgery', $user->ID)=='surgery' ? ' checked="checked"' : ''; ?>
    <label for="surgery"><input type="checkbox" name="surgery" value="surgery"<?php echo $checked ?>> Surgery</label>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row">Bio</th>
<td><fieldset><legend class="screen-reader-text"><span>Bio</span></legend>
<p><label for="bio">Please write a short bio on yourself in the space provided</label></p>
<p>
<textarea name="bio" rows="10" cols="50" id="bio" class="large-text code"><?php echo esc_attr( get_the_author_meta( 'bio', $user->ID)) ?></textarea>
</p>
</fieldset></td>
</tr>
</tbody></table>
<?php
endif;
 if($gp_user->is_employer()):
        ?>
<h3>Employer Profile Information</h3>

<table class="form-table">
<tbody>
    <tr><th><label for="organisation_name">Organisation Name</label></th><td><input id="organisation_name" class="regular-text" type="text" value="<?php echo esc_attr( get_the_author_meta( 'organisation_name', $user->ID))?>" name="organisation_name" /></td></tr>
<tr><th><label for="telephone_no">Telephone</label></th><td><input id="telephone_no" class="regular-text" type="text" value="<?php echo esc_attr( get_the_author_meta( 'telephone_no', $user->ID))?>" name="telephone_no" /></td></tr>
<tr><th><label for="postcode">Postcode</label></th><td><input id="postcode" class="regular-text" type="text" value="<?php echo  esc_attr( get_the_author_meta( 'postcode', $user->ID)) ?>" name="postcode" /></td></tr>
</tbody>
</table>
<h3>Candidate Alerts</h3>

<table class="form-table">
    <tbody>
        <tr><th><label for="ca_graduation_year">Graduation Year</label></th><td>
<select id="ca_graduation_year" name="ca_graduation_year">
    <option value="">Graduation Year</option>
   <?php
    $year = date('Y');
      for($i=0;$i<10;$i++):
             $val = $year-$i;
        $selected = get_the_author_meta( 'ca_graduation_year', $user->ID)== $val ? ' selected="selected"' : '';
   
        echo '<option value="'.$val.'"'.$selected.'>'.$val.'</option>';
      endfor;
    ?>
</select>
</td></tr>
<tr><th><label for="ca_university">University</label></th><td>
<select id="university" name="ca_university">
    <option value="">University</option>
  <?php
  $args = array(
    'post_type' => 'cpt-university',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
    );
      if($unis= get_posts($args)):
        foreach($unis as $uni):
           $selected = get_the_author_meta( 'ca_university', $user->ID)== $uni->ID ? ' selected="selected"' : '';  
            echo '<option value="'.$uni->ID.'"'.$selected.'>'.$uni->post_title.'</option>';
          endforeach;
      endif;
?>
</select>
</td></tr>
<tr><th><label for="locations">Locations</label></th><td>
 <?php  
 if(is_array(get_the_author_meta( 'ca_locations', $user->ID))):
 $selected_locations = get_the_author_meta( 'ca_locations', $user->ID);
else :
 $selected_locations = explode(',',get_the_author_meta( 'ca_locations', $user->ID));
    endif;
  ?>
<select multiple id="ca_locations" name="ca_locations[]">
    <option value="">Locations</option>
 <?php
       $args = array(
          'orderby'=>'title',
          'order'=>'ASC',
          'hide_empty'=>0
          );
    if($terms = get_terms('region',$args)):
      foreach($terms as $term):
        //check if region has more than 1 location
    $args = array(
    'post_type' => 'cpt-location',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => array(
      array(
      'taxonomy' => 'region',
      'field' => 'id',
      'terms' => $term->term_id
      )
    ),
    'orderby' => 'name',
    'order' => 'ASC'
    );
  $locations = get_posts($args);
  $num_locations = count($locations);
  if($num_locations>1):
    echo '<optgroup label="'.$term->name.'">';
  endif;
      // get the associated locations
  if($locations):
  foreach($locations as $location):
         $selected = in_array($location->ID, $selected_locations) ? ' selected="selected"' : '';  
    echo '<option value="'.$location->ID.'"'.$selected.'>'.$location->post_title.'</option>';
      endforeach;
    endif;
     if($num_locations>1):
    echo '</optgroup>';
  endif;
    endforeach;
    endif;
    ?>
</select>
</td></tr>
<tr>
<th scope="row">Please select if you are willing to work:</th>
<td>
    <fieldset><legend class="screen-reader-text"><span></span></legend>
         <?php $checked = get_the_author_meta( 'ca_out_of_hours', $user->ID)=='out of hours' ? ' checked="checked"' : ''; ?>
    <label for="ca_out_of_hours"><input type="checkbox" name="ca_out_of_hours" value="out of hours"<?php echo $checked ?>> Out of hours</label><br>
      <?php $checked = get_the_author_meta( 'ca_weekends', $user->ID)=='weekends' ? ' checked="checked"' : ''; ?>
    <label for="ca_weekends"><input type="checkbox" name="ca_weekends" value="weekends"> Weekends</label><br>
     <?php $checked = get_the_author_meta( 'ca_nights', $user->ID)=='nights' ? ' checked="checked"' : ''; ?>
    <label for="ca_nights"><input type="checkbox" name="ca_nights" value="nights"<?php echo $checked ?>> Nights</label><br>
      <?php $checked = get_the_author_meta( 'ca_internship', $user->ID)=='internship' ? ' checked="checked"' : ''; ?>
    <label for="ca_internship"><input type="checkbox" name="ca_internship" value="internship"<?php echo $checked ?>> Internship</label>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row">Please select your basic interests:</th>
<td>
    <fieldset><legend class="screen-reader-text"><span></span></legend>
         <?php $checked = get_the_author_meta( 'ca_small_animal', $user->ID)=='small animal' ? ' checked="checked"' : ''; ?>
    <label for="ca_small_animal"><input type="checkbox" name="ca_small_animal" value="small animal"<?php echo $checked ?>> Small Animal</label><br>
      <?php $checked = get_the_author_meta( 'ca_farm_animal', $user->ID)=='farm animal' ? ' checked="checked"' : ''; ?>
    <label for="ca_farm_animal"><input type="checkbox" name="ca_farm_animal" value="farm animal"<?php echo $checked ?>> Farm Animal</label><br>
     <?php $checked = get_the_author_meta( 'ca_equine', $user->ID)=='equine' ? ' checked="checked"' : ''; ?>
    <label for="ca_equine"><input type="checkbox" name="ca_equine" value="equine"<?php echo $checked ?>> Equine</label><br>
      <?php $checked = get_the_author_meta( 'ca_exotics', $user->ID)=='exotics' ? ' checked="checked"' : ''; ?>
    <label for="ca_exotics"><input type="checkbox" name="ca_exotics" value="exotics"<?php echo $checked ?>> Exotics</label>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row">Please select your further interests:</th>
<td>
    <fieldset><legend class="screen-reader-text"><span></span></legend>
         <?php $checked = get_the_author_meta( 'ca_medicine', $user->ID)=='medicine' ? ' checked="checked"' : ''; ?>
    <label for="ca_medicine"><input type="checkbox" name="ca_medicine" value="medicine"<?php echo $checked ?>> Medicine</label><br>
      <?php $checked = get_the_author_meta( 'ca_surgery', $user->ID)=='surgery' ? ' checked="checked"' : ''; ?>
    <label for="ca_surgery"><input type="checkbox" name="ca_surgery" value="surgery"<?php echo $checked ?>> Surgery</label>
    </fieldset>
</td>
</tr>

</tbody>
</table>
<?php 
endif;
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
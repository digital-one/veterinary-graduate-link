<?php

add_filter( 'gform_field_input', 'change_password_structure', 10, 5 );
//add_filter( 'gform_field_choices', 'checkbox_choices', 10, 2 );
add_filter( 'gform_field_input', 'change_checkbox_structure', 10, 5 );
add_filter( 'gform_field_input', 'change_radio_structure', 10, 5 );
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
add_filter( 'gform_ajax_spinner_url', 'custom_gform_spinner' );
add_filter( 'excerpt_more', 'new_excerpt_more' );
add_filter("gform_confirmation_anchor", create_function("","return false;")); //return false after ajax submit

add_filter( 'gform_pre_render_7', 'change_field_html' );
add_action("gform_user_registration_validation", "validate_password", 10, 3); //custom validation of the password
add_filter("gform_user_registration_validation_message", "update_validation_msgs", 10, 2); //change the default username validation msg as were using email address

//populate gravity forms dropdown menus with locations
add_filter( 'gform_pre_render_1', 'populate_locations' );
add_filter( 'gform_pre_validation_1', 'populate_locations' );
add_filter( 'gform_pre_submission_filter_1', 'populate_locations' );
add_filter( 'gform_admin_pre_render_1', 'populate_locations' );

add_filter( 'gform_pre_render_2', 'populate_locations' );
add_filter( 'gform_pre_validation_2', 'populate_locations' );
add_filter( 'gform_pre_submission_filter_2', 'populate_locations' );
add_filter( 'gform_admin_pre_render_2', 'populate_locations' );

add_filter( 'gform_pre_render_5', 'populate_locations' );
add_filter( 'gform_pre_validation_5', 'populate_locations' );
add_filter( 'gform_pre_submission_filter_5', 'populate_locations' );
add_filter( 'gform_admin_pre_render_5', 'populate_locations' );

add_filter( 'gform_pre_render_6', 'populate_locations' );
add_filter( 'gform_pre_validation_6', 'populate_locations' );
add_filter( 'gform_pre_submission_filter_6', 'populate_locations' );
add_filter( 'gform_admin_pre_render_6', 'populate_locations' );

//populate dropdown menus with unis

add_filter( 'gform_pre_render_1', 'populate_universities' );
add_filter( 'gform_pre_validation_1', 'populate_universities' );
add_filter( 'gform_pre_submission_filter_1', 'populate_universities' );
add_filter( 'gform_admin_pre_render_1', 'populate_universities' );

add_filter( 'gform_pre_render_2', 'populate_universities' );
add_filter( 'gform_pre_validation_2', 'populate_universities' );
add_filter( 'gform_pre_submission_filter_2', 'populate_universities' );
add_filter( 'gform_admin_pre_render_2', 'populate_universities' );

add_filter( 'gform_pre_render_5', 'populate_universities' );
add_filter( 'gform_pre_validation_5', 'populate_universities' );
add_filter( 'gform_pre_submission_filter_5', 'populate_universities' );
add_filter( 'gform_admin_pre_render_5', 'populate_universities' );

add_filter( 'gform_pre_render_6', 'populate_universities' );
add_filter( 'gform_pre_validation_6', 'populate_universities' );
add_filter( 'gform_pre_submission_filter_6', 'populate_universities' );
add_filter( 'gform_admin_pre_render_6', 'populate_universities' );

//populate dropdown menus with graduation years

add_filter( 'gform_pre_render_1', 'populate_graduation_years' );
add_filter( 'gform_pre_validation_1', 'populate_graduation_years' );
add_filter( 'gform_pre_submission_filter_1', 'populate_graduation_years' );
add_filter( 'gform_admin_pre_render_1', 'populate_graduation_years' );

add_filter( 'gform_pre_render_2', 'populate_graduation_years' );
add_filter( 'gform_pre_validation_2', 'populate_graduation_years' );
add_filter( 'gform_pre_submission_filter_2', 'populate_graduation_years' );
add_filter( 'gform_admin_pre_render_2', 'populate_graduation_years' );

add_filter( 'gform_pre_render_5', 'populate_graduation_years' );
add_filter( 'gform_pre_validation_5', 'populate_graduation_years' );
add_filter( 'gform_pre_submission_filter_5', 'populate_graduation_years' );
add_filter( 'gform_admin_pre_render_5', 'populate_graduation_years' );

add_filter( 'gform_pre_render_6', 'populate_graduation_years' );
add_filter( 'gform_pre_validation_6', 'populate_graduation_years' );
add_filter( 'gform_pre_submission_filter_6', 'populate_graduation_years' );
add_filter( 'gform_admin_pre_render_6', 'populate_graduation_years' );

//populate dynamic values into hidden fields
add_filter('gform_field_value_user_firstname', 'firstname_population');
add_filter('gform_field_value_user_surname', 'surname_population');
add_filter('gform_field_value_user_organisation', 'organisation_population');
add_filter('gform_field_value_user_email', 'email_population');
add_filter('gform_field_value_user_telephone', 'telephone_population');
add_filter('gform_field_value_user_postcode', 'postcode_population');
add_filter('gform_field_value_user_shortlist', 'shortlist_population');
add_filter('gform_field_value_user_reference', 'reference_population');
add_filter( 'gform_notification', 'change_shortlist_user_email', 10, 3 ); //change the user notification email address to be dynamic
add_filter("gform_disable_notification", "disable_notification", 10, 4); //disable notifications


function disable_notification($is_disabled, $notification, $form, $entry){
 

    if($notification["name"] == "Candidate Registration User Notification" or $notification["name"] == "Employer Registration User Notification"){
        return true;
    }
  return $is_disabled;
}


function change_shortlist_user_email( $notification, $form, $entry ) {
  global $current_user;
  $gp_user = new gradportaluser($current_user);

    if ( $notification['name'] == 'Shortlist User Notification' ):
        $notification['toType'] = 'email'; 
        $notification['to'] = $gp_user->get_email();
    endif;
return $notification;
}

function firstname_population(){
  global $current_user;
  $gp_user = new gradportaluser($current_user);
  return $gp_user->get_firstname();
}
function surname_population(){
  global $current_user;
  $gp_user = new gradportaluser($current_user);
  return $gp_user->get_surname();
}
function email_population(){
  global $current_user;
  $gp_user = new gradportaluser($current_user);
  return $gp_user->get_email();
}

function organisation_population(){
  global $current_user;
  $gp_user = new gradportaluser($current_user);
  return $gp_user->get_organisation();
}
function telephone_population(){
  global $current_user;
  $gp_user = new gradportaluser($current_user);
  return $gp_user->get_telephone();
}
function postcode_population(){
  global $current_user;
  $gp_user = new gradportaluser($current_user);
  return $gp_user->get_postcode();
}
function shortlist_population(){
  global $current_user;
  $shortlist = new shortlist();
  $shortlist->set_current_user($current_user);
  return $shortlist->get_shortlist_candidate_refs();
}
function reference_population(){
   global $wpdb;
    $sql = "SELECT u.*, um.meta_value as ref FROM wp_users as u LEFT JOIN wp_usermeta um ON u.ID = um.user_id AND um.meta_key = 'reference'  LEFT JOIN wp_usermeta AS um1 ON u.ID = um1.user_id  WHERE um1.meta_key = 'wp_capabilities' AND um1.meta_value LIKE '%candidate%' AND u.ID = um.user_id AND um.meta_key='reference'  ORDER By user_registered DESC LIMIT 1";
    $candidate = $wpdb->get_row($sql);
    $ref = $candidate->ref;
    //$ref = get_user_meta($candidate->ID,'reference',true);
    $next_ref = ($ref+1);
    if($next_ref<10000) $leading='00';
    if($next_ref>= 10000  and $next_ref < 100000) $leading='0';
    return $leading.$next_ref;
}

/**
* Gravity Forms Custom Activation Template
* http://gravitywiz.com/customizing-gravity-forms-user-registration-activation-page
*/
add_action('wp', 'custom_maybe_activate_user', 9);
function custom_maybe_activate_user() {
$template_path = STYLESHEETPATH . '/gfur-activate-template/activate.php';
$is_activate_page = isset( $_GET['page'] ) && $_GET['page'] == 'gf_activation';
if( ! file_exists( $template_path ) || ! $is_activate_page )
return;
require_once( $template_path );
exit();
} 

function populate_graduation_years($form){
  foreach ( $form['fields'] as &$field ) :
        if ( $field->type != 'select' || strpos( $field->cssClass, 'grad-years' ) === false ):
          continue;
        endif;
        $choices = array();
      $year = date('Y');
      for($i=0;$i<2;$i++):
        $choices[] = array('text'=>$year-$i,'value'=>$year-$i);
      endfor;
 $field->placeholder = 'Graduation Year';
    $field->choices = $choices;
      endforeach;
       return $form;
}

function populate_universities( $form){

   foreach ( $form['fields'] as &$field ) :
        if ( $field->type != 'select' || strpos( $field->cssClass, 'universities' ) === false ):
          continue;
        endif;
      $choices=array();
      $args = array(
    'post_type' => 'cpt-university',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
    );
      if($unis= get_posts($args)):
        foreach($unis as $uni):
           //$choices[] = array('text'=> $uni->post_title, 'value'=>$uni->ID);
         $choices[] = array('text'=> $uni->post_title, 'value'=>$uni->post_title);
          endforeach;
        endif;
      $field->placeholder = 'All Universities';
      if($form['id']==1 or $form['id']==5):
 $field->placeholder = 'University of Study';
        endif;
    $field->choices = $choices;
    endforeach;
    return $form;
}

function populate_locations( $form ) {

  foreach ( $form['fields'] as &$field ) :
        if ( $field->type != 'multiselect' || strpos( $field->cssClass, 'locations' ) === false ):
            continue;
        endif;
        $choices = array();
  //get the location regions
        $args = array(
          'orderby'=>'title',
          'order'=>'ASC',
          'hide_empty'=>0
          );
    if($terms = get_terms('region',$args)):
      foreach($terms as $term):
        //check if more than 1 location in region

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
    $choices[] = array('text' => $term->name, 'value'=>'start');
  endif;
      // get the associated locations
  if($locations):
  foreach($locations as $location):
     //$choices[] = array('text'=> $location->post_title, 'value'=>$location->ID);
     $choices[] = array('text'=> $location->post_title, 'value'=>$location->post_title);
      endforeach;
    endif;
    endforeach;
    endif;
    $field->placeholder = 'Locations';
    $field->choices = $choices;
    endforeach;
    return $form;
  }





function update_validation_msgs($message, $form){
    if($message == 'The username can not be empty')
        $message = 'Please enter your email address';
    
    return $message;
}


function validate_password($form, $config, $pagenum){
  $error=false;
 //endif;
 foreach( $form['fields'] as &$field ):
     $password = rgpost( 'input_' . $field->id );
    $confirm  = rgpost( 'input_' . $field->id . '_2' );
    $input_type = RGFormsModel::get_input_type($field);
  $is_required = $field['isRequired'];
    if($input_type == "password"): 
//if( $field['id'] == $password_field_id):
  if(empty($password) and $is_required):
     $field['failed_validation'] = true;
     $field['validation_message'] = 'Please enter a password';
     $error=true;
    endif;
    if(!$error):

if($password != $confirm and $password!=""):
    $field['failed_validation'] = true;
     $field['validation_message'] = 'Passwords dont match';
     $error=true;
  endif;
  endif;
  if(!$error):
$pattern = get_option('reset_pwd_valid_pattern');
     $pattern = !empty($pattern) ? $pattern : '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/'; //at least 8 chars long containing an uppercase letter and number;
if( !preg_match( $pattern, $password ) and $password!=""):
  $field['failed_validation'] = true;
       $msg = get_option('reset_pwd_format_error_msg');
        $msg = !empty($msg) ? $msg : "Password must be at least 8 chars long containing at least one uppercase letter and number";
  $field['validation_message'] = $msg;
endif;
endif;
endif;
endforeach;
return $form;
}



function change_field_html($form){

        foreach ( $form['fields'] as &$field ):
         // print_r($field);
          $html='';
          if($field['type']=='gf_no_captcha_recaptcha'):
            $field_id = $field['id'];
            
         // echo $field_id;
             $field->content = 'new content';
            endif;
          endforeach;
         
          return $form;
}

function subsection_field($content, $field, $value, $lead_id, $form_id){
  if($field['type']=='gf_no_captcha_recaptcha'):
   $content="<li>dddd</li>";
   endif;
 return $content;

}

function form_submit_button( $button, $form ) {
    return "<button class='icon-button tick' id='gform_submit_button_{$form['id']}'><span>".$form['button']['text']."</span></button>";
}
function custom_gform_spinner(){
	return get_stylesheet_directory_uri().'/images/spin.svg';
}


function check_password_match_can( $validation_result ){
 
  // this is making sure the passwords match
  if( $_POST['input_22'] != $_POST['input_24'] ) {
 
    // marking the whole form as not valid
    $validation_result['is_valid'] = false;
 
    // looping through our fields and marking the failed ones
    foreach( $validation_result['form']['fields'] as &$field ){
 
      // if 17 or 16 mark as not valid
      if( $field['id'] == '22' || $field['id'] == '24' ){
 
          $field['failed_validation'] = true;
          $field['validation_message'] = 'The passwords don\'t match';
 
      }
 
    }
 
  }
 
    return $validation_result;
 
}



function check_password_match_emp( $validation_result ){
 
  // this is making sure the passwords match
  if( $_POST['input_25'] != $_POST['input_26'] ) {
 
    // marking the whole form as not valid
    $validation_result['is_valid'] = false;
 
    // looping through our fields and marking the failed ones
    foreach( $validation_result['form']['fields'] as &$field ){
 
      // if 17 or 16 mark as not valid
      if( $field['id'] == '25' || $field['id'] == '26' ){
 
          $field['failed_validation'] = true;
          $field['validation_message'] = 'The passwords don\'t match';
 
      }
 
    }
 
  }
 
    return $validation_result;
 
}

function check_password_length_and_characters_can( $validation_result ){
 
  // checking now to make sure the passwords match the requirements
  // for length and that we only have upper and lower case letters
  // and numbers
  $pattern = get_option('reset_pwd_valid_pattern');
     $pattern = !empty($pattern) ? $pattern : '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/'; //at least 8 chars long containing an uppercase letter and number;

  if( !preg_match( $pattern, $_POST['input_22'] ) ){
 
    // marking the whole thing as not valid
    $validation_result['is_valid'] = false;
 
      // looping through our fields and marking the failed ones
      foreach( $validation_result['form']['fields'] as &$field ){
 
      // if 17 or 16 mark as not valid
      if( $field['id'] == '22' || $field['id'] == '24' ){
 
          $field['failed_validation'] = true;
           $msg = get_option('reset_pwd_format_error_msg');
        $msg = !empty($msg) ? $msg : "Password must be at least 8 chars long containing at least one uppercase letter and number";

          $field['validation_message'] = $msg;
 
      }
	 }
  }
 	return $validation_result;
}

function check_password_length_and_characters_emp( $validation_result ){
 
  // checking now to make sure the passwords match the requirements
  // for length and that we only have upper and lower case letters
  // and numbers
   $pattern = get_option('reset_pwd_valid_pattern');
     $pattern = !empty($pattern) ? $pattern : '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/'; //at least 8 chars long containing an uppercase letter and number;

  if( !preg_match( $pattern, $_POST['input_25'] ) ){
 
    // marking the whole thing as not valid
    $validation_result['is_valid'] = false;
 
      // looping through our fields and marking the failed ones
      foreach( $validation_result['form']['fields'] as &$field ){
 
      // if 17 or 16 mark as not valid
      if( $field['id'] == '25' || $field['id'] == '26' ){
 
          $field['failed_validation'] = true;
            $msg = get_option('reset_pwd_format_error_msg');
        $msg = !empty($msg) ? $msg : "Password must be at least 8 chars long containing at least one uppercase letter and number";

          $field['validation_message'] = $msg;
 
      }
	 }
  }
 	return $validation_result;
}

function change_radio_structure($input, $field, $value, $lead_id, $form_id){
    $input_type = RGFormsModel::get_input_type($field);
    if($input_type != "radio" || IS_ADMIN && RG_CURRENT_VIEW == "entry")
        return $input;

    $choices = "";

    if(is_array($field["choices"])){
        $choice_id = 0;
        $count = 1;
        $total = count($field['choices']);
        // add "other" choice to choices if enabled
        if(rgar($field, 'enableOtherChoice')) {
            $other_default_value = GFCommon::get_other_choice_value();
            $field["choices"][] = array('text' => $other_default_value, 'value' => 'gf_other_choice', 'isSelected' => false, 'isOtherChoice' => true);
        }

        $logic_event = !empty($field["conditionalLogicFields"]) ? "onclick='gf_apply_rules(" . $form_id . "," . GFCommon::json_encode($field["conditionalLogicFields"]) . ");'" : "";
        $disabled_text = IS_ADMIN ? "disabled='disabled'" : "";

        foreach($field["choices"] as $choice){
            $id = $field["id"] . '_' . $choice_id++;
            $field_value = !empty($choice["value"]) || rgar($field, "enableChoiceValue") ? $choice["value"] : $choice["text"];
            $checked = rgar($choice,"isSelected") ? "checked='checked'" : "";
            $tabindex = GFCommon::get_tabindex();
            $end = $count==$total ? ' end' : '';
            $label = sprintf("<label for='choice_%s'>%s</label>", $id, $choice["text"]);
            $input_focus = '';

            // handle "other" choice
            if(rgar($choice, 'isOtherChoice')) {

                $onfocus = !IS_ADMIN ? 'jQuery(this).prev("input").attr("checked", true); if(jQuery(this).val() == "' . $other_default_value . '") { jQuery(this).val(""); }' : '';
                $onblur = !IS_ADMIN ? 'if(jQuery(this).val().replace(" ", "") == "") { jQuery(this).val("' . $other_default_value . '"); }' : '';

                $input_focus = !IS_ADMIN ? "onfocus=\"jQuery(this).next('input').focus();\"" : "";
                $value_exists = RGFormsModel::choices_value_match($field, $field["choices"], $value);

                if($value == 'gf_other_choice' && rgpost("input_{$field["id"]}_other")){
                    $other_value = rgpost("input_{$field["id"]}_other");
                } else if(!$value_exists && !empty($value)){
                    $other_value = $value;
                    $value = 'gf_other_choice';
                    $checked = "checked='checked'";
                } else {
                    $other_value = $other_default_value;
                }
                $label = "<input name='input_{$field["id"]}_other' type='text' value='" . esc_attr($other_value) . "' onfocus='$onfocus' onblur='$onblur' $tabindex $disabled_text />";
            }

        /*    $choices .= sprintf("<input name='input_%d' type='radio' value='%s' %s id='choice_%s' $tabindex %s $logic_event %s />%s", $field["id"], esc_attr($field_value), $checked, $id, $disabled_text, $input_focus, $label); */
              $choices .= sprintf("<div class='small-6 columns %s gchoice_$id'><input name='input_%d' type='radio' value='%s' %s id='choice_%s' $tabindex %s $logic_event %s />%s</div>", $end,  $field["id"], esc_attr($field_value), $checked, $id, $disabled_text, $input_focus, $label);
            if(IS_ADMIN && $count >=5)
                break;

            $count++;
        }

        $total = sizeof($field["choices"]);
        if($count < $total)
            $choices .= "<div class='gchoice_total'>" . sprintf(__("%d of %d items shown. Edit field to view all", "gravityforms"), $count, $total) . "</div>";
    }
    
    $field_id = "input_{$form_id}_{$field["id"]}";

    return sprintf("<div class='ginput_container'><div class='gfield_radio row' id='%s'>%s</div></div>", $field_id, $choices);    

}





function change_checkbox_structure($input, $field, $value, $lead_id, $form_id){
    $input_type = RGFormsModel::get_input_type($field);
    if($input_type != "checkbox" || IS_ADMIN && RG_CURRENT_VIEW == "entry")
        return $input;

    $choices = "";

    if(is_array($field["choices"])){
        $choice_number = 1;
        $count = 1;
        $total = count($field['choices']);
        $logic_event = !empty($field["conditionalLogicFields"]) ? "onclick='gf_apply_rules(" . $form_id . "," . GFCommon::json_encode($field["conditionalLogicFields"]) . ");'" : "";
        $disabled_text = (IS_ADMIN && RG_CURRENT_VIEW != "entry") ? "disabled='disabled'" : "";

        foreach($field["choices"] as $choice){
            if($choice_number % 10 == 0) //hack to skip numbers ending in 0. so that 5.1 doesn't conflict with 5.10
                $choice_number++;

            $input_id = $field["id"] . '.' . $choice_number;
            $id = $field["id"] . '_' . $choice_number++;

            if(empty($_POST) && rgar($choice,"isSelected")){
                $checked = "checked='checked'";
            }
            else if(is_array($value) && RGFormsModel::choice_value_match($field, $choice, rgget($input_id, $value))){
                $checked = "checked='checked'";
            }
            else if(!is_array($value) && RGFormsModel::choice_value_match($field, $choice, $value)){
                $checked = "checked='checked'";
            }
            else{
                $checked = "";
            }

            $tabindex = GFCommon::get_tabindex();
            $end = $count==$total ? ' end' : '';
            $choice_value = $choice["value"];
            if(rgget("enablePrice", $field))
                $choice_value .= "|" . GFCommon::to_number(rgar($choice,"price"));

            $label = sprintf("<label for='choice_%s'>%s</label>", $id, $choice["text"]);

            $choices .= sprintf("<li class='small-6 medium-3 large-2 columns %s gchoice_$id'><input name='input_%s' type='checkbox' $logic_event value='%s' %s id='choice_%s' $tabindex %s />%s</li>", $end, $input_id, esc_attr($choice_value), $checked, $id, $disabled_text, $label);

            if(IS_ADMIN && RG_CURRENT_VIEW != "entry" && $count >=5)
                break;

            $count++;
        }

        $total = sizeof($field["choices"]);
        if($count < $total)
            $choices .= "<div class='gchoice_total'>" . sprintf(__("%d of %d items shown. Edit field to view all", "gravityforms"), $count, $total) . "</div>";
    }

    $field_id = "input_{$form_id}_{$field["id"]}";

    return sprintf("<div class='ginput_container'><ul class='gfield_checkbox row' id='%s'>%s</ul row></div>", $field_id, $choices);
}


function change_password_structure($input,$field,$value,$lead_id,$form_id){
  // if ( $field->id == 10 ) {
    $input_type = RGFormsModel::get_input_type($field);
    if($input_type != "password" || IS_ADMIN && RG_CURRENT_VIEW == "entry")
        return $input;

  if ( is_array( $value ) ) {
      $value = array_values( $value );
    }
$form = RGFormsModel::get_form_meta($form_id, true);
   // $form_id         = $form['id'];
    $is_entry_detail = $field->is_entry_detail();
    $is_form_editor  = $field->is_form_editor();
    $is_admin = $is_entry_detail || $is_form_editor;

    $id       = (int) $field->id;
    
    $field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";

    $class_suffix = $is_entry_detail ? '_admin' : '';

    $form_sub_label_placement  = rgar( $form, 'subLabelPlacement' );
    $field_sub_label_placement = $field->subLabelPlacement;
    $is_sub_label_above        = $field_sub_label_placement == 'above' || ( empty( $field_sub_label_placement ) && $form_sub_label_placement == 'above' );
    $sub_label_class_attribute = $field_sub_label_placement == 'hidden_label' ? "class='hidden_sub_label'" : '';

    $disabled_text = $is_form_editor ? 'disabled="disabled"' : '';

    $first_tabindex = $field->get_tabindex();
    $last_tabindex  = $field->get_tabindex();

    $strength_style           = ! $field->passwordStrengthEnabled ? "style='display:none;'" : '';
    $strength_indicator_label = __( 'Strength indicator', 'gravityforms' );
    $strength                 = $field->passwordStrengthEnabled || $is_admin ? "<div id='{$field_id}_strength_indicator' class='gfield_password_strength' {$strength_style}>
                                      {$strength_indicator_label}
                                    </div>
                                    <input type='hidden' class='gform_hidden' id='{$field_id}_strength' name='input_{$id}_strength' />" : '';

    $action   = ! $is_admin ? "gformShowPasswordStrength(\"$field_id\");" : '';
    $onchange = $field->passwordStrengthEnabled ? "onchange='{$action}'" : '';
    $onkeyup  = $field->passwordStrengthEnabled ? "onkeyup='{$action}'" : '';

    $confirmation_value = rgpost( 'input_' . $id . '_2' );

    $password_value     = is_array( $value ) ? $value[0] : $value;
    $password_value     = esc_attr( $password_value );
    $confirmation_value = esc_attr( $confirmation_value );

    $enter_password_field_input   = GFFormsModel::get_input( $field, $field->id . '' );
    $confirm_password_field_input = GFFormsModel::get_input( $field, $field->id . '.2' );

    $enter_password_label   = rgar( $enter_password_field_input, 'customLabel' ) != '' ? $enter_password_field_input['customLabel'] : __( 'Enter Password', 'gravityforms' );
    $enter_password_label   = apply_filters( "gform_password_{$form_id}", apply_filters( 'gform_password', $enter_password_label, $form_id ), $form_id );

    $confirm_password_label   = rgar( $confirm_password_field_input, 'customLabel' ) != '' ? $confirm_password_field_input['customLabel'] : __( 'Confirm Password', 'gravityforms' );
    $confirm_password_label = apply_filters( "gform_password_confirm_{$form_id}", apply_filters( 'gform_password_confirm', $confirm_password_label, $form_id ), $form_id );


    $enter_password_placeholder_attribute   = GFCommon::get_input_placeholder_attribute( $enter_password_field_input );
    $confirm_password_placeholder_attribute = GFCommon::get_input_placeholder_attribute( $confirm_password_field_input );

    if ( $is_sub_label_above ) {
      return "<div class='row ginput_complex$class_suffix ginput_container' id='{$field_id}_container'>
          <span id='{$field_id}_1_container' class='ginput_left small-12 medium-6 large-4 columns'>
            <label for='{$field_id}' {$sub_label_class_attribute}>{$enter_password_label}</label>
            <input type='password' placeholder='Password' name='input_{$id}' id='{$field_id}' {$onkeyup} {$onchange} value='{$password_value}' {$first_tabindex} {$enter_password_placeholder_attribute} {$disabled_text}/>
          </span>
          <span id='{$field_id}_2_container' class='ginput_right small-12 medium-6 large-4 columns'>
            <label for='{$field_id}_2' {$sub_label_class_attribute}>{$confirm_password_label}</label>
            <input type='password' placeholder='Confirm Password' name='input_{$id}_2' id='{$field_id}_2' {$onkeyup} {$onchange} value='{$confirmation_value}' {$last_tabindex} {$confirm_password_placeholder_attribute} {$disabled_text}/>
          </span>
          <div class='gf_clear gf_clear_complex'></div>
        </div>{$strength}";
    } else {
      return "<div class='row ginput_complex$class_suffix ginput_container' id='{$field_id}_container'>
          <span id='{$field_id}_1_container' class='ginput_left small-12 medium-6 large-4 columns'>
            <input type='password' placeholder='Password' name='input_{$id}' id='{$field_id}' {$onkeyup} {$onchange} value='{$password_value}' {$first_tabindex} {$enter_password_placeholder_attribute} {$disabled_text}/>
            <label for='{$field_id}' {$sub_label_class_attribute}>{$enter_password_label}</label>
          </span>
          <span id='{$field_id}_2_container' class='ginput_right small-12 medium-6 large-4 columns'>
            <input type='password' placeholder='Confirm Password' name='input_{$id}_2' id='{$field_id}_2' {$onkeyup} {$onchange} value='{$confirmation_value}' {$last_tabindex} {$confirm_password_placeholder_attribute} {$disabled_text}/>
            <label for='{$field_id}_2' {$sub_label_class_attribute}>{$confirm_password_label}</label>
          </span>
          <div class='gf_clear gf_clear_complex'></div>
        </div>{$strength}";
    }
}


// Change default excerpt
function new_excerpt_more( $more ) {
  //return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
  return '&hellip;';
}





<?php

add_filter( 'gform_field_input', 'password_input', 10, 5 );
add_filter( 'gform_field_choices', 'checkbox_choices', 10, 2 );
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
//add_filter("gform_validation_message", "change_message", 10, 2);
add_filter( 'gform_ajax_spinner_url', 'custom_gform_spinner' );
add_filter( 'gform_validation_2', 'check_password_match' );
//add_filter( 'gform_validation_2', 'check_password_length_and_characters' );

function form_submit_button( $button, $form ) {
    return "<button class='icon-button tick' id='gform_submit_button_{$form['id']}'><span>".$form['button']['text']."</span></button>";
}
function custom_gform_spinner(){
	return get_stylesheet_directory_uri().'/images/spin.svg';
}


function check_password_match( $validation_result ){
 
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

function check_password_length_and_characters( $validation_result ){
 
  // checking now to make sure the passwords match the requirements
  // for length and that we only have upper and lower case letters
  // and numbers
  if( !preg_match( "/^[a-zA-Z0-9]{4,16}$/", $_POST['input_7'] ) ){
 
    // marking the whole thing as not valid
    $validation_result['is_valid'] = false;
 
      // looping through our fields and marking the failed ones
      foreach( $validation_result['form']['fields'] as &$field ){
 
      // if 17 or 16 mark as not valid
      if( $field['id'] == '7' || $field['id'] == '8' ){
 
          $field['failed_validation'] = true;
          $field['validation_message'] = 'Your password needs to be between 4 and 16 characters and can only contain upper and lower case letters and numbers.';
 
      }
 
    }
 
  }
 
  return $validation_result;
 
}


function checkbox_choices( $choices, $field ) {

 	if(is_array($field["choices"])):
        $choice_id = 0;
        $count = 1;
         $choices = "";
         $total = count($field['choices']);
        $logic_event = !empty($field["conditionalLogicFields"]) ? "onclick='gf_apply_rules(" . $field["formId"] . "," . GFCommon::json_encode($field["conditionalLogicFields"]) . ");'" : "";

        foreach($field["choices"] as $choice):
            $id = $field["id"] . '_' . $choice_id++;
            $field_value = !empty($choice["value"]) || rgar($field, "enableChoiceValue") ? $choice["value"] : $choice["text"];
            $checked = rgar($choice,"isSelected") ? "checked='checked'" : "";
            $tabindex = GFCommon::get_tabindex();
            $end = $count==$total ? ' end' : '';

            $input = sprintf("<input name='input_%d' type='checkbox' value='%s' %s id='choice_%s' $tabindex $logic_event />", $field["id"], esc_attr($field_value), $checked, $id);
            $choices .= sprintf("<li class='small-6 medium-4 large-2 columns %s gchoice_$id'> %s<label for='choice_%s'>%s</label></li>", $end, $input, $id, $choice["text"]);

            $count++;
        endforeach;
	endif;
	return $choices;
}



function password_input( $input, $field, $value, $lead_id, $form_id ) {
//print_r($field);
 if ( $field->id == 10 ) {

if ( is_array( $value ) ) {
			$value = array_values( $value );
		}

		//$form_id         = $form['id'];
		$is_entry_detail = $field->is_entry_detail();
		$is_form_editor  = $field->is_form_editor();
		$is_admin = $is_entry_detail || $is_form_editor;

		$id  = $form_id;
		$form = RGFormsModel::get_form_meta($form_id, true);
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
			$input =  "<div class='row ginput_complex$class_suffix ginput_container' id='{$field_id}_container'>
					<span id='{$field_id}_1_container' class='ginput_left small-12 medium-6 large-4 columns'>
						<label for='{$field_id}' {$sub_label_class_attribute}>{$enter_password_label}</label>
						<input type='password' name='input_{$id}' id='{$field_id}' {$onkeyup} {$onchange} value='{$password_value}' {$first_tabindex} {$enter_password_placeholder_attribute} {$disabled_text}/>
					</span>
					<span id='{$field_id}_2_container' class='ginput_right small-12 medium-6 large-4 columns'>
						<label for='{$field_id}_2' {$sub_label_class_attribute}>{$confirm_password_label}</label>
						<input type='password' name='input_{$id}_2' id='{$field_id}_2' {$onkeyup} {$onchange} value='{$confirmation_value}' {$last_tabindex} {$confirm_password_placeholder_attribute} {$disabled_text}/>
					</span>
					<div class='gf_clear gf_clear_complex'></div>
				</div>{$strength}";
		} else {
			$input =  "<div class='row ginput_complex$class_suffix ginput_container' id='{$field_id}_container'>
					<span id='{$field_id}_1_container' class='ginput_left small-12 medium-6 large-4 columns'>
						<input type='password' name='input_{$id}' id='{$field_id}' {$onkeyup} {$onchange} value='{$password_value}' {$first_tabindex} {$enter_password_placeholder_attribute} {$disabled_text}/>
						<label for='{$field_id}' {$sub_label_class_attribute}>{$enter_password_label}</label>
					</span>
					<span id='{$field_id}_2_container' class='ginput_right small-12 medium-6 large-4 columns'>
						<input type='password' name='input_{$id}_2' id='{$field_id}_2' {$onkeyup} {$onchange} value='{$confirmation_value}' {$last_tabindex} {$confirm_password_placeholder_attribute} {$disabled_text}/>
						<label for='{$field_id}_2' {$sub_label_class_attribute}>{$confirm_password_label}</label>
					</span>
					<div class='gf_clear gf_clear_complex'></div>
				</div>{$strength}";
		}
		return $input;
	}
	if ( $field->id == 17 or $field->id == 18 or $field->id == 19 or $field->id == 23 ) {
		$is_entry_detail = $field->is_entry_detail();
		$is_form_editor  = $field->is_form_editor();

		$id            = $field->id;
		$field_id      = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
		$disabled_text = $is_form_editor ? 'disabled="disabled"' : '';
//small-12 medium-6 large-4 columns
		return sprintf( "<div class='ginput_container'><ul class='row gfield_checkbox' id='%s'>%s</ul></div>", $field_id, $field->get_checkbox_choices( $value, $disabled_text, $form_id ) );
	}
	}
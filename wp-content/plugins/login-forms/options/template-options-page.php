<div class="wrap">
<h2>Login Forms</h2>
<form method="post" action="options.php">
<?php settings_fields( 'login-form-settings-group' ); ?>
<?php do_settings_sections( 'login-form-settings-group' ); ?>
<h3 class="title">Form Pages</h3>
<table class="form-table">
<tbody><tr>
<th scope="row"><label for="login_page_id">Login Page</label></th>
<td>
	<select name="login_page_id" id="login_page_id" class="postform">
<?php
$args = array(
	'post_type'=>'page',
	'post_status'=>'publish',
	'orderby'=>'menu_order',
	'order'=>'ASC'
);


if($pages = get_posts($args)):

	foreach($pages as $page):
		$selected = get_option('login_page_id')==$page->ID ? ' selected="selected"' : ''; 
?>
<option value="<?php echo $page->ID?>"<?php echo $selected ?>><?php echo $page->post_title ?></option>
<?php endforeach ?>
<?php endif ?>
</select>
</td>
</tr>
<tr>
<th scope="row"><label for="reset_pwd_page_id">Reset Password Page</label></th>
<td>
		<select name="reset_pwd_page_id" id="reset_pwd_page_id" class="postform">
<?php
if($pages = get_posts($args)):
	foreach($pages as $page):
		$selected = get_option('reset_pwd_page_id')==$page->ID ? ' selected="selected"' : ''; 
?>
<option value="<?php echo $page->ID?>"<?php echo $selected ?>><?php echo $page->post_title ?></option>
<?php endforeach ?>
<?php endif ?>
</td>
</tr>
<tr>
<th scope="row"><label for="update_pwd_page_id">Update Password Page</label></th>
<td>
		<select name="update_pwd_page_id" id="update_pwd_page_id" class="postform">
<?php
if($pages = get_posts($args)):
	foreach($pages as $page):
		$selected = get_option('update_pwd_page_id')==$page->ID ? ' selected="selected"' : ''; 
?>
<option value="<?php echo $page->ID?>"<?php echo $selected ?>><?php echo $page->post_title ?></option>
<?php endforeach ?>
<?php endif ?>
</td>
</tr>
<tr>
<th scope="row">Other Options</th>
<td><fieldset><legend class="screen-reader-text"><span>Other Options</span></legend>
<?php $checked = get_option('login_remember_me')==1 ? ' checked="checked"' : ''; ?>
<label for="login_remember_me"><input name="login_remember_me" type="checkbox" id="login_remember_me" value="1"<?php echo $checked ?>> Include 'remember me' option in login form</label><br />
<?php $checked = get_option('use_ajax')==1 ? ' checked="checked"' : ''; ?>
<label for="use_ajax"><input name="use_ajax" type="checkbox" id="use_ajax" value="1"<?php echo $checked ?>> Submit forms with AJAX</label>
</fieldset></td>
</tr>
</tbody></table>
<h3>Redirect Pages</h3>
<p>Select pages forms will redirect to following successful submission</p>
<table class="form-table">
<tbody>
<tr>
<th scope="row"><label for="login_redirect_page_id">Login</label></th>
<td>
		<select name="login_redirect_page_id" id="login_redirect_page_id" class="postform">
<?php
if($pages = get_posts($args)):
	foreach($pages as $page):
		$selected = get_option('login_redirect_page_id')==$page->ID ? ' selected="selected"' : ''; 
?>
<option value="<?php echo $page->ID?>"<?php echo $selected ?>><?php echo $page->post_title ?></option>
<?php endforeach ?>
<?php endif ?>
</td>
</tr>
<tr>
<th scope="row"><label for="reset_pwd_redirect_page_id">Reset Password</label></th>
<td>
		<select name="reset_pwd_redirect_page_id" id="reset_pwd_redirect_page_id" class="postform">
<?php
if($pages = get_posts($args)):
	foreach($pages as $page):
		$selected = get_option('reset_pwd_redirect_page_id')==$page->ID ? ' selected="selected"' : ''; 
?>
<option value="<?php echo $page->ID?>"<?php echo $selected ?>><?php echo $page->post_title ?></option>
<?php endforeach ?>
<?php endif ?>
</td>
</tr>
<tr>
<th scope="row"><label for="update_pwd_redirect_page_id">Update Password</label></th>
<td>
		<select name="update_pwd_redirect_page_id" id="update_pwd_redirect_page_id" class="postform">
<?php
if($pages = get_posts($args)):
	foreach($pages as $page):
		$selected = get_option('update_pwd_redirect_page_id')==$page->ID ? ' selected="selected"' : ''; 
?>
<option value="<?php echo $page->ID?>"<?php echo $selected ?>><?php echo $page->post_title ?></option>
<?php endforeach ?>
<?php endif ?>
</td>
</tr>
</tbody></table>
<h3>Login Messages</h3>
<table class="form-table">
<tbody>
<tr>
<th scope="row"><label for="login_empty_email_error_msg">Empty Email Address</label></th>
<td><input name="login_empty_email_error_msg" type="text" id="login_empty_email_error_msg" placeholder="Please enter your email address" value="<?php echo get_option('login_empty_email_error_msg') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="login_empty_pwd_error_msg">Empty Password</label></th>
<td><input name="login_empty_pwd_error_msg" type="text" id="login_empty_pwd_error_msg" placeholder="Please enter password" value="<?php echo get_option('login_empty_pwd_error_msg') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="login_failed_error_msg">Failed Login</label></th>
<td><input name="login_failed_error_msg" type="text" id="login_failed_error_msg" placeholder="Registered email address or password incorrect." value="<?php echo get_option('login_failed_error_msg') ?>" class="regular-text ltr">
</td>
</tr>
</tbody></table>
<h3>Reset Password Messages</h3>
<table class="form-table">
<tbody>
<tr>
<th scope="row"><label for="reset_pwd_expired_key_error_msg">User not found</label></th>
<td><input name="reset_pwd_no_user_msg" type="text" id="reset_pwd_no_user_msg" placeholder="No user found with that email address." value="<?php echo get_option('reset_pwd_no_user_msg') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="reset_pwd_link_sent_msg">Password reset link sent</label></th>
<td><input name="reset_pwd_link_sent_msg" type="text" id="reset_pwd_link_sent_msg" placeholder="Check your email for the confirmation link to reset your password." value="<?php echo get_option('reset_pwd_link_sent_msg') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="reset_pwd_link_sent_error_msg">Passwords reset link failed</label></th>
<td><input name="reset_pwd_link_sent_error_msg" type="text" id="reset_pwd_link_sent_error_msg" placeholder="Request failed, please try again." value="<?php echo get_option('reset_pwd_link_sent_error_msg') ?>" class="regular-text ltr">
</td>
</tr>
</tbody></table>
<h3>Update Password Valid Format</h3>
<p>Required password format. Default is at least 8 chars long containing an uppercase letter and number</p>
<table class="form-table">
<tbody>
<tr>
<th scope="row"><label for="reset_pwd_valid_pattern">Validation Pattern</label></th>
<td><input name="reset_pwd_valid_pattern" type="text" id="reset_pwd_valid_pattern" placeholder="/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/" value="<?php echo get_option('reset_pwd_valid_pattern') ?>" class="regular-text ltr">
</td>
</tr>
</tbody>
</table>
<h3>Update Password Messages</h3>
<table class="form-table">
<tbody>
<tr>
<th scope="row"><label for="update_pwd_empty_pwd_error_msg">Empty Password</label></th>
<td><input name="update_pwd_empty_pwd_error_msg" type="text" id="update_pwd_empty_pwd_error_msg" placeholder="Please enter a password" value="<?php echo get_option('update_pwd_empty_pwd_error_msg') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="update_pwd_no_match_error_msg">Passwords do not match</label></th>
<td><input name="update_pwd_no_match_error_msg" type="text" id="update_pwd_no_match_error_msg" placeholder="Passwords do not match" value="<?php echo get_option('update_pwd_no_match_error_msg') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="update_pwd_format_error_msg">Incorrect format</label></th>
<td><input name="update_pwd_format_error_msg" type="text" id="update_pwd_format_error_msg" placeholder="Password must be at least 8 chars long containing at least one uppercase letter and number" value="<?php echo get_option('update_pwd_format_error_msg') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="update_pwd_success_msg">Password updated</label></th>
<td><input name="update_pwd_success_msg" type="text" id="update_pwd_success_msg" placeholder="Your password has been successfully reset. Please login." value="<?php echo get_option('update_pwd_success_msg') ?>" class="regular-text ltr">
</td>
</tr>
</tbody></table>

<?php submit_button(); ?>
</form>
</div>
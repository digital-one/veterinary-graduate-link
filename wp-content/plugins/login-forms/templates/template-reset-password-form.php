<?php
	global $login;

  /*code to set the login form as active when actions past through URL parameter
  Only needed for single page - remove if not required 
  */
  $active_actions = array('invalid_key');
  $active = in_array($login->_action,$active_actions) ? ' active' : '';
  ?>
<!-- reset password request form -->
      <div id="reset-password-form" class="gform_wrapper notification<?php echo $active ?>">
<form method="post" action="<?php echo get_permalink(429) ?>">
  <div class="gform_heading">
<h3 class="gform_title">Reset Password</h3>
<span class="gform_description"></span>
</div>
 
  <div class="validation_error"><?php echo $login->_message ?></div>

  <div class='gform_body'>
  <ul>
	<li class="no-label"><label class='gfield_label' for="user_email">Email Address<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_email' id='user_email' type='text' placeholder="Email Address" value="<?php echo $login->_user_email ?>" class='medium'    /></div>
</li>
</ul>
</div>
 <div class='gform_footer top_label'>
 	<a class="notification-btn" rel="login-form">Login</a>
<a class="icon-button cancel">Cancel</a>  <button type="submit" class="icon-button tick"<?php if($login->_use_ajax):?>onclick="ajax_login(this.form);return false;"<?php endif ?>>Submit</button>
 <input name="action" type="hidden" value="reset_pwd" />
 <input name="reset_pwd_nonce" type="hidden" value="<?php echo wp_create_nonce( 'reset_pwd_nonce' ); ?>" />
</div>
</form>
</div>

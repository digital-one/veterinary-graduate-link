<?php
  global $login;
  /*code to set the login form as active when actions past through URL parameter
  Only needed for single page - remove if not required 
  */
  $active_actions = array('reset_pwd_confirm');
  $active = in_array($login->_action,$active_actions) ? ' active' : '';
  ?>
<!-- password reset form -->
  <div id="update-password-form" class="gform_wrapper notification<?php echo $active ?>">
<form method="post" action="">
  <div class="gform_heading">
<h3 class="gform_title">Update Password</h3>
</div>
  <?php if(!empty($login->_message)): ?>
  <div class="validation_error"><?php echo $login->_message ?></div>
<?php endif ?>
  <div class='gform_body'>
  <ul>
    <li class="no-label gfield"><label class='gfield_label' for="user_pwd">Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pwd' id='user_pwd' type='password' placeholder='Password' value='' class='medium'    /></div>
</li>
<li class="no-label gfield"><label class='gfield_label' for="user_pwd_confirm">Confirm Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pwd_confirm' id='user_pwd_confirm' type='password' placeholder='Confirm Password' value='' class='medium'    /></div>
</li>
</ul>
</div>
 <div class='gform_footer top_label'>
 <div class="buttons"><a class="icon-button cancel">Cancel</a>  <button type="submit" class="icon-button tick"<?php if($login->_use_ajax):?>onclick="ajax_login(this.form);return false;"<?php endif ?>>Update Password</button></div>
 <input name="action" type="hidden" value="update_pwd" />
  <input name="user_id" type="hidden" value="<?php echo $login->user_id ?>" />
  <input name="update_pwd_nonce" type="hidden" value="<?php echo wp_create_nonce( 'update_pwd_nonce' ); ?>" />
</div>
  </form>
</div>
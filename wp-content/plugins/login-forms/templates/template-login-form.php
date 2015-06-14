<!-- login form -->
<?php
 // $login = new login_forms();
global $login;
  ?>
  <?php 
  /*code to set the login form as active when actions past through URL parameter
  Only needed for single page - remove if not required 
  */
  $active_actions = array('reset_success');
  $active = in_array($login->_action,$active_actions) ? ' active' : '';
  ?>
<div id="login-form" class="gform_wrapper notification<?php echo $active ?>">
 
<form id="login" method="post" action="">
  <div class="gform_heading">
<h3 class="gform_title">Login</h3>
<span class="gform_description"></span>
</div>
 
  <div class="validation_error"><?php echo $login->_message; ?></div>

  <div class='gform_body'>
  <ul>
    <?php
    $email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
?>
    <li class="no-label gfield"><label class='gfield_label' for="user_email">Registered Email Address<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_email' id='user_email' type='text' value='<?php echo $login->_user_email ?>' class='medium' placeholder="Email Address"    /></div>
</li>
  <li class="no-label gfield"><label class='gfield_label' for="user_email">Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pass' id='user_pass' type='password' value='' class='medium' placeholder="Password"  /></div>
</li>

	 <li class="remember">
	 	<div class="checkbox-wrap"><input type="checkbox" name="user_remember" id="user_remember" value="1" /><label for="user_remember">Remember Me</label></div></li>
</ul>

 </div>
 <div class='gform_footer top_label'>

<div class="buttons"> <a class="icon-button cancel">Cancel</a>  <button type="submit" class="icon-button login" <?php if($login->_use_ajax):?>onclick="ajax_login(this.form);return false;"<?php endif ?>>Log in</button></div>
 <a class="notification-btn" rel="reset-password-form">Forgotten Password?</a>
</div>
 <input name="action" type="hidden" value="login" />
 <input name="redirect" type="hidden" value="<?php if(!empty($_REQUEST) and isset($_REQUEST['redirect'])): echo $_REQUEST['redirect']; endif ?>" />
</form>
</div>
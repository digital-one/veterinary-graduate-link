<!-- login form -->
<?php $login = new login_form() ;
	?>

<div id="login-form" class="gform_wrapper">
<form id="login" method="post" action="">
  <div class="gform_heading">
<h3 class="gform_title">Login</h3>
<span class="gform_description"></span>
</div>
 
  <div class="validation_err"><?php echo $login->_message; ?></div>

  <div class='gform_body'>
  <ul>
    <?php
    $email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
?>
    <li><label class='gfield_label' for="user_email">Registered Email Address<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_email' id='user_email' type='text' value='<?php echo $login->_user_email ?>' class='medium' placeholder="Email Address"    /></div>
</li>
  <li><label class='gfield_label' for="user_email">Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pass' id='user_pass' type='password' value='' class='medium' placeholder="Password"  /></div>
</li>

	 <li>
	 	<input type="checkbox" name="user_remember" id="user_remember" value="1" /><label for="user_remember">Remember Me</label></li>
</ul>

 </div>
 <div class='gform_footer top_label'>
 <a href="<?php echo get_permalink(429) ?>?action=lostpassword">Forgotten Password?</a>
 <a class="icon-button cancel">Cancel</a>  <button type="submit" class="icon-button login" <?php if($login->_use_ajax):?>onclick="ajax_login();return false;"<?php endif ?>>Log in</button>
 <input name="action" type="hidden" value="get_login" />
</div>
</form>
</div>
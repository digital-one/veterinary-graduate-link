<?php $login = new login_form() ?>
<!-- password reset form -->
  <div id="reset-password-form" class="gform_wrapper">
<form method="post" action="">
  <div class="gform_heading">
<h3 class="gform_title">Update Password</h3>
<span class="gform_description"><p>Please enter your new password below.</p></span>
</div>
  <?php if(!empty($login->message)): ?>
  <div class="validation_error"><?php echo $login->message ?></div>
<?php endif ?>
  <div class='gform_body'>
  <ul>
    <?php
    $email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
?>
    <li><label class='gfield_label' for="user_pwd">Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pwd' id='user_pwd' type='password' placeholder='Password' value='' class='medium'    /></div>
</li>
<li><label class='gfield_label' for="user_pwd_confirm">Confirm Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pwd_confirm' id='user_pwd_confirm' type='password' placeholder='Confirm Password' value='' class='medium'    /></div>
</li>
</ul>
</div>
 <div class='gform_footer top_label'>
 <a class="icon-button cancel">Cancel</a>  <button type="submit" class="icon-button tick">Update Password</button>
 <input name="action" type="hidden" value="update_pwd" />
  <input name="user_id" type="hidden" value="<?php echo $login->user_id ?>" />
  <input name="update_pwd_nonce" type="hidden" value="<?php echo wp_create_nonce( 'update_pwd_nonce' ); ?>" />
</div>
  </form>
</div>
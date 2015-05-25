<?php $login = new login_form() ?>

<!-- reset password request form -->
      <div id="reset-password-request-form" class="gform_wrapper">
<form method="post" action="<?php echo get_permalink(429) ?>">
  <div class="gform_heading">
<h3 class="gform_title">Reset Password</h3>
<span class="gform_description"></span>
</div>
   <?php if(!empty($login->_message)): ?>
  <div class="validation_err"><?php echo $login->_message ?></div>
<?php endif ?>
  <div class='gform_body'>
  <ul>

    <li><label class='gfield_label' for="user_email">Email Address<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_email' id='user_email' type='text' placeholder="Email Address" value="<?php echo $login->_user_email ?>" class='medium'    /></div>
</li>
</ul>
</div>
 <div class='gform_footer top_label'>
<a class="icon-button cancel">Cancel</a>  <button type="submit" class="icon-button tick">Submit</button>
 <input name="action" type="hidden" value="reset_pwd" />
 <input name="reset_pwd_nonce" type="hidden" value="<?php echo wp_create_nonce( 'reset_pwd_nonce' ); ?>" />
</div>
</form>
</div>

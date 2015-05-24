loading
<?php

$login = new loginclass() ;
/* switch($login->current_form_id){
      case "login":
      */
      ?>
<!-- login form -->

  <div id="login-form" class="gform_wrapper">
<form id="login" method="post" action="">
  <div class="gform_heading">
<h3 class="gform_title">Login</h3>
<span class="gform_description"></span>
</div>
  <?php if(!empty($login->message)): ?>
  <div class="validation_error"><?php echo $login->message ?></div>
<?php endif ?>
  <div class='gform_body'>
  <ul>
    <?php
    $email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
?>
    <li><label class='gfield_label' for="user_email">Registered Email Address<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_email' id='user_email' type='text' value='<?php echo $email ?>' class='medium' placeholder="Email Address"    /></div>
</li>
  <li><label class='gfield_label' for="user_email">Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pass' id='user_pass' type='password' value='' class='medium' placeholder="Password"  /></div>
</li>
</ul>

 </div>
 <div class='gform_footer top_label'>
 <a href="<?php echo get_permalink(429) ?>?action=lostpassword">Forgotten Password?</a>
 <a class="icon-button cancel">Cancel</a>  <button type="submit" class="icon-button login">Log in</button>
 <input name="action" type="hidden" value="login" />
</div>

  </form>
</div>
<!-- reset password request form -->
      <div id="reset-password-request-form" class="gform_wrapper">
<form method="post" action="<?php echo get_permalink(429) ?>">
  <div class="gform_heading">
<h3 class="gform_title">Reset Password</h3>
<span class="gform_description"></span>
</div>
   <?php if(!empty($login->message)): ?>
  <div class="validation_error"><?php echo $login->message ?></div>
<?php endif ?>
  <div class='gform_body'>
  <ul>
    <?php
    $email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
?>
    <li><label class='gfield_label' for="user_email">Registered Email Address<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_email' id='user_email' type='text' value='<?php echo $email ?>' class='medium'    /></div>
</li>
</ul>

 </div>
 <div class='gform_footer top_label'>
  <a href="<?php echo get_permalink(429) ?>">Login</a><button type="submit" class="button">Submit</button>
 <input name="action" type="hidden" value="reset_pwd" />
 <input name="reset_pwd_nonce" type="hidden" value="<?php echo wp_create_nonce( 'reset_pwd_nonce' ); ?>" />
</div>

  </form>
</div>
<!-- password reset form -->
  <div id="reset-password-form" class="gform_wrapper">
        <header> <p>Please enter your new password below.</p></header>
<form method="post" action="">
  <div class="gform_heading">
<h3 class="gform_title">Update Password</h3>
<span class="gform_description"></span>
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
<div class='ginput_container'><input name='user_pwd' id='user_pwd' type='password' value='' class='medium'    /></div>
</li>
<li><label class='gfield_label' for="user_pwd_confirm">Confirm Password<span class='gfield_required'>*</span></label>
<div class='ginput_container'><input name='user_pwd_confirm' id='user_pwd_confirm' type='password' value='' class='medium'    /></div>
</li>
</ul>
</div>
 <div class='gform_footer top_label'>
<a href="<?php echo get_permalink(429) ?>">Login</a>  <button type="submit" class="button">Submit</button>
 <input name="action" type="hidden" value="update_pwd" />
  <input name="user_id" type="hidden" value="<?php echo $login->user_id ?>" />
  <input name="update_pwd_nonce" type="hidden" value="<?php echo wp_create_nonce( 'update_pwd_nonce' ); ?>" />
</div>
  </form>
</div>


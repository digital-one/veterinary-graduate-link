<div class="wrap">
<h2>Login Forms</h2>
<form method="post" action="options.php">
<?php settings_fields('system-email-settings-group'); ?>
<?php do_settings_sections('system-email-settings-group'); ?>
<h3 class="title">Form Pages</h3>
<table class="form-table">
<tbody><tr>
<th scope="row"><label for="from_email">From Name</label></th>
<td><input name="from_name" type="text" id="from_name"  value="<?php echo get_option('from_name') ?>" class="regular-text ltr">
</td>
</tr>
<tr>
<th scope="row"><label for="from_email">From Email Address</label></th>
<td><input name="from_email" type="text" id="from_email"  value="<?php echo get_option('from_email') ?>" class="regular-text ltr">
</td>
</tr>
</tbody></table>
<?php submit_button(); ?>
</form>
</div>
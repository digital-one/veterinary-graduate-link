<!--footer-->
<footer id="footer">
<div class="row top">
<div class="small-12 medium-4 columns"><strong>Call us on:</strong> <a href="tel:01423813450">01423 813 450</a></div>
<div class="small-12 medium-4 columns"><strong>Email us on:</strong> <a href="mailto:vets@prospect-health.com">vets@prospect-health.com</a></div>
<div class="small-12 medium-4 columns"><menu class="social"><strong>Follow us on: </strong><ul><li><a href="#"><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li><li><a href="#"><i class="fa fa-facebook"><span>Facebook</span></i></a></li><li><a href="#"><i class="fa fa-twitter"><span>Twitter</span></i></a></li><li><a href=""><i class="fa fa-google-plus"><span>Google Plus</span></i></a></li></ul></menu></div>
</div>
<div class="row bottom">
<div class="small-12 columns">&copy; Copyright <?php echo date('Y') ?> Prospect Health Recruitment. <span>All rights reserved.</span></div>
</div>
</footer>
<!--/footer-->
<!-- role confirmation -->
<div id="role-selection">
	<form method="post" action="">
		<div class="form-body">
		<p>Are you an:</p>
		<ul>
			<li><input type="radio" name="role" value="1" /> <label for ="role-employer">Employer</label></li>
			<li><input type="radio" name="role" value="1" /> <label for ="role-employer">Job Seeker</label></li>
		</ul>
		</div>
		<footer class="form-footer"><a class="icon-button cancel">Cancel</a><button type="submit" class="icon-button tick">Confirm</button></footer>
	</form>
</div>
<!-- notification -->
<div class="notification">
	<p>Notification message</p>
<footer><menu class="confirm"><ul><li><a href="" class="yes">Yes</a></li><li><a href="" class="no">No</a></li></ul></menu></footer>
	</div>
<!-- /notification -->
<!-- account forms -->
<?php get_template_part('partials/content','account-forms' );  ?>
<!-- /account forms -->
<?php /*
<!-- callback form -->
<div class="popup">
	<a class="close"><i class="fa fa-times"></i> Close</a>
	<!--<p>Fill in your details and we will call you back at a time to suit you</p>-->
	<?php
//(id, display title, display desc, display inactive, field values, ajax, tab index)
gravity_form(2, false, true, false, '', true, 1);
?>
</div>
<!-- /callback form -->
*/ ?>
</body>
</html>
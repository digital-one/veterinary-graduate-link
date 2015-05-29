<?php global $vgl_user ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!--main-->

<!--intro-->
<section id="intro">
<div class="row">
<div class="small-12 medium-8 columns">

<?php if($vgl_user->is_logged_in()): ?>
<h2><?php echo $vgl_user->get_firstname() ?>, Welcome Back to Veterinary Graduate Link</h2>
<?php else: ?>
<h2>Welcome to Veterinary Graduate Link</h2>

<?php endif ?>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Ysonet legere accommodare te mel. </p>
</div>
<div class="small-12 medium-4 columns"><img src="<?php echo get_template_directory_uri(); ?>/images/balloon.png" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/balloon.png'" /></div>
</div>
</section>
<!--/intro-->
<main id="main" role="main">
<section id="page-links">
	<div class="row">
		<div class="small-12 columns">
<?php /* <ul class="xsmall-block-grid-1 small-block-grid-2 medium-block-grid-4"> */ ?>
	<ul class="page-links-xsmall page-links-small page-links-medium">
<li><div class="link"><figure class="icon-box search-color"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.png'" /></div></figure><h3>Search Candidates</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="<?php echo get_permalink(6) ?>" class="icon-button click">Click Here</a></footer></div<</li>
<li><div class="link"><figure class="icon-box blog-color"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.png'" /></div></figure><h3>Blogs &amp; Advice</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="" class="icon-button click">Click Here</a></footer></div></li>
<?php if($vgl_user->is_logged_in()): ?>
<li><div class="link"><figure class="icon-box profile-color"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-profile.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-profile.png'" /></div></figure><h3>Edit Profile</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="<?php echo $vgl_user->get_profile_url() ?>" class="icon-button click">Click Here</a></footer></div></li>
<?php else: ?>
<li><div class="link"><figure class="icon-box profile-color"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-profile.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-profile.png'" /></div></figure><h3>Register</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a rel="role-selection" class="notification-btn icon-button click" class="icon-button click">Click Here</a></footer></div></li>

<?php endif ?>
<li><div class="link"><figure class="icon-box contact-color"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-contact.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-contact.png'" /></div></figure><h3>Contact Us</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="" class="icon-button click">Click Here</a></footer></div></li>
</ul>
</div>
</div>
</section>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
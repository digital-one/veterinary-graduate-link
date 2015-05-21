<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!--main-->
<main id="main" role="main">
<!--intro-->
<section id="intro">
<div class="row">
<div class="small-12 medium-8 columns">
<h2>Welcome to Veterinary Graduate Link</h2>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Ysonet legere accommodare te mel. </p>
</div>
<div class="small-12 medium-4 columns"><img src="<?php echo get_template_directory_uri(); ?>/images/balloon.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/balloon.png'" /></div>
</div>
</section>
<!--/intro-->
<section>
	<div class="row">
		<div class="small-12 columns">
<ul class="xsmall-block-grid-1 small-block-grid-2 medium-block-grid-4">
<li><figure class="icon-box search"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.png'" /></div></figure><h3>Search Candidates</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="" class="icon-button">Click Here</a></footer></li>
<li><figure class="icon-box blog"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.png'" /></div></figure><h3>Blogs &amp; Advice</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="" class="icon-button">Click Here</a></footer></li>
<li><figure class="icon-box profile"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-profile.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-profile.png'" /></div></figure><h3>Edit Profile</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="" class="icon-button">Click Here</a></footer></li>
<li><figure class="icon-box contact"><div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-contact.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-contact.png'" /></div></figure><h3>Contact Us</h3><p>Tationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><footer><a href="" class="icon-button">Click Here</a></footer></li>
</ul>
</div>
</div>
</section>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
<?php /* Template Name: Candidate Profile */ ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro" class="profile">
<div class="row">
<div class="small-12 medium-8 columns">
	<div>
<h1>Your profile</h1>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Ysonet legere accommodare te mel. </p>
</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-profile.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-profile.png'" /></div></div>
</div>
</section>

	<!--main-->
<main id="main" role="main">
	<div class="row">
		<div class="small-12 columns">
	<!--breadcrumbs-->
<div id="page-header">
	<div class="breadcrumbs">
<?php if(function_exists('bcn_display')):
        bcn_display();
    endif;
    ?>
</div>
</div>
<!--/breadcrumbs-->
<?php
//(id, display title, display desc, display inactive, field values, ajax, tab index)
gravity_form(5, false, false, false, '', true, 1);
?>
</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
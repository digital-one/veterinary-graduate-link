<?php /* Template Name: Search Candidates */ ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro" class="search-color">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-uncentered medium-8 columns">
	<div>
<h1>Search Candidates</h1>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Ysonet legere accommodare te mel. </p>
</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.png'" /></div></div>
</div>
</section>

	<!--main-->
<main id="main" role="main">
	<div class="row">
		<div class="xsmall-12 small-9 small-centered medium-uncentered medium-12 columns">
	<!--breadcrumbs-->
	<div id="page-header" class="row">
<div class="small-12 columns">
	<div class="breadcrumbs">
<?php if(function_exists('bcn_display')):
        bcn_display();
    endif;
    ?>
</div>
<div class="shortlist-link"><i class="fa fa-user"></i> 0 Candidates in <a href="<?php echo get_permalink(19) ?>">your shortlist</a></span></div>
</div>
</div>
<!--/breadcrumbs-->
<!--search form-->
<section id="search-form" class="gform_wrapper">
	<header class="gform_header row">

	<div class="small-12 columns">
<h2>Please complete at least one of these fields:</h2>
</div>
</header>
<form>
	<div class="gform_body">
	<ul class="form-body row">
<li class="small-12 medium-6 large-4 gfield columns">
<input type="text" name="ref" placeholder="Ref. No" tabindex="1" />
</li>
<li class="small-12 medium-6 large-4 gfield columns no-label">
	<label class="gfield_label">Location</label>
<select name="location"  tabindex="2"><option value="">Location</option></select>
</li>
<li class="small-12 medium-6 large-4 gfield columns no-label">
	<label class="gfield_label">Graduation Year</label>
<select name="graduation_year"  tabindex="3"><option value="">Graduation Year</option></select>
</li>
<li class="small-12 medium-6 large-4 gfield columns no-label">
	<label class="gfield_label">University</label>
<select name="university"  tabindex="4"><option value="">University</option></select>
</li>
<li class="small-12 medium-6 large-4 gfield columns gfield_checkbox">
	<div class="half"><input type="checkbox" value="1" name="small-animal" id="small-animal"   tabindex="5" /><label for="small-animal">Small Animal</label></div>
	<div class="half"><input type="checkbox" value="1" name="farm-animal" id="farm-animal"   tabindex="6" /><label for="small-animal">Farm Animal</label></div>
</li>
<li class="small-12 medium-6 large-4 gfield columns gfield_checkbox">
	<div class="half"><input type="checkbox" value="1" name="equine" id="equine"   tabindex="7" /><label for="equine">Equine</label></div>
	<div class="half"><input type="checkbox" value="1" name="exotics" id="exotics"   tabindex="8" /><label for="exotics">Exotics</label></div>
</li>
<li class="small-12 medium-6 large-4 gfield columns gfield_checkbox">
<div class="half"><input type="checkbox" value="1" name="medicine" id="medicine"   tabindex="9" /><label for="medicine">Medicine</label></div>
	<div class="half"><input type="checkbox" value="1" name="surgery" id="surgery"   tabindex="10" /><label for="surgery">Surgery</label></div>
</li>
<li class="small-12 medium-6 large-4 gfield columns gfield_checkbox">
<div class="half"><input type="checkbox" value="1" name="out-of-hours" id="out-of-hours"   tabindex="11" /><label for="out-of-hours">Out of Hours</label></div>
	<div class="half"><input type="checkbox" value="1" name="weekends" id="weekends"   tabindex="12" /><label for="weekends">Weekends</label></div>
</li>
<li class="small-12 medium-6 large-4 columns gfield gfield_checkbox end">
<div class="half"><input type="checkbox" value="1" name="nights" id="nights"   tabindex="13" /><label for="nights">Nights</label></div>
	<div class="half"><input type="checkbox" value="1" name="internship" id="internship" tabindex="14" /><label for="internship">Internship</label></div>
</li>
</ul>
</div>
<div class="gform_footer row">
<div class="small-12 columns"><button type="submit" class="icon-button search">Search</button><a href="<?php echo get_permalink(19) ?>" title="My Shortlist" class="icon-button shortlist">My Shortlist</a></div>
</div>
</form>
</section>
<!--/search form-->
<!--search results-->
<section id="search-results" >
	<div id="posts">
		<!--item-->
<article class="post candidate row">
<div class="small-12 columns">
	<div class="inner-wrap">
	<div class="row">
<div class="small-12 columns">
<header><h3>REF NO: V12302-GA</h3><p><i class="fa fa-graduation-cap"></i>  <strong>GRADUATED FROM:</strong> Glasgow <strong>IN:</strong> April 2011</p><p><i class="fa fa-map-marker"></i> <strong>WILLING TO WORK IN:</strong> Yorkshire &amp; Humberside, Essex, Wales, North East</p>
</header>
<div class="row categories">
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Small Animal:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Farm Animal:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Equine:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Exotics:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Medicine:</strong> <i class="fa fa-times"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Surgery:</strong> <i class="fa fa-times"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Out of Hours:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Weekends:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Nights:</strong> <i class="fa fa-times"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns end"><strong>Internship:</strong> <i class="fa fa-times"></i></div>
	</div>
	<main class="profile">
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. 
</p>
</main>
<footer><div class="buttons"><a href="" class="icon-button profile">Show Profile</a><a href="" class="icon-button plus">Shortlist Me</a></div></footer>
</div>
</article>
<!--/item-->
		<!--item-->
<article class="post candidate row">
<div class="small-12 columns">
	<div class="inner-wrap">
	<div class="row">
<div class="small-12 columns">
<header><h3>REF NO: V12302-GA</h3><p><i class="fa fa-graduation-cap"></i>  <strong>GRADUATED FROM:</strong> Glasgow <strong>IN:</strong> April 2011</p><p><i class="fa fa-map-marker"></i> <strong>WILLING TO WORK IN:</strong> Yorkshire &amp; Humberside, Essex, Wales, North East</p>
</header>
<div class="row categories">
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Small Animal:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Farm Animal:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Equine:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Exotics:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Medicine:</strong> <i class="fa fa-times"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Surgery:</strong> <i class="fa fa-times"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Out of Hours:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Weekends:</strong> <i class="fa fa-check"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong>Nights:</strong> <i class="fa fa-times"></i></div>
	<div class="xsmall-6 small-4 medium-3 large-2 columns end"><strong>Internship:</strong> <i class="fa fa-times"></i></div>
	</div>
	<main class="profile">
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. 
</p>
</main>
<footer><div class="buttons"><a href="" class="icon-button profile">Show Profile</a><a href="" class="icon-button plus">Shortlist Me</a></div></footer>
</div>
</article>
<!--/item-->
</div>
<footer id="posts-footer"><a href="" class="more-posts"><i class="fa fa-cog fa-spin"></i> Loading more results</a></footer>
</section>

<!--search results-->
</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
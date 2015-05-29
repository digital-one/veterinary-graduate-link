<?php /* Template Name: Blog */ ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro" class="blog-color">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-uncentered medium-8 columns">
	<div>
<h1>Blogs &amp; Advice</h1>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Ysonet legere accommodare te mel. </p>
</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.png'" /></div></div>
</div>
</section>

	<!--main-->
<main id="main" role="main">
		<div class="row">
		<div class="xsmall-12 small-9 small-centered medium-uncentered medium-12 columns">
		<!--breadcrumbs-->
<div id="page-header">
	<div class="breadcrumbs">
<?php if(function_exists('bcn_display')):
        bcn_display();
    endif;
    ?>
</div>

<!--/breadcrumbs-->
<div class="shortlist-link"><i class="fa fa-user"></i> 0 Candidates in <a href="<?php echo get_permalink(19) ?>">your shortlist</a></span></div>
</div>
<!--/breadcrumbs-->
<!--search form-->
<section id="archive-form" class="gform_wrapper">
	<header class="gform_header row">

	<div class="small-12 columns">
<h2>Please complete at least one of these fields:</h2>
</div>
</header>
<form>
	<div class="gform_body">
	<ul class="form-body row">
<li class="small-12 medium-4 gfield columns no-label">
	<label class="gfield_label">Category</label>
<select name="category"  tabindex="3"><option value="">Category</option></select>
</li>
<li class="small-12 medium-4 gfield columns no-label">
	<label class="gfield_label">Month</label>
<select name="month"  tabindex="4"><option value="">Month</option></select>
</li>
<li class="small-12 medium-4 columns"><button type="submit" class="icon-button search">Search</button></li>
</ul>
</div>
</form>
</section>
<!--/search form-->
<!--search results-->
<section id="archive">
	<div id="posts">
<article class="post row">
<div class="small-12 columns">
	<div class="inner-wrap">
	<div class="row">
<aside class="small-12 medium-3 columns"><figure>image</figure></aside>
<main class="small-12 medium-9 columns">
<header><h3>Benefits of Becoming a Vet</h3><p><small><strong>Posted on:</strong> 12/04/2014 <strong>By:</strong> Dom Clawson</small></p></header>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus ancillae indoctum, sonet legere accommodare te mel. Magna idque pro te, ius platonem consequat ex. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere a.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi accommodare te mel.</p>
<footer><menu class="social"><strong>SHARE ON: </strong><ul><li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li><li><a href="#" class="facebook"><i class="fa fa-facebook"><span>Facebook</span></i></a></li><li><a href="#" class="twitter"><i class="fa fa-twitter"><span>Twitter</span></i></a></li><li><a href="" class="google-plus"><i class="fa fa-google-plus"><span>Google Plus</span></i></a></li></ul></menu><span class="buttons"><a href="<?php echo get_permalink(32) ?>" class="icon-button read">Read more</a></span></footer>
</main>
</div>
</div>
</div>
</article>
<article class="post row">
<div class="small-12 columns">
	<div class="inner-wrap">
	<div class="row">
<aside class="small-12 medium-3 columns"><figure>image</figure></aside>
<main class="small-12 medium-9 columns">

	<header><h3>Benefits of Becoming a Vet</h3><p><small>Posted on: 12/04/2014 By: Dom Clawson</small></p></header>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus ancillae indoctum, sonet legere accommodare te mel. Magna idque pro te, ius platonem consequat ex. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere a.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi accommodare te mel.</p>
<footer><menu class="social"><strong>SHARE ON: </strong><ul><li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li><li><a href="#" class="facebook"><i class="fa fa-facebook"><span>Facebook</span></i></a></li><li><a href="#" class="twitter"><i class="fa fa-twitter"><span>Twitter</span></i></a></li><li><a href="" class="google-plus"><i class="fa fa-google-plus"><span>Google Plus</span></i></a></li></ul></menu><span class="buttons"><a href="<?php echo get_permalink(32) ?>" class="icon-button read">Read more</a></span></footer>
</main>
</div>
</div>
</div>
</article>
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
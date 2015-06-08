<?php /* Template Name: Your Shortlist */ ?>
<?php get_header() ?>
<?php
global $shortlist;
global $vgl_user;
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro" class="search-color">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-uncentered medium-8 columns">
	<div>
<h1>Your Shortlist</h1>
<p>Lorem ipsum dolor sit amet, eu enim nostrum scribentur ius, ei vix suas oporteat. Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p>
<p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel.</p><p>Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Magna idque pro te, ius platonem consequat ex. Dicant delenit eleifend an mei, wisi disputationi sit ut.Persius volumus principes sed ea, sed erant omnes ex. Sed ex harum ancillae indoctum, sonet legere accommodare te mel. </p>
<p>Ysonet legere accommodare te mel. </p>
</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/your-shortlist-page-icon.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/your-shortlist-page-icon.png'" /></div></div>
</div>
</section>

	<!--main-->
<main id="main" role="main">
	<div class="row">
		<div class="xsmall-12 small-9 small-centered medium-uncentered medium-12 columns">
	<?php get_template_part('partials/content','breadcrumbs' );  ?>
<!--search results-->
<section id="search-results" >
	<?php
	if($shortlist->has_candidates()):
	$candidates = $shortlist->get_shortlist_candidates();
foreach($candidates as $user_id):
  	//echo $user_id;
    include( locate_template( 'partials/content-candidate-loop.php' ));
		endforeach;
	else:
 include( locate_template( 'partials/content-no-candidates.php' ));

	endif;
?>

<footer>
<?php
//(id, display title, display desc, display inactive, field values, ajax, tab index)
gravity_form(9, false, false, false, '', false, 1);
?>
	<a href="" class="icon-button tick align-right">Submit List</a>

<?php 
if(isset($_SESSION)):
	$params="";
foreach($_SESSION as $k=>$v):
if(!empty($params)) $params.='&';
$params.=$k.'='.urlencode($v);
endforeach;
?>
<a href="<?php echo get_permalink(6) ?>?<?php echo $params ?>" title="" class="icon-button search align-left">Back to Results</a></footer>
<?php else : ?>
	<a href="<?php echo get_permalink(6) ?>" title="" class="icon-button search align-left">Back to Search</a>
<?php endif ?>
</footer>
</section>

<!--search results-->
</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
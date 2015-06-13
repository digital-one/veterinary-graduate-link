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
<?php the_content() ?>
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
	if(get_user_by('id',$user_id)): //check if user exists
  	//echo $user_id;
	$deleted = get_user_meta($user_id,'deleted',true);
	$archived = false;
	if($shortlist->candidate_is_in_archive($user_id)) $archived = true;

    include( locate_template( 'partials/content-candidate-loop.php' ));
	endif;
		endforeach;
	else:
 include( locate_template( 'partials/content-no-candidates.php' ));

	endif;
?>

<footer>
<?php
//we need to check that the shortlist doesnt only contain candidates that are deleted.
$shortlist_length  = $shortlist->total_shortlist_candidates();
$deleted_candidates = $shortlist->deleted_candidates_in_shortlist();
if($deleted_candidates >= $shortlist_length):

else:
//(id, display title, display desc, display inactive, field values, ajax, tab index)
gravity_form(9, false, false, false, '', true, 1);
endif;
?>
	<?php /* <a href="" class="icon-button tick align-right">Submit List</a> */ ?>

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
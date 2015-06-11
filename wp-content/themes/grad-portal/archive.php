<?php /* Template Name: Blog */ ?>
<?php get_header() ?>


<!--intro-->
<section id="intro" class="blog-color">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-uncentered medium-8 columns">
	<div>
		<?php
		$page = get_post(8);
		echo $page->post_content;
		wp_reset_query();
		?>

</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-blogs-advice.png'" /></div></div>
</div>
</section>

	<!--main-->
<main id="main" role="main">
		<div class="row">
		<div class="xsmall-12 small-9 small-centered medium-uncentered medium-12 columns">

	<?php if(!empty($_POST['cat']) or !empty($_POST['month'])):
 foreach($_POST as $k=>$v):
      $_SESSION[$k] = $v;
      endforeach;
      endif;
 	?>

<?php get_template_part('partials/content','breadcrumbs' );  ?>
<?php get_template_part('partials/content','blog-archive-form' ); ?>
<!--search results-->

<section id="search-results">
	<div id="posts">

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
		'paged' => $paged,
        'post_status' => 'publish',
        'post_type' => 'post',
        'orderby'=>'date',
        'order'=>'DESC',
		);

$cat='';
$month='';
if(!empty($_SESSION)):
	if(!empty($_SESSION['cat'])) $cat = $_SESSION['cat'];
	if(!empty($_SESSION['month'])) $month = $_SESSION['month'];
endif;
if(!empty($_REQUEST)):
	$cat = $_REQUEST['cat'];
	$month = $_REQUEST['month'];
endif;

if(!empty($cat)):
	$args['tax_query'] = array(array('taxonomy'=>'category','field'=>'id','terms'=>$cat));
endif;
if(!empty($month)):
//	http://gradportal.localhost/2015/06/
	$temp = explode('/',$month);
	$args['monthnum'] = $temp[4];
	$args['year'] = $temp[3];
endif;
query_posts($args);
global $wp_query; 
	$total_posts = $wp_query->found_posts;
	if(have_posts()):
while (have_posts() ) : the_post(); 
get_template_part('partials/content','post-loop' ); 
endwhile;
else:
get_template_part('partials/content','no-posts' ); 
endif;
wp_reset_query();
?>

</div>
<?php
$number_posts = 10;
 $total_pages = intval($total_posts/ $number_posts) + 1;
 $current_page = max(1, get_query_var('paged'));
    if ($current_page < $total_pages):
  $next_page = $current_page+1;
?>
<footer id="posts-footer"><a href="<?php echo get_permalink(8).'/page/'.$next_page.'/'; ?>" class="more-posts"><i class="fa fa-cog fa-spin"></i> Loading more results</a></footer>
<?php endif; ?>
</section>

<!--search results-->
</div>
</div>
</main>
<!--/main-->

<?php get_footer() ?> 
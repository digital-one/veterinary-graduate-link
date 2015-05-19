<?php get_header() ?>
	<div id="content" class="row">
<!--main content-->
<main id="main" role="main" class="small-12 medium-9 columns">
<div class="row">
<!--header box-->
<div class="small-12 columns bottom-spaced box padding-2x three-quarter">
<?php
$page = get_post(55);
list($src,$w,$h) = wp_get_attachment_image_src(get_field('page_header_image',55),'header-image');
?>
<div class="box-outer" style="background-image:url('<?php echo $src ?>');">
	<div class="box-content">
		<span class="vcenter-wrap">
			<span class="vcenter">
<?php
$title = $page->post_title;
$paging_permalink = get_permalink(55);
if (is_category()): 
	//$title =  single_cat_title();
	$term_id = get_query_var('cat');
	$paging_permalink = get_category_link( $term_id );
elseif (is_tag()):
	//$title = single_tag_title();
	$tag = get_queried_object();
    $tag_slug  = $tag->slug;
    $tag_id = $tag->id;
	$paging_permalink = get_tag_link( $tag_id );
 elseif (is_day()):
	//$title = the_time('l, F j, Y'); 
elseif (is_month()):
	//$title = the_time('F Y'); 
elseif (is_year()):
	//$title = the_time('Y');
endif;
?>
<h1><?php echo style_heading($title) ?></h1><a href="<?php echo get_permalink(14) ?>" class="button">Get in touch</a></span>
		</span>
	</div>
	</div>
</div>
<!--/header box-->
	<!--box-->
<div class="small-12 columns box bottom-spaced">
<div class="box-outer">
	<div class="box-content">
<form id="search" method="post" action="<?php echo home_url() ?>">
<input type="text" name="s" id="s" value="" placeholder="Search" />
<button type="submit" class="button"><i class="fa fa-search"></i></button>
	</form>
	</div>
</div>
</div>
	<!--/box-->
<!--article-->
<div class="small-12 columns bottom-spaced box padding-2x end">
	<div class="box-outer">
<div class="box-content">
<section id="posts" class="section">
	<div class="posts">
<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if(have_posts()):
while (have_posts() ) : the_post(); 
get_template_part('partials/content','post-loop' ); 
endwhile;
endif;
wp_reset_query();
?>
<?php /* </ul> */ ?>
</div>
<?php
$num_pages = $wp_query->max_num_pages;
$next_page = $paged+1;
?>
<?php /* posts_nav_link(' - ', '&laquo; Prev', 'Next &raquo;'); */ ?>
<footer class="posts-footer"><a href="<?php echo $paging_permalink ?>page/<?php echo $next_page ?>/" class="button load-posts<?php if($paged >= $num_pages): ?> end<?php endif ?>"><i class="fa fa-cog fa-spin"></i> Load more posts</a></footer>

</section>
</div>

</div>


</div>

<!--/article-->

</main>
<!--/main content-->
<?php get_sidebar('blog'); ?>
</div>
<!--/row-->
<!--row-->
<?php get_template_part('partials/content','contacts-bar' );  ?>
<!--/row-->
<?php get_footer() ?> 
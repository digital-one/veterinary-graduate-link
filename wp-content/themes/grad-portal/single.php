<?php /* Template Name: Single */ ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
$class='';
$has_pic = false;
if(has_post_thumbnail()):
list($src,$w,$h) = wp_get_attachment_image_src(get_post_thumbnail_id(),'square-image');
$class='pic ';
$has_pic = true;
endif;
?>
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
		<?php get_template_part('partials/content','breadcrumbs' );  ?>
<?php get_template_part('partials/content','blog-archive-form' ); ?>
<!--search results-->
<section id="archive">
	<div id="posts">
<article class="post row">
<div class="small-12 columns">
	<div class="inner-wrap">
	<div class="row">
<?php if($has_pic): ?>
<aside class="small-12 medium-3 columns"><figure><img src="<?php echo $src ?>" alt="" /></figure></aside>
<main class="small-12 medium-9 columns">
<?php else : ?>
<main class="small-12 columns">
<?php endif ?>

	<header><h3><?php the_title() ?></h3><p><small><strong>Posted on:</strong> <time datetime="<?php the_time('Y-m-j') ?>"><?php the_time(__( 'F j, Y' )) ?></time> <strong>By:</strong> <?php the_author_link( get_the_author_meta( 'ID' )) ?></small></p></header>
<?php the_content () ?>
<footer><?php get_template_part('partials/content','social-menu' );  ?><span class="buttons">
<?php if(get_field('article_doc')): ?>
	<a href="<?php the_field('article_doc') ?>" target="_blank" class="icon-button download">Download</a>
<?php endif ?>
<?php if(!empty($_SESSION)): ?>
	<a href="<?php echo get_permalink(8) ?>?cat=<?php echo $_SESSION['cat'] ?>&amp;month=<?php echo $_SESSION['month'] ?>" class="icon-button search">Back to results</a>
<?php else : ?>
<a href="<?php echo get_permalink(8) ?>" class="icon-button search">Back to posts</a>
<?php endif ?>
</span></footer>
</main>
</div>
</div>
</div>
</article>

</section>

<!--search results-->
</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
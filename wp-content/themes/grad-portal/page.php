<?php /* Template Name: Standard */ ?>
<?php get_header() ?>
	<div id="content" class="row">
<!--main content-->
<main id="main" role="main" class="small-12 medium-9 columns">
<div class="row">

<!--article-->
<div class="small-12 columns bottom-spaced box padding-2x end">
	<div class="box-outer">
	<?php
if(have_posts()):
while (have_posts() ) : the_post(); 
?>
<article class="dotted-links">
	<div class="box-content<?php if(!has_post_thumbnail(get_the_ID())): ?> no-bottom-padding<?php endif ?>">
<header>
<h1><strong><?php the_title() ?></strong></h1>
</header>
<?php the_content() ?>

</div>
<footer class="box-content">
<menu class="share"><span>Share:</span><ul class="share"><li class="twitter"><a href="#">Twitter</a></li><li class="facebook"><a href="">Facebook</a></li></ul></menu>
</footer>
</article>
<?php
endwhile;
endif;
wp_reset_query();
?>
</div>
</div>
<!--/article-->
</main>
<!--/main content-->
<!--sidebar-->
<?php get_sidebar('page'); ?>
<!--/sidebar-->
</div>
<!--/row-->
<!--row-->
<?php get_template_part('partials/content','contacts-bar' );  ?>
<!--/row-->
<?php get_footer() ?> 
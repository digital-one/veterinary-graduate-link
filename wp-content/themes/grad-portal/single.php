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
<article id="post" class="dotted-links">
	<div class="box-content<?php if(!has_post_thumbnail(get_the_ID())): ?> no-bottom-padding<?php endif ?>">
<header>
<h1><strong><?php the_title() ?></strong></h1>
<p><small>By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php the_author_link( get_the_author_meta( 'ID' )) ?></a> on <time datetime="<?php the_time('Y-m-j') ?>"><?php the_time(__( 'F j, Y, H:i A' )) ?></time></small></p>
</header>
<?php the_content() ?>

<footer>
	<?php if( has_tag()): ?>
<ul class="meta"><li><i class="fa fa-tag"></i><small><?php // echo $tag_list ;?><?php the_tags('',', ') ?></small></li></ul>
<?php endif ?>
<menu class="share"><span>Share:</span><ul class="share"><li class="twitter"><a href="#">Twitter</a></li><li class="facebook"><a href="">Facebook</a></li></ul></menu>

</footer>

</div>
<?php if(has_post_thumbnail( get_the_ID())): ?> 

<figure>
<?php
list($src,$w,$h) = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large-image');
?>
<img src="<?php echo $src ?>" />
</figure>
<?php endif ?>
<div class="box-content">
<a href="<?php echo get_permalink(55) ?>" class="button">back to articles</a>
</div>
</article>
<?php
// If comments are open or we have at least one comment, load up the comment template.
if (comments_open() || get_comments_number()):
	comments_template();
endif;
?>
<?php
endwhile;
endif;
wp_reset_query();
?>
<?php /* </ul> */ ?>
</div>
</div>
<!--/article-->
</main>
<!--/main content-->
<!--sidebar-->
<?php get_sidebar('blog'); ?>
<!--/sidebar-->
</div>
<!--/row-->
<!--row-->
<section id="contacts-bar" class="row">
<div class="small-12 columns box orange bottom-spaced">
	<div class="box-outer"><div class="box-content">
<nav><span>Speak to one of our solicitors</span><ul><li><i class="fa fa-phone-square"></i><a href="tel:01132449931">0113 244 9931</a></li><li><i class="fa fa-envelope"></i><a href="mailto:info@levisolicitors.co.uk">info@levisolicitors.co.uk</a></li><li><i class="fa fa-check-square"></i><a href="#">Request a call-back team</a></li></ul></nav>
</div>
</div>
</div>
</section>
<!--/row-->
<?php get_footer() ?> 
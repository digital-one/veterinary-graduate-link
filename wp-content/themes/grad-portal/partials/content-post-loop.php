<?php
$class='';
$has_pic = false;
if(has_post_thumbnail()):
list($src,$w,$h) = wp_get_attachment_image_src(get_post_thumbnail_id(),'square-image');
$class='pic ';
$has_pic = true;
endif;
?>
<article class="post row">
<div class="small-12 columns">
	<div class="inner-wrap">
	<div class="row">
	<?php if($has_pic): ?>
<aside class="small-12 medium-3 columns"><figure><img src="<?php echo $src ?>" /></figure></aside>
<main class="small-12 medium-9 columns">
<?php else : ?>
<main class="small-12 columns">
<?php endif ?>
<header><h3><?php the_title() ?></h3><p><small><strong>Posted on:</strong> <time datetime="<?php the_time('Y-m-j') ?>"><?php the_time(__( 'F j, Y' )) ?></time> <strong>By:</strong> <?php the_author_link( get_the_author_meta( 'ID' )) ?></small></p></header>
<?php the_excerpt() ?>
<footer><?php get_template_part('partials/content','social-menu' );  ?><span class="buttons"><a href="<?php the_permalink() ?>" class="icon-button read">Read more</a></span></footer>
</main>
</div>
</div>
</div>
</article>
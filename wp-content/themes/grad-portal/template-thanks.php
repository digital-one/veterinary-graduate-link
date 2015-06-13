<?php /* Template Name: Thank you */ ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-8 columns centered-text">
<?php the_content() ?>
<p><strong>In the meantime, follow us on:</strong></p>
<menu class="social"><ul><li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li><li><a href="#" class="facebook"><i class="fa fa-facebook"><span>Facebook</span></i></a></li><li><a href="#" class="twitter"><i class="fa fa-twitter"><span>Twitter</span></i></a></li><li><a href="" class="google-plus"><i class="fa fa-google-plus"><span>Google Plus</span></i></a></li></ul></menu>
<footer><a href="<?php echo home_url() ?>" class="icon-button home">Homepage</a>
<?php if(get_the_ID()==180): //only show search button if on shortlist confirm page ?>
	<?php 
if(isset($_SESSION)):
	$params="";
foreach($_SESSION as $k=>$v):
if(!empty($params)) $params.='&';
$params.=$k.'='.urlencode($v);
endforeach;
?>
<a href="<?php echo get_permalink(6) ?>?<?php echo $params ?>" title="" class="icon-button search">Back to Results</a></footer>
<?php else : ?>
	<a href="<?php echo get_permalink(6) ?>" title="" class="icon-button search align-left">Back to Search</a>
<?php endif ?>
<?php endif ?>
</footer>


</div>
</div>
</section>

	<!--main-->
<main id="main" role="main">
	<div class="row">
		<div class="xsmall-12 small-9 small-centered medium-uncentered medium-12 columns">

</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
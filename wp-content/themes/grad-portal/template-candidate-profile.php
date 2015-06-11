<?php /* Template Name: Candidate Profile */ ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro" class="profile-color">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-uncentered medium-8 columns">
	<div>
<?php the_content() ?>
</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-profile.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-profile.png'" /></div></div>
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
</div>
<!--/breadcrumbs-->
<?php
//(id, display title, display desc, display inactive, field values, ajax, tab index)
gravity_form(5, false, false, false, '', true, 1);
?>
<footer id="form-footer" class="row"><div class="xsmall-12 columns">To delete your account <a class="delete-user"><em><strong>CLICK HERE</strong></em></a></div></footer>
</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
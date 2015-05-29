<?php /* Template Name: Contact */ ?>
<?php get_header() ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro" class="contact-color">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-uncentered medium-8 columns">
	<div>
<h1>Contact Us</h1>
<p>There are several different ways to get in touch with us and we're always happy to chat. Please be specific with your enquiry so we can endeavour to help you in the best possible way. We'd love to hear from you.</p>
<p>You can fill in the form provided below, call us on <a href="tel:01423 813 450">01423 813 450</a>, email us at <a href="Vets@prospect-health.com">Vets@prospect-health.com</a> or alternatively write to our head office at:</p>
<p>Prospect Health<br />
2nd Floor, Clarendon House<br />
Victoria Avenue<br />
Harrogate<br />
HG1 1JD
</p>
<p>Once received, we will process your request and try to get back in touch as soon as possible.</p>
</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-contact.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-contact.png'" /></div></div>
</div>
</section>

	<!--main-->
<main id="main" role="main">
	<div class="row">
		<div class="xsmall-12 small-9 small-centered medium-uncentered medium-12 columns">
	<!--breadcrumbs-->
	<div id="page-header" class="row">
<div class="small-12 columns">
	<div class="breadcrumbs">
<?php if(function_exists('bcn_display')):
        bcn_display();
    endif;
    ?>
</div>
<div class="shortlist-link"><i class="fa fa-user"></i> 0 Candidates in <a href="<?php echo get_permalink(19) ?>">your shortlist</a></span></div>
</div>
</div>
<!--/breadcrumbs-->
<?php
//(id, display title, display desc, display inactive, field values, ajax, tab index)
gravity_form(7, false, false, false, '', true, 1);
?>
</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
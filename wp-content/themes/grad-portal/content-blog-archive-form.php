<!--search form-->
<section id="archive-form" class="gform_wrapper">
	<header class="gform_header row">

	<div class="small-12 columns">
<h2>Please complete at least one of these fields:</h2>
</div>
</header>
<form method="post" action="" id="blog-search">
	<div class="gform_body row">
	<ul class="form-body">
<li class="small-12 medium-4 gfield columns no-label">
	<label class="gfield_label">Category</label>
<?php
$args = array(
	'show_option_all'    => 'Select Category',
	//'show_option_none'   => 'All Categories',
	'option_none_value'  => 'No Categories Available',
	'orderby'            => 'name', 
	'order'              => 'ASC',
	'show_count'         => 0,
	'hide_empty'         => 1
); 
if(!empty($_POST) and $_POST['cat']):
$args['selected'] =  $_POST['cat'];
endif;
wp_dropdown_categories( $args );
?>
</li>
<li class="small-12 medium-4 gfield columns no-label">
	<label class="gfield_label">Month</label>
<select name="month"  tabindex="4">
 <option value=""><?php echo esc_attr( __( 'Select Month' ) ); ?></option> 
 <?php add_filter("get_archives_link", "get_archives_link_mod"); ?>
  <?php 
  wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 0 )) ;
  ?>
	</select>
</li>
<li class="small-12 medium-4 columns"><button type="submit" class="icon-button search">Search</button></li>
</ul>
</div>
</form>
</section>
<!--/search form-->
<?php
wp_redirect(home_url().'/?activate-success=1');
exit();

/*
global $gw_activate_template;
extract( $gw_activate_template->result );
$url = is_multisite() ? get_blogaddress_by_id( (int) $blog_id ) : home_url('', 'http');
$user = new WP_User( (int) $user_id );
?>
<div id="breadcrumb"><div class="container"><span typeof="v:Breadcrumb">
<a rel="v:url" property="v:title" title="Go to Paget's Association." href="http://92.60.114.159/~pagetorg" class="home">Home</a>
</span>
<span class="separator">></span>
<span typeof="v:Breadcrumb">
<span property="v:title">Account Activated</span>
</span></div></div>
<div  class="account content two-column main-left">
	<div class="container">
<div id="main" role="main" class="professionals">
	<div class="gutter-right">
<?php $page = get_post(421); ?>
<?php echo $page->post_content ?> 
</div>
</div>
<aside id="right-sidebar">
	 <?php
if(get_field('page_banners',421)): 
while(the_repeater_field('page_banners',421)): 
 $banner = get_sub_field('banner');
echo do_shortcode($banner->post_content);
  endwhile;
  endif;
  ?>
</aside>
</div>
</div>
*/
?>
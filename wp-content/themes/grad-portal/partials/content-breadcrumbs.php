<?php
global $vgl_user;
global $shortlist;
?>
	<!--breadcrumbs-->
	<div id="page-header" class="row">
<div class="small-12 columns">
	<div class="breadcrumbs">
<?php if(function_exists('bcn_display')):
        bcn_display();
    endif;
    ?>
</div>
<?php if($vgl_user->is_employer()): ?>
  
<div class="shortlist-link"<?php if(!$shortlist->has_candidates()): ?> style="display:none;"<?php endif ?>  ><i class="fa fa-user"></i>
  <span class="count">
    <?php
    echo $shortlist->shortlist_total();
?>
</span> in <a href="<?php echo get_permalink(19) ?>">your shortlist</a></span></div>
<?php endif ?>

</div>
</div>
<!--/breadcrumbs-->
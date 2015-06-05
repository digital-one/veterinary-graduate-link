 <?php 
    global $shortlist;
        $ref = get_user_meta($user->ID,'reference',true);
        $uni_id = get_user_meta($user->ID,'university',true);
        $uni = get_post($uni_id);

        $bio = get_user_meta($user->ID,'bio',true);
        $grad_year = get_user_meta($user->ID,'graduation_year',true);
        $locations = get_user_meta($user->ID,'locations',true);
        $locations_array = explode(',',$locations);
        $locations_str = "";
        foreach($locations_array as $location_id):
          $location = get_post($location_id);
          if(!empty($locations_str)) 
            $locations_str.=', ';
            $locations_str.= ucfirst($location->post_title);
        endforeach;
        $locations = $locations_str;
        $metas = array(
          array('meta_key'=>'small_animal','meta_label'=>'Small Animal'),
          array('meta_key'=>'farm_animal','meta_label'=>'Farm Animal'),
          array('meta_key'=>'equine','meta_label'=>'Equine'),
          array('meta_key'=>'exotics','meta_label'=>'Exotics'),
          array('meta_key'=>'medicine','meta_label'=>'Medicine'),
          array('meta_key'=>'surgery','meta_label'=>'Surgery'),
          array('meta_key'=>'out_of_hours','meta_label'=>'Out of Hours'),
          array('meta_key'=>'weekends','meta_label'=>'Weekends'),
          array('meta_key'=>'nights','meta_label'=>'Nights'),
          array('meta_key'=>'internship','meta_label'=>'Internship')
          );
        foreach($metas as $k=>$meta):
        ${$meta['meta_key']} = get_user_meta($user->ID,$meta['meta_key'],true);
        endforeach;
        ?>
		<!--item-->
<article class="post candidate row">
<div class="small-12 columns">
	<div class="inner-wrap">
	<div class="row">
<div class="small-12 columns">
<header><h3>REF NO: <?php echo $ref ?></h3><p><i class="fa fa-graduation-cap"></i>  <strong>GRADUATED FROM:</strong> <?php echo $uni->post_title ?> <strong>IN:</strong> <?php echo $grad_year ?></p><p><i class="fa fa-map-marker"></i> <strong>WILLING TO WORK IN:</strong> <?php echo $locations ?></p>
</header>
<div class="row categories">
  <?php 
  foreach ($metas as $k=>$meta):
    $class = !empty(${$meta['meta_key']}) ? 'fa-check' : 'fa-times';
  ?>
	<div class="xsmall-6 small-4 medium-3 large-2 columns"><strong><?php echo $meta['meta_label'] ?>:</strong> <i class="fa <?php echo $class ?>"></i></div>
    <?php endforeach; ?>
	</div>
	<main class="profile">
<?php echo $bio ?>
</main>
<footer><div class="buttons"><a href="" class="icon-button profile">Show Profile</a>
<?php 
global $vgl_user;
 if($vgl_user->is_employer()): ?>
  <form class="shortlist">
  <?php if(!$shortlist->candidate_added($user->ID)): ?>
  <a href="" class="icon-button  plus">Shortlist Me</a>
   <input type="hidden" name="action" value="shortlist_add_me" />
   <?php else : ?>
    <a href="" class="icon-button  minus">Remove Me</a>
   <input type="hidden" name="action" value="shortlist_remove_me" />
 <?php endif ?>
  <input type="hidden" name="candidate_id" value="<?php echo $user->ID ?>" />
  <input type="hidden" name="user_id" value="<?php echo $vgl_user->get_id() ?>" />
</form>
<?php endif ?>
</div></footer>
</div>
</article>
<!--/item-->

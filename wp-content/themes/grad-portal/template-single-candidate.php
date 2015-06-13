<?php /* Template Name: Single Candidate */ ?>
<?php
global $vgl_user;
global $shortlist;
?>
<?php get_header() ?>
<?php if(!empty($_POST) and $_POST['search']==1):
 foreach($_POST as $k=>$v):
      $_SESSION[$k] = $v;
      endforeach;
      endif;
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--intro-->
<section id="intro" class="search-color">
<div class="row">
<div class="xsmall-12 small-9 small-centered medium-uncentered medium-8 columns">
	<div>
<?php the_content() ?>
</div>
</div>
<div class="small-12 medium-4 columns"><div class="page-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/icon-search-candidates.png'" /></div></div>
</div>
</section>
<!--/intro -->
	<!--main-->
<main id="main" role="main">
	<div class="row">
		<div class="xsmall-12 small-9 small-centered medium-uncentered medium-12 columns">
<?php get_template_part('partials/content','breadcrumbs' );  ?>
<!--search form-->
<section id="search-form" class="gform_wrapper">
	<header class="gform_header row">

	<div class="small-12 columns">
<h2>Please complete at least one of these fields:</h2>
</div>
</header>
<form id="candidate-search" method="post" action="">
	<div class="gform_body">
	<ul class="form-body small-block-grid-1 medium-block-grid-2 large-block-grid-3">
<li class="gfield columns">
<input type="text" name="ref" placeholder="Ref. No" tabindex="1" value="<?php if(isset($_REQUEST['ref'])) echo urldecode($_REQUEST['ref']); ?>" />
</li>
<li class="no-label multi-select">
	<label class="gfield_label">Where are your vacancies based?</label>

<select multiple name="locations[]" id="locations" tabindex="2" placeholder="Where are your vacancies based?">
   <?php
  if(isset($_REQUEST)):
    //save session data of search
     $posted_locations = array();
    foreach($_REQUEST['locations'] as $k=>$location):
      $posted_locations[] = $location;
    endforeach;
    endif;
    ?>
	<option value="">All Locations</option>
	<?php
       $args = array(
          'orderby'=>'title',
          'order'=>'ASC',
          'hide_empty'=>0
          );
   // if($terms = get_terms('region',$args)):
   //   foreach($terms as $term):
        //check if region has more than 1 location
	$args = array(
    'post_type' => 'cpt-location',
    'posts_per_page' => -1,
    'post_status' => 'publish',
  /*  'tax_query' => array(
      array(
      'taxonomy' => 'region',
      'field' => 'id',
      'terms' => $term->term_id
      )
    ), */
    'orderby' => 'name',
    'order' => 'ASC'
    );
  $locations = get_posts($args);
  $num_locations = count($locations);
  //if($num_locations>1):
	//echo '<optgroup label="'.$term->name.'">';
  // endif;
      // get the associated locations
  if($locations):
  foreach($locations as $location):
   // $selected = in_array($location->ID, $posted_locations) ? ' selected="selected"' : '';
   $selected = in_array($location->post_title, $posted_locations) ? ' selected="selected"' : '';
  //	echo '<option value="'.$location->ID.'"'.$selected.'>'.$location->post_title.'</option>';
      echo '<option value="'.$location->post_title.'"'.$selected.'>'.$location->post_title.'</option>';
      endforeach;
    endif;
  //   if($num_locations>1):
	//echo '</optgroup>';
  // endif;
   // endforeach;
  //  endif;
    ?>
</select>
<div class="gfield_description">You can choose more than one location</div>
</li>
<?php /*
<li class="gfield no-label">
	<label class="gfield_label">Graduation Year</label>
<select name="graduation_year"  tabindex="3"><option value="">Graduation Year</option>
<?php
 $year = date('Y');
      for($i=0;$i<2;$i++):
      	$val = $year-$i;
        $selected = $_REQUEST['graduation_year']==$val ? ' selected="selected"' : '';
      	echo '<option value="'.$val.'"'.$selected.'>'.$val.'</option>';
      endfor;
  ?>
</select>
</li>
*/
?>
<li class="gfield no-label">
	<label class="gfield_label">All Universities</label>
<select name="university"  tabindex="4">
	<option value="">All Universities</option>

<?php
  $args = array(
    'post_type' => 'cpt-university',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
    );
      if($unis= get_posts($args)):
        foreach($unis as $uni):
         // $selected = urldecode($_REQUEST['university'])==$uni->ID ? ' selected="selected"' : '';
         $selected = urldecode($_REQUEST['university'])==$uni->post_title ? ' selected="selected"' : '';
        	//echo '<option value="'.$uni->ID.'"'.$selected.'>'.$uni->post_title.'</option>';
            echo '<option value="'.$uni->post_title.'"'.$selected.'>'.$uni->post_title.'</option>';
          endforeach;
      endif;
?>
</select>
</li>
</ul>
<ul class="form-body small-block-grid-1">
<li id="field_2_17" class="ca-field field_sublabel_below field_description_below" style="display: list-item;">
<label class="gfield_label">Does your candidate need to work:</label>
<div class="ginput_container">
<ul class="gfield_checkbox small-block-grid-2 medium-block-grid-4 large-block-grid-6" id="input_2_17">
   <?php $checked = isset($_REQUEST['out_of_hours'])=='out_of_hours' ? ' checked="checked"' : ''; ?>
  <li class="gchoice_17_1"><input type="checkbox" value="out of hours" name="out_of_hours" id="out_of_hours"   tabindex="11" <?php echo $checked ?> /><label for="out_of_hours">Out of Hours</label></li>
     <?php $checked = isset($_REQUEST['weekends'])=='weekends' ? ' checked="checked"' : ''; ?>
  <li class="gchoice_17_2"><input type="checkbox" value="weekends" name="weekends" id="weekends"   tabindex="12" <?php echo $checked ?> /><label for="weekends">Weekends</label></li>
   <?php $checked = isset($_REQUEST['nights'])=='nights' ? ' checked="checked"' : ''; ?>
  <li class="gchoice_17_3"><input type="checkbox" value="nights" name="nights" id="nights"   tabindex="13" <?php echo $checked ?> /><label for="nights">Nights</label></li>
     <?php $checked = isset($_REQUEST['internship'])=='internship' ? ' checked="checked"' : ''; ?>
  <li class="gchoice_17_4"><input type="checkbox" value="internship" name="internship" id="internship" tabindex="14" <?php echo $checked ?> /><label for="internship">Internship</label></li>
</ul>
</div>
</li>

<li id="field_2_18" class="ca-field field_sublabel_below field_description_below" style="display: list-item;">
  <label class="gfield_label">Basic interests:</label>
  <div class="ginput_container">
    <ul class="gfield_checkbox  small-block-grid-2 medium-block-grid-4 large-block-grid-6" id="input_2_18">
      <?php $checked = isset($_REQUEST['small_animal'])=='small_animal' ? ' checked="checked"' : ''; ?>
      <li class="small-6 medium-3 large-2 columns  gchoice_18_1">
    <input type="checkbox" value="small animal" name="small_animal" id="small_animal" tabindex="5" <?php echo $checked ?> /><label for="small-animal">Small Animal</label></li>
     <?php $checked = isset($_REQUEST['farm_animal'])=='farm_animal' ? ' checked="checked"' : ''; ?>
        <li class="small-6 medium-3 large-2 columns  gchoice_18_2"><input type="checkbox" value="farm animal" name="farm_animal" id="farm_animal" tabindex="6" <?php echo $checked ?> /><label for="small-animal">Farm Animal</label></li>
         <?php $checked = isset($_REQUEST['equine'])=='equine' ? ' checked="checked"' : ''; ?>
        <li class="small-6 medium-3 large-2 columns  gchoice_18_3"><input type="checkbox" value="equine" name="equine" id="equine"   tabindex="7" <?php echo $checked ?> /><label for="equine">Equine</label></li>
           <?php $checked = isset($_REQUEST['exotics'])=='exotics' ? ' checked="checked"' : ''; ?>
        <li class="small-6 medium-3 large-2 columns  end gchoice_18_4"><input type="checkbox" value="exotics" name="exotics" id="exotics"   tabindex="8"  <?php echo $checked ?> /><label for="exotics">Exotics</label></li>
      </ul>
    </div></li>

<li id="field_2_19" class="ca-field field_sublabel_below field_description_below" style="display: list-item;">
  <label class="gfield_label">Further interests:</label>
  <div class="ginput_container">
    <ul class="gfield_checkbox row" id="input_2_19">
        <?php $checked = isset($_REQUEST['medicine'])=='medicine' ? ' checked="checked"' : ''; ?>
      <li class="small-6 medium-3 large-2 columns  gchoice_19_1"><input type="checkbox" value="medicine" name="medicine" id="medicine"   tabindex="9"  <?php echo $checked ?> /><label for="medicine">Medicine</label></li>
       <?php $checked = isset($_REQUEST['surgery'])=='surgery' ? ' checked="checked"' : ''; ?>
      <li class="small-6 medium-3 large-2 columns  end gchoice_19_2"><input type="checkbox" value="surgery" name="surgery" id="surgery"   tabindex="10"  <?php echo $checked ?> /><label for="surgery">Surgery</label></li>
    </ul></div></li>
   
</ul>
</div>
<div class="gform_footer row">
<div class="small-12 columns"><button type="submit" class="icon-button search">Search</button>
<?php if($vgl_user->is_employer()): ?>
<a href="<?php echo get_permalink(19) ?>" title="My Shortlist" class="icon-button shortlist"<?php if(!$shortlist->has_candidates()): ?> style="display:none;"<?php endif ?>>My Shortlist</a><?php endif ?>
</div>
</div>
<input type="hidden" name="search" value="1" />
<input type="hidden" name="searchable" value="1" />
<input type="hidden" name="deleted" value="0" />
<input type="hidden" name="action" id="action" value="candidate_search" />
</form>
</section>
<!--/search form-->
<!--search results-->
<section id="search-results" >
<?php
global $wp_query;
if($user_id = get_query_var('user_id')):
if($user = get_user_by('id',$user_id)):
$vgl_user = new gradportaluser($user);
if($vgl_user->is_candidate()):
include( locate_template( 'partials/content-candidate-loop.php' ));
else:
include( locate_template( 'partials/content-no-candidate-found.php' ));
endif;
else:
include( locate_template( 'partials/content-no-candidate-found.php' ));
endif;
endif;
//echo $wp_query->query_vars('user_id');
?>
 
</section>

<!--search results-->
</div>
</div>
</main>
<!--/main-->
<?php endwhile ?>
<?php endif ?>
<?php get_footer() ?> 
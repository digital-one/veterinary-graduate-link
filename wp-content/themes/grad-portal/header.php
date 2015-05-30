<?php 
global $current_user;
global $vgl_user;
$vgl_user = new gradportaluser($current_user);
global $login;
$login = new login_forms();
$login->init_form();
?>
<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-16x16.png" sizes="16x16" />
<!--[if IE]>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
<![endif]-->
<?php // set /favicon.ico for IE10 win ?>
<meta name="msapplication-TileColor" content="#d3492f">
<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php gravity_form_enqueue_scripts(1, true); ?>
<?php gravity_form_enqueue_scripts(2, true); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<div id="wrap">
		<!--cookies-->
		<?php /*
		<section id="cookie-alert">
			<div class="row">
				<div class="small-12 large-8 columns">
Levi Solicitors LLP would like to place cookies onto your computer to help us make this website better. To find out more about the cookies, see our information on cookies
</div>
<aside class="small-12 large-4 columns">
	<a href="<?php echo get_permalink(334) ?>">Find out more</a>
	<a class="accept">Accept cookies <i class="fa fa-check"></i></a>
	</aside>
		</section>
		*/ ?>
		<!--/cookies-->
	<!-- header -->
	<header id="header">
		<!-- header top -->
		<div id="header-top">
			<div class="row">
				<div class="small-12  columns">
				<div id="notification-panel" class="<?php echo $login->_action ?>">
					<div class="row">
						<div class="small-12 medium-8 medium-centered columns">
<!-- role confirmation -->
<div id="role-selection" class="notification">
	<form id="role-selection-form" method="post" action="<?php echo get_template_directory_uri(); ?>/register_redirect.php">
		<div class="form-body">
		<p>Are you an:</p>
		<ul>
			<li><input type="radio" name="role" id="role-employer" value="employer" /> <label for ="role-employer">Employer</label></li>
			<li><input type="radio" name="role" id="role-candidate" value="candidate" /> <label for ="role-candidate">Job Seeker</label></li>
		</ul>
		</div>
		<footer class="form-footer"><a class="icon-button cancel">Cancel</a><button type="submit" class="icon-button tick">Confirm</button></footer>
	</form>
</div>
<!-- /role confirmation -->
<!-- notification -->
<div id="notification" class="notification">
	<p>Notification message</p>
<footer><menu class="confirm"><ul><li><a href="" class="yes">Yes</a></li><li><a href="" class="no">No</a></li></ul></menu></footer>
	</div>
<!-- /notification -->
<!-- account forms -->
<?php echo do_shortcode('[login-form]'); ?>
<?php echo do_shortcode('[reset-password-form]'); ?>
<?php echo do_shortcode('[update-password-form]'); ?>
<?php //get_template_part('partials/content','account-forms' );  ?>
<!-- /account forms -->
</div>
</div>
</div>
<menu id="account-links">

<?php if(!$vgl_user->is_logged_in()): ?>
	<a href="/?login" rel="login-form" class="notification-btn">Sign in</a> or <a rel="role-selection" class="notification-btn">Register</a>
<?php else: ?>
	<?php 
$redirect = '&amp;redirect_to='.urlencode(wp_make_link_relative(get_option('siteurl')));
$logout_uri = wp_nonce_url( site_url("wp-login.php?action=logout$redirect", 'login'), 'log-out' );
?>
	<a href="<?php echo $logout_uri ?>">Log Out</a> or <a href="<?php echo $vgl_user->get_profile_url() ?>">Account</a>
<?php endif ?>
			</menu>
		</div></div></div>
			<!-- /header top -->

		<div class="row">
			<div class="small-12 columns">
				<a class="menu-toggle">Menu</a>
		
		</div>
		</div>
		<div class="row">
			<div class="small-12 columns">
			<?php if(is_front_page()): ?>
		<h1 class="home-link"><?php echo bloginfo('name'); ?></h1>
	<?php else: ?>
	<a href="<?php echo home_url() ?>" class="home-link" title="<?php echo bloginfo('name'); ?>"><?php echo bloginfo('name'); ?></a>
<?php endif ?>

<aside><h2 id="strapline">Bringing Veterinary Graduates<br />and Employers Together</h2></aside>
</div>
</div>
<div class="row">
	<div class="small-12 columns">
		<!--nav-->
		<nav id="nav">
				<a href="<?php echo home_url() ?>" class="home-link" title="<?php echo bloginfo('name'); ?>"><?php echo bloginfo('name'); ?></a>
<?php wp_nav_menu( array(
		'theme_location' => 'main-menu',
		'menu_id'=> 'main-menu',
		'container' => '',
		'container_class' => '',
		'walker' => new navWalker()
		));
		 ?>
		</nav>
		<!--/nav-->
	</div>
	</div>
</header>
<!-- /header -->
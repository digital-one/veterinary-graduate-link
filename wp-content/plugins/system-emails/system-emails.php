<?php
/**
 * Plugin Name: System Emails
 * Description: Customize the "New User Registration" and "Your username and password" notifications
 * Version: 1.0
 * Author: Neil Mills
 * Author URI: http://www.digital-one.co.uk
 */


  class system_emails {

        var $_email_id;
        var $_type;
        var $_subject;
        var $_message;

    function __construct() {

        add_action( 'init', array($this,'register_cpt_email'), 0 );
        add_action( 'init', array($this,'register_cptax_email_type'),0);
        add_action( 'add_meta_boxes', array($this,'admin_init'),0 );
        add_action( 'save_post', array($this,'save_meta_custom_data') );
        add_action( 'post_updated', array($this,'save_meta_custom_data') );
        add_action('admin_menu',array($this,'plugin_menu'),0);
        add_action( 'admin_init', array($this,'register_plugin_settings'),0 );
        add_filter( 'wp_mail_content_type', array($this,'set_html_content_type'),0 );
        add_action('admin_init',array($this,'add_email_categories'),0);
        add_filter('wp_mail_from', array($this,'new_mail_from'),0);
        add_filter('wp_mail_from_name', array($this,'new_mail_from_name'),0);
        add_filter( 'wpmu_signup_user_notification', array($this,'suppress_signup_user_notification'), 10, 4 ); //suppress the default activation email sent by GF registration and use this
      add_filter( 'wpmu_signup_user_notification_subject', array($this,'activation_subject'),  10, 8 );
     add_filter( 'wpmu_signup_blog_notification_subject', array($this,'activation_subject'),  10, 8 );
    add_filter( 'wpmu_signup_user_notification_email', array( $this, 'activation_email_message' ), 10, 4 );
    add_filter( 'wpmu_signup_blog_notification_email', array( $this, 'activation_email_message' ), 10, 7 );
        $this->load_classes();

        if (!function_exists('wp_new_user_notification')):
            function wp_new_user_notification($user_id, $plaintext_pass = '') {

    //notification sent to admin on new registration.
    //commented out as gravity forms registration plugin takes care of this one
    $user = get_userdata( $user_id );
    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    $email = new wp_email('new-account-admin');
    $message = $email->get_message();
    $title = $email->get_title();
    $login_url = wp_login_url();
    $first_name = $user->first_name;
    $user_email = $user->user_email;
    $find = array('%title%','%first_name%','%user_profile_url%','%user_email%');
        $replace = array($title, $first_name, $login_url, $user_email );
        $html = str_replace($find, $replace, $message);
   // @wp_mail(get_option('admin_email'), $email->get_subject(), $html); //send to admin

    if ( empty($plaintext_pass) )
        return;
    //account confirmation email sent to user
    //i have suppressed the default gravity forms notification as this sends after the user has activated their account
    $email = new wp_email('new-account');
    $message = $email->get_message();
    $title = $email->get_title();
    $gp_user = new gradportaluser($user);
    $profile_url = $gp_user->get_profile_url();
    $first_name = $user->first_name;
    $user_email = $user->user_email;
    $find = array('%title%', '%first_name%','%user_profile_url%','%user_email%');
        $replace = array($title, $first_name, $profile_url, $user_email );
        $html = str_replace($find, $replace, $message);

     // $to, $subject, $message, $headers, $attachments
    wp_mail($user->user_email, $email->get_subject(), $html); //send to user

}
endif;
       
    }

function load_classes(){

    include(plugin_dir_path( dirname( __FILE__ )) . '/system-emails/classes/class.wp_email.php');
}

function register_cpt_email() {

            $labels = array(
                'name'                => _x( 'Emails', 'Post Type General Name', 'text_domain' ),
                'singular_name'       => _x( 'Email', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'           => __( 'Email', 'text_domain' ),
                'parent_item_colon'   => __( 'Parent Email:', 'text_domain' ),
                'all_items'           => __( 'All Emails', 'text_domain' ),
                'view_item'           => __( 'View Email', 'text_domain' ),
                'add_new_item'        => __( 'Add New Email', 'text_domain' ),
                'add_new'             => __( 'Add New', 'text_domain' ),
                'edit_item'           => __( 'Edit Email', 'text_domain' ),
                'update_item'         => __( 'Update Email', 'text_domain' ),
                'search_items'        => __( 'Search Email', 'text_domain' ),
                'not_found'           => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
            );
            $args = array(
                'label'               => __( 'cpt-email', 'text_domain' ),
                'description'         => __( 'Email', 'text_domain' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'taxonomies' => array('email_type'),
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page'
            );
            register_post_type( 'cpt-email', $args );

        }

function register_cptax_email_type() {

            $labels = array(
                'name'                       => _x( 'Email Type', 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( 'Email Type', 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( 'Email Type', 'text_domain' ),
                'all_items'                  => __( 'All Email Types', 'text_domain' ),
                'parent_item'                => __( 'Parent Type', 'text_domain' ),
                'parent_item_colon'          => __( 'Parent Type:', 'text_domain' ),
                'new_item_name'              => __( 'New Email Type', 'text_domain' ),
                'add_new_item'               => __( 'Add Email Type', 'text_domain' ),
                'edit_item'                  => __( 'Edit Email Type', 'text_domain' ),
                'update_item'                => __( 'Update Email Type', 'text_domain' ),
                'separate_items_with_commas' => __( 'Separate Email Type with commas', 'text_domain' ),
                'search_items'               => __( 'Search Email Types', 'text_domain' ),
                'add_or_remove_items'        => __( 'Add or remove email type', 'text_domain' ),
                'choose_from_most_used'      => __( 'Choose from the most used email types', 'text_domain' ),
                'not_found'                  => __( 'Not Found', 'text_domain' ),
            );
            $rewrite = array(
                'slug'                       => '',
                'with_front'                 => true,
                'hierarchical'               => true,
            );
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => false,
                'rewrite'                    => $rewrite,
            );
            register_taxonomy( 'email_type', array( 'cpt-email' ), $args );

        }



    function add_email_categories(){
        wp_insert_term(
            'New Account', // the term 
            'email_type', // the taxonomy
            array(
                'slug' => 'new-account',
                'description' => 'Email sent to customer when new account is created'
            ) 
        );
        wp_insert_term(
            'New Account Admin', // the term 
            'email_type', // the taxonomy
            array(
                'slug' => 'new-account-admin',
                'description' => 'Email sent to admim when new account is created'
            ) 
        );
         wp_insert_term(
            'Activate Account', // the term 
            'email_type', // the taxonomy
            array(
                'slug' => 'activate-account',
                'description' => 'Email sent to customer to activate their account'
            ) 
        );
         wp_insert_term(
            'Password Reset', // the term 
            'email_type', // the taxonomy
            array(
                'slug' => 'password-reset',
                'description' => 'Email sent to customer requesting new password'
            ) 
        );

    }

        function admin_init(){
        // add meta box
            add_meta_box('email_meta', 'Email Options', array($this,'display_email_meta'), 'cpt-email', 'normal', 'high');
        // add options
        }

        function set_html_content_type(){
            return 'text/html';
        }

        function suppress_signup_user_notification($user, $user_email, $key, $meta = array()){
     $email = new wp_email('activate-account');
      $title = $email->get_title();
      $subject = $email->get_subject();
        $message = $email->get_message();

        $find = array('%title%','%activation_url%','%user_email%');
        $replace = array($title, site_url( "?page=gf_activation&key=$key"), $user_email );
        $html = str_replace($find, $replace, $message);
        wp_mail( $user_email, $subject, $html);
            return false;
        }
        function new_mail_from($old) {
           
            $from_email = get_option('from_email');
            return $from_email;
            //return get_option('from_email');
        }

        function new_mail_from_name($old) {
           $from_name =  get_option('from_name');
            return $from_name;
        }

        function activation_subject( $text ) {
            $email = new wp_email('activate-account');
            return $email->get_subject();
        }


        function display_email_meta( $post ) {


    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );
    
    $type = get_post_meta($post->ID,'_email_type',true);
    $subject = get_post_meta( $post->ID, '_email_subject', true );
echo '
<div id="namediv">
    <table class="form-table editcomment">
<tbody>
<tr>
    <td class="first">Subject:</td>
    <td><input type="text" size="30" id="_email_subject" name="_email_subject" value="' . esc_attr( $subject ) . '" /><input type="hidden" name="email_noncename" value="' . wp_create_nonce(__FILE__) . '" /></td>
</tr>

</tbody>
</table></div>';
/*
    echo '<p><label for="_email_subject">';
    _e( 'Subject:', 'myplugin_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="_email_subject" name="_email_subject" value="' . esc_attr( $subject ) . '" /></p>';
    echo '<input type="hidden" name="email_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
    */
}
    
    function save_meta_custom_data($post_id){
        global $post;
        // make sure data came from our meta box
             if ((isset($_POST['post_type']) and $_POST['post_type'] == "cpt-email")):

                 if ( wp_verify_nonce($_POST['email_noncename'],__FILE__)): 
                     if(isset($_POST['_email_subject']) ):
                        $subject= esc_html( trim($_POST['_email_subject']));
                        update_post_meta($post_id, '_email_subject', $subject);
                    endif;
                endif;
            endif;
    }

    function plugin_menu() {
        add_options_page( 'System Email Options', 'System Email Options', 'manage_options', 'system-email-options', array($this,'plugin_options_page') );
    }


    function plugin_options_page() {
        load_template( plugin_dir_path(dirname( __FILE__ )). '/system-emails/options/template-options-page.php' );
    }


    function register_plugin_settings(){
        register_setting( 'system-email-settings-group', 'from_email' );
        register_setting( 'system-email-settings-group', 'from_name' );
        //register_setting( 'system-email-settings-group', 'new_account_activate_subject' );
     //   register_setting( 'system-email-settings-group', 'activate_account_subject' );
    }

//customize the default wp new account email







//
}
$system_emails = new system_emails();
?>
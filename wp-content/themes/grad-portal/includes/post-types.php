<?php

add_action( 'init', 'register_cpt_university', 0 );
add_action( 'init', 'register_cpt_location', 0 );
add_action( 'init', 'register_cptax_region',0);

function register_cpt_university() {

            $labels = array(
                'name'                => _x( 'Universities', 'Post Type General Name', 'text_domain' ),
                'singular_name'       => _x( 'University', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'           => __( 'Universities', 'text_domain' ),
                'parent_item_colon'   => __( 'Parent University:', 'text_domain' ),
                'all_items'           => __( 'All Universities', 'text_domain' ),
                'view_item'           => __( 'View University', 'text_domain' ),
                'add_new_item'        => __( 'Add New University', 'text_domain' ),
                'add_new'             => __( 'Add New', 'text_domain' ),
                'edit_item'           => __( 'Edit University', 'text_domain' ),
                'update_item'         => __( 'Update University', 'text_domain' ),
                'search_items'        => __( 'Search Universities', 'text_domain' ),
                'not_found'           => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
            );
            $args = array(
                'label'               => __( 'cpt-university', 'text_domain' ),
                'description'         => __( 'Universities', 'text_domain' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
               // 'taxonomies' => array('email_type'),
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page'
            );
            register_post_type( 'cpt-university', $args );

}

function register_cpt_location() {

            $labels = array(
                'name'                => _x( 'Locations', 'Post Type General Name', 'text_domain' ),
                'singular_name'       => _x( 'Location', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'           => __( 'Locations', 'text_domain' ),
                'parent_item_colon'   => __( 'Parent Location:', 'text_domain' ),
                'all_items'           => __( 'All Locations', 'text_domain' ),
                'view_item'           => __( 'View Location', 'text_domain' ),
                'add_new_item'        => __( 'Add New Location', 'text_domain' ),
                'add_new'             => __( 'Add New', 'text_domain' ),
                'edit_item'           => __( 'Edit Location', 'text_domain' ),
                'update_item'         => __( 'Update Location', 'text_domain' ),
                'search_items'        => __( 'Search Locations', 'text_domain' ),
                'not_found'           => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
            );
            $args = array(
                'label'               => __( 'cpt-location', 'text_domain' ),
                'description'         => __( 'Locations', 'text_domain' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'taxonomies' => array('region'),
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page'
            );
            register_post_type( 'cpt-location', $args );

}

function register_cptax_region() {

            $labels = array(
                'name'                       => _x( 'Region', 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( 'Region', 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( 'Regions', 'text_domain' ),
                'all_items'                  => __( 'All Regions', 'text_domain' ),
                'parent_item'                => __( 'Parent Region', 'text_domain' ),
                'parent_item_colon'          => __( 'Parent Region:', 'text_domain' ),
                'new_item_name'              => __( 'New Region', 'text_domain' ),
                'add_new_item'               => __( 'Add Region', 'text_domain' ),
                'edit_item'                  => __( 'Edit Region', 'text_domain' ),
                'update_item'                => __( 'Update Region', 'text_domain' ),
                'separate_items_with_commas' => __( 'Separate regions with commas', 'text_domain' ),
                'search_items'               => __( 'Search Regions', 'text_domain' ),
                'add_or_remove_items'        => __( 'Add or remove regions', 'text_domain' ),
                'choose_from_most_used'      => __( 'Choose from the most used regions', 'text_domain' ),
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
            register_taxonomy( 'region', array( 'cpt-location' ), $args );

        }
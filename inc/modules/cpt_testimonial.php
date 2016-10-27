<?php

$labels = array(

    'name'                => _x( 'Testimonials', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'           => __( 'Testimonials', 'smartcat-modules' ),
    'name_admin_bar'      => __( 'Testimonials', 'smartcat-modules' ),
    'parent_item_colon'   => __( '', 'smartcat-modules' ),
    'all_items'           => __( 'All Testimonials', 'smartcat-modules' ),
    'add_new_item'        => __( 'Add New Testimonial', 'smartcat-modules' ),
    'add_new'             => __( 'Add New', 'smartcat-modules' ),
    'new_item'            => __( 'New Testimonial', 'smartcat-modules' ),
    'edit_item'           => __( 'Edit Testimonial', 'smartcat-modules' ),
    'update_item'         => __( 'Update Testimonial', 'smartcat-modules' ),
    'view_item'           => __( 'View Testimonial', 'smartcat-modules' ),
    'search_items'        => __( 'Search Testimonials', 'smartcat-modules' ),
    'not_found'           => __( 'No testimonials found', 'smartcat-modules' ),
    'not_found_in_trash'  => __( 'No testimonials found in trash', 'smartcat-modules' ),

);

$args = array(

    'label'               => __( 'testimonial', 'smartcat-modules' ),
    'description'         => __( 'Create and display your testimonials', 'smartcat-modules' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-format-quote',
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'rewrite'             => false,
    'capability_type'     => 'page',

);

register_post_type( 'testimonial', $args );
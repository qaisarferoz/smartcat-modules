<?php

$labels = array (

    'name'                  => _x( 'Events', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'             => __( 'Events', 'smartcat-modules' ),
    'name_admin_bar'        => __( 'Events', 'smartcat-modules' ),
    'archives'              => __( 'Archives', 'smartcat-modules' ),
    'parent_item_colon'     => __( 'Parent Item:', 'smartcat-modules' ),
    'all_items'             => __( 'All Events', 'smartcat-modules' ),
    'add_new_item'          => __( 'Add New Event', 'smartcat-modules' ),
    'add_new'               => __( 'Add New', 'smartcat-modules' ),
    'new_item'              => __( 'New Event', 'smartcat-modules' ),
    'edit_item'             => __( 'Edit Event', 'smartcat-modules' ),
    'update_item'           => __( 'Update Event', 'smartcat-modules' ),
    'view_item'             => __( 'View Event', 'smartcat-modules' ),
    'search_items'          => __( 'Search Events', 'smartcat-modules' ),
    'not_found'             => __( 'Not found', 'smartcat-modules' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'smartcat-modules' ),
    'featured_image'        => __( 'Featured Image', 'smartcat-modules' ),
    'set_featured_image'    => __( 'Set featured image', 'smartcat-modules' ),
    'remove_featured_image' => __( 'Remove featured image', 'smartcat-modules' ),
    'use_featured_image'    => __( 'Use as featured image', 'smartcat-modules' ),
    'insert_into_item'      => __( 'Insert into event', 'smartcat-modules' ),
    'uploaded_to_this_item' => __( 'Uploaded to this event', 'smartcat-modules' ),
    'items_list'            => __( 'Events list', 'smartcat-modules' ),
    'items_list_navigation' => __( 'Jobs list navigation', 'smartcat-modules' ),
    'filter_items_list'     => __( 'Filter events', 'smartcat-modules' ),

);

$args = array (

    'label'                 => __( 'Event', 'smartcat-modules' ),
    'description'           => __( 'Events', 'smartcat-modules' ),
    'labels'                => $labels,
    'supports'              => array ( 'title', 'editor', 'author', 'thumbnail', ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-calendar-alt',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',

);

register_post_type( 'event', $args );
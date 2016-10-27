<?php

$labels = array (
    
    'name'                  => _x( 'Jobs', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'             => __( 'Jobs', 'smartcat-modules' ),
    'name_admin_bar'        => __( 'Jobs', 'smartcat-modules' ),
    'archives'              => __( 'Archives', 'smartcat-modules' ),
    'parent_item_colon'     => __( 'Parent Item:', 'smartcat-modules' ),
    'all_items'             => __( 'All Jobs', 'smartcat-modules' ),
    'add_new_item'          => __( 'Add New Job', 'smartcat-modules' ),
    'add_new'               => __( 'Add New', 'smartcat-modules' ),
    'new_item'              => __( 'New Job', 'smartcat-modules' ),
    'edit_item'             => __( 'Edit Job', 'smartcat-modules' ),
    'update_item'           => __( 'Update Job', 'smartcat-modules' ),
    'view_item'             => __( 'View Job', 'smartcat-modules' ),
    'search_items'          => __( 'Search Jobs', 'smartcat-modules' ),
    'not_found'             => __( 'Not found', 'smartcat-modules' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'smartcat-modules' ),
    'featured_image'        => __( 'Featured Image', 'smartcat-modules' ),
    'set_featured_image'    => __( 'Set featured image', 'smartcat-modules' ),
    'remove_featured_image' => __( 'Remove featured image', 'smartcat-modules' ),
    'use_featured_image'    => __( 'Use as featured image', 'smartcat-modules' ),
    'insert_into_item'      => __( 'Insert into job', 'smartcat-modules' ),
    'uploaded_to_this_item' => __( 'Uploaded to this job', 'smartcat-modules' ),
    'items_list'            => __( 'Jobs list', 'smartcat-modules' ),
    'items_list_navigation' => __( 'Jobs list navigation', 'smartcat-modules' ),
    'filter_items_list'     => __( 'Filter jobs', 'smartcat-modules' ),
    
);

$args = array (
    
    'label'                 => __( 'Job', 'smartcat-modules' ),
    'description'           => __( 'Jobs', 'smartcat-modules' ),
    'labels'                => $labels,
    'supports'              => array ( 'title', 'editor', 'author', 'thumbnail', ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-businessman',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    
);

register_post_type( 'job', $args );
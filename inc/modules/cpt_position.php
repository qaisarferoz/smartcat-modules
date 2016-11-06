<?php

$labels = array(
    
    'name'                  => _x( 'Work History', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'         => _x( 'Position', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'             => __( 'Work History', 'smartcat-modules' ),
    'name_admin_bar'        => __( 'Position', 'smartcat-modules' ),
    'archives'              => __( 'Item Archives', 'smartcat-modules' ),
    'parent_item_colon'     => __( 'Parent Positions:', 'smartcat-modules' ),
    'all_items'             => __( 'All Positions', 'smartcat-modules' ),
    'add_new_item'          => __( 'Add New Position', 'smartcat-modules' ),
    'add_new'               => __( 'New Position', 'smartcat-modules' ),
    'new_item'              => __( 'New Position', 'smartcat-modules' ),
    'edit_item'             => __( 'Edit Position', 'smartcat-modules' ),
    'update_item'           => __( 'Update Position', 'smartcat-modules' ),
    'view_item'             => __( 'View Position', 'smartcat-modules' ),
    'search_items'          => __( 'Search work history', 'smartcat-modules' ),
    'not_found'             => __( 'No positions found', 'smartcat-modules' ),
    'not_found_in_trash'    => __( 'No positions found in Trash', 'smartcat-modules' ),
    'featured_image'        => __( 'Featured Image', 'smartcat-modules' ),
    'set_featured_image'    => __( 'Set featured image', 'smartcat-modules' ),
    'remove_featured_image' => __( 'Remove featured image', 'smartcat-modules' ),
    'use_featured_image'    => __( 'Use as featured image', 'smartcat-modules' ),
    'insert_into_item'      => __( 'Insert into item', 'smartcat-modules' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'smartcat-modules' ),
    'items_list'            => __( 'Items list', 'smartcat-modules' ),
    'items_list_navigation' => __( 'Items list navigation', 'smartcat-modules' ),
    'filter_items_list'     => __( 'Filter items list', 'smartcat-modules' ),
    
);

$args = array(
    
    'label'                 => __( 'Position', 'smartcat-modules' ),
    'description'           => __( 'Positions and responsibilities from your career.', 'smartcat-modules' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'rewrite'               => array( 'slug' => 'position' ),
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-list-view',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,		
    'exclude_from_search'   => false,
    'publicly_queryable'    => false,
    'capability_type'       => 'post',
    
);

register_post_type( 'position', $args );

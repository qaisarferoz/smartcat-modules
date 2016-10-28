<?php

$labels = array(
    
    'name'                  => _x( 'Projects', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'             => __( 'Projects', 'smartcat-modules' ),
    'name_admin_bar'        => __( 'Project', 'smartcat-modules' ),
    'archives'              => __( 'Item Archives', 'smartcat-modules' ),
    'parent_item_colon'     => __( 'Parent Projects:', 'smartcat-modules' ),
    'all_items'             => __( 'All Projects', 'smartcat-modules' ),
    'add_new_item'          => __( 'Add New Project', 'smartcat-modules' ),
    'add_new'               => __( 'New Project', 'smartcat-modules' ),
    'new_item'              => __( 'New Project', 'smartcat-modules' ),
    'edit_item'             => __( 'Edit Project', 'smartcat-modules' ),
    'update_item'           => __( 'Update Project', 'smartcat-modules' ),
    'view_item'             => __( 'View Project', 'smartcat-modules' ),
    'search_items'          => __( 'Search projects', 'smartcat-modules' ),
    'not_found'             => __( 'No projects found', 'smartcat-modules' ),
    'not_found_in_trash'    => __( 'No projects found in Trash', 'smartcat-modules' ),
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
    
    'label'                 => __( 'Project', 'smartcat-modules' ),
    'description'           => __( 'Projects you have worked on.', 'smartcat-modules' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'rewrite'               => array( 'slug' => 'project' ),
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-portfolio',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,		
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
    
);

register_post_type( 'project', $args );
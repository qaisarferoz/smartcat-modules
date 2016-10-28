<?php

$labels = array(
    
    'name'                  => _x( 'Clients', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'         => _x( 'Client', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'             => __( 'Clients', 'smartcat-modules' ),
    'name_admin_bar'        => __( 'Client', 'smartcat-modules' ),
    'archives'              => __( 'Item Archives', 'smartcat-modules' ),
    'parent_item_colon'     => __( 'Parent Clients:', 'smartcat-modules' ),
    'all_items'             => __( 'All Clients', 'smartcat-modules' ),
    'add_new_item'          => __( 'Add New Client', 'smartcat-modules' ),
    'add_new'               => __( 'New Client', 'smartcat-modules' ),
    'new_item'              => __( 'New Client', 'smartcat-modules' ),
    'edit_item'             => __( 'Edit Client', 'smartcat-modules' ),
    'update_item'           => __( 'Update Client', 'smartcat-modules' ),
    'view_item'             => __( 'View Client', 'smartcat-modules' ),
    'search_items'          => __( 'Search clients', 'smartcat-modules' ),
    'not_found'             => __( 'No clients found', 'smartcat-modules' ),
    'not_found_in_trash'    => __( 'No clients found in Trash', 'smartcat-modules' ),
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
    
    'label'                 => __( 'Client', 'smartcat-modules' ),
    'description'           => __( 'Clients you have done business with.', 'smartcat-modules' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'rewrite'               => array( 'slug' => 'client' ),
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-businessman',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,		
    'exclude_from_search'   => false,
    'publicly_queryable'    => false,
    'capability_type'       => 'post',
    
);

register_post_type( 'client', $args );
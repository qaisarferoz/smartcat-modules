<?php

$labels = array (

    'name'                  => _x( 'Gallery', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'             => __( 'Gallery', 'smartcat-modules' ),
    'name_admin_bar'        => __( 'Gallery', 'smartcat-modules' ),
    'archives'              => __( '', 'smartcat-modules' ),
    'parent_item_colon'     => __( '', 'smartcat-modules' ),
    'all_items'             => __( 'All Gallery Items', 'smartcat-modules' ),
    'add_new_item'          => __( 'Gallery', 'smartcat-modules' ),
    'add_new'               => __( 'Add Gallery Item', 'smartcat-modules' ),
    'new_item'              => __( 'New Gallery Item', 'smartcat-modules' ),
    'edit_item'             => __( 'Edit Gallery Item', 'smartcat-modules' ),
    'update_item'           => __( 'Update Gallery Item', 'smartcat-modules' ),
    'view_item'             => __( 'View Gallery Item', 'smartcat-modules' ),
    'search_items'          => __( 'Search Gallery Items', 'smartcat-modules' ),
    'not_found'             => __( 'Not found', 'smartcat-modules' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'smartcat-modules' ),
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

$args = array (

    'label'                 => __( 'Gallery', 'smartcat-modules' ),
    'description'           => __( 'The Gallery is a great way to create an image portfolio', 'smartcat-modules' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'thumbnail' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-format-gallery',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => false,
    'capability_type'       => 'page',

);

register_post_type( 'gallery', $args );
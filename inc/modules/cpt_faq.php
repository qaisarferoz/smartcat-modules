<?php

$labels = array (
            
    'name'                  => _x( 'FAQs', 'Post Type General Name', 'smartcat-modules' ),
    'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'smartcat-modules' ),
    'menu_name'             => __( 'FAQs', 'smartcat-modules' ),
    'name_admin_bar'        => __( 'FAQ', 'smartcat-modules' ),
    'archives'              => __( 'FAQ Archives', 'smartcat-modules' ),
    'parent_item_colon'     => __( 'Parent Item:', 'smartcat-modules' ),
    'all_items'             => __( 'All FAQs', 'smartcat-modules' ),
    'add_new_item'          => __( 'Add New FAQ', 'smartcat-modules' ),
    'add_new'               => __( 'Add FAQ', 'smartcat-modules' ),
    'new_item'              => __( 'New FAQ', 'smartcat-modules' ),
    'edit_item'             => __( 'Edit FAQ', 'smartcat-modules' ),
    'update_item'           => __( 'Update FAQ', 'smartcat-modules' ),
    'view_item'             => __( 'View FAQ', 'smartcat-modules' ),
    'search_items'          => __( 'Search FAQs', 'smartcat-modules' ),
    'not_found'             => __( 'Not found', 'smartcat-modules' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'smartcat-modules' ),
    'featured_image'        => __( 'Featured Image', 'smartcat-modules' ),
    'set_featured_image'    => __( 'Set featured image', 'smartcat-modules' ),
    'remove_featured_image' => __( 'Remove featured image', 'smartcat-modules' ),
    'use_featured_image'    => __( 'Use as featured image', 'smartcat-modules' ),
    'insert_into_item'      => __( 'Insert into FAQ', 'smartcat-modules' ),
    'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'smartcat-modules' ),
    'items_list'            => __( 'FAQs list', 'smartcat-modules' ),
    'items_list_navigation' => __( 'Items list navigation', 'smartcat-modules' ),
    'filter_items_list'     => __( 'Filter items list', 'smartcat-modules' ),

);

$args = array (

    'label'                 => __( 'FAQ', 'smartcat-modules' ),
    'description'           => __( 'Frequently Asked Questions for your site', 'smartcat-modules' ),
    'labels'                => $labels,
    'supports'              => array ( 'title', 'editor', 'revisions', ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => false,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-editor-help',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'rewrite'               => false,
    'capability_type'       => 'page',

);

register_post_type( 'faq', $args );
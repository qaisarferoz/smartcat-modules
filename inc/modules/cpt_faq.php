<?php

$labels = array (
            
    'name' => _x( 'FAQs', 'Post Type General Name', 'vivita' ),
    'singular_name' => _x( 'FAQ', 'Post Type Singular Name', 'vivita' ),
    'menu_name' => __( 'FAQs', 'vivita' ),
    'name_admin_bar' => __( 'FAQ', 'vivita' ),
    'archives' => __( 'FAQ Archives', 'vivita' ),
    'parent_item_colon' => __( 'Parent Item:', 'vivita' ),
    'all_items' => __( 'All FAQs', 'vivita' ),
    'add_new_item' => __( 'Add New FAQ', 'vivita' ),
    'add_new' => __( 'Add FAQ', 'vivita' ),
    'new_item' => __( 'New FAQ', 'vivita' ),
    'edit_item' => __( 'Edit FAQ', 'vivita' ),
    'update_item' => __( 'Update FAQ', 'vivita' ),
    'view_item' => __( 'View FAQ', 'vivita' ),
    'search_items' => __( 'Search FAQs', 'vivita' ),
    'not_found' => __( 'Not found', 'vivita' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'vivita' ),
    'featured_image' => __( 'Featured Image', 'vivita' ),
    'set_featured_image' => __( 'Set featured image', 'vivita' ),
    'remove_featured_image' => __( 'Remove featured image', 'vivita' ),
    'use_featured_image' => __( 'Use as featured image', 'vivita' ),
    'insert_into_item' => __( 'Insert into FAQ', 'vivita' ),
    'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'vivita' ),
    'items_list' => __( 'FAQs list', 'vivita' ),
    'items_list_navigation' => __( 'Items list navigation', 'vivita' ),
    'filter_items_list' => __( 'Filter items list', 'vivita' ),

);

$args = array (

    'label' => __( 'FAQ', 'vivita' ),
    'description' => __( 'Frequently asked questions for your site', 'vivita' ),
    'labels' => $labels,
    'supports' => array ( 'title', 'editor', 'revisions', ),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-editor-help',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'rewrite' => false,
    'capability_type' => 'page',

);

register_post_type( 'faq', $args );
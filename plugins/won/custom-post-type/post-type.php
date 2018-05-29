<?php


// Portoflio //////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'ova_won_portoflio_init',0 );
function ova_won_portoflio_init() {
    
    $labels = array(
        'name'               => esc_html__( 'Portfolio', 'post type general name', 'ova-won' ),
        'singular_name'      => esc_html__( 'Portfolio', 'post type singular name', 'ova-won' ),
        'menu_name'          => esc_html__( 'Portfolios', 'admin menu', 'ova-won' ),
        'name_admin_bar'     => esc_html__( 'Portfolio', 'add new on admin bar', 'ova-won' ),
        'add_new'            => esc_html__( 'Add New Portfolio', 'Slide', 'ova-won' ),
        'add_new_item'       => esc_html__( 'Add New Portfolio', 'ova-won' ),
        'new_item'           => esc_html__( 'New Portfolio', 'ova-won' ),
        'edit_item'          => esc_html__( 'Edit Portfolio', 'ova-won' ),
        'view_item'          => esc_html__( 'View Portfolio', 'ova-won' ),
        'all_items'          => esc_html__( 'All Portfolios', 'ova-won' ),
        'search_items'       => esc_html__( 'Search Portfolios', 'ova-won' ),
        'parent_item_colon'  => esc_html__( 'Parent Portfolios:', 'ova-won' ),
        'not_found'          => esc_html__( 'No Portfolios found.', 'ova-won' ),
        'not_found_in_trash' => esc_html__( 'No Portfolios found in Trash.', 'ova-won' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-format-gallery',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'          => array('categories'),
    );

    register_post_type( 'portfolio', $args ); // Create post type: slideshow
}


add_action( 'init', 'ova_won_categories_taxonomies', 0 );
function ova_won_categories_taxonomies() {
    
    $labels = array(
        'name'              => esc_html__( 'Category', 'taxonomy general name' , 'ova-won'),
        'singular_name'     => esc_html__( 'Category', 'taxonomy singular name' , 'ova-won'),
        'search_items'      => esc_html__( 'Search Category', 'ova-won'),
        'all_items'         => esc_html__( 'All Category', 'ova-won' ),
        'parent_item'       => esc_html__( 'Parent Category', 'ova-won' ),
        'parent_item_colon' => esc_html__( 'Parent Category:' , 'ova-won'),
        'edit_item'         => esc_html__( 'Edit Category' , 'ova-won'),
        'update_item'       => esc_html__( 'Update Category' , 'ova-won'),
        'add_new_item'      => esc_html__( 'Add New Category' , 'ova-won'),
        'new_item_name'     => esc_html__( 'New Category Name' , 'ova-won'),
        'menu_name'         => esc_html__( 'Category' , 'ova-won'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categories' )
    );

    register_taxonomy( 'categories', array('portfolio'), $args ); // Create taxonomy: slidegroup
}




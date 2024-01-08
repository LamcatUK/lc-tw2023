<?php

function cb_register_post_types() {

	/**
	 * Post Type: Case Studies.
	 */

     $labels = [
		"name" => esc_html__( "Case Studies", "lc-tideywebb" ),
		"singular_name" => esc_html__( "Case Study", "lc-tideywebb" ),
	];

	$args = [
		"label" => esc_html__( "Case Studies", "lc-tideywebb" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "case-studies", "with_front" => false ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "case-studies", $args );

	/**
	 * Post Type: People.
	 */

     $labels = [
		"name" => esc_html__( "People", "lc-tideywebb" ),
		"singular_name" => esc_html__( "Person", "lc-tideywebb" ),
	];

	$args = [
		"label" => esc_html__( "People", "lc-tideywebb" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "people", "with_front" => false ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "people", $args );

    /**
     * Post Type: Testimonials.
     */

    $labels = [
        "name" => esc_html__( "Testimonials", "lc-tideywebb" ),
        "singular_name" => esc_html__( "Testimonial", "lc-tideywebb" ),
    ];

    $args = [
        "label" => esc_html__( "Testimonials", "lc-tideywebb" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => [ "slug" => "testimonials", "with_front" => false ],
        "query_var" => true,
        "supports" => [ "title", "editor" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "testimonials", $args );
 

}

add_action( 'init', 'cb_register_post_types' );

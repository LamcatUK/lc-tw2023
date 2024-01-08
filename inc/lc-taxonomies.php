<?php

function cb_register_taxes() {

    $args = [
        "label" => "CS Category",
        "labels" => [
            "name" => "CS Categories",
            "singular_name" => "CS Category",
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "cstype", [ "case-studies" ], $args );

    $args = [
        "label" => "CS Region",
        "labels" => [
            "name" => "CS Regions",
            "singular_name" => "CS Region",
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "csregion", [ "case-studies" ], $args );

    $args = [
        "label" => "Team",
        "labels" => [
            "name" => "Teams",
            "singular_name" => "Team",
        ],
        "public" => true,
        "publicly_queryable" => false,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "team", [ "people" ], $args );

}
add_action( 'init', 'cb_register_taxes' );


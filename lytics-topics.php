<?php
/*
* Plugin Name: Lytics Topics
* Plugin URI:  https://github.com/andrewarasaki/lytics-topics
* Author:      Andrew Arasaki
* Author URI:  https://www.lytics.com/
* Description: This plugin is for Wordpress sites that want to incorporate Lytics Topics
* Version:     0.1.0
*/


// CREATE LYTICS TOPICS TAXONOMY
add_action( 'init', 'lytics_topics', 0 );
register_taxonomy( 'lytics_topics', array('resources', 'post'),
	array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'               => 'Lytics Topics',
			'singular_name'      => 'Lytics Topics',
			'search_items'       => 'Search Lytics Topics',
			'popular_items'      => 'Popular Lytics Topics',
			'all_items'          => 'All Lytics Topics',
			'parent_item'        => 'Parent Lytics Topics',
			'parent_item_colon'  => 'Parent Lytics Topics',
			'edit_item'          => 'Edit Lytics Topics',
			'update_item'        => 'Update Lytics Topics',
			'add_new_item'       => 'Add New Lytics Topics',
			'edit_item_name'     => 'Edit Lytics Topics',
			'menu_name'          => 'Edit Lytics Topics'
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'query_var'         => true,
        'rewrite' => false,
	)
);


// ADD LYTICS TOPICS TO META TAG
function add_lytics_topics_meta_tag() {
    global $post;
  
    if ( $post->post_type === 'post' || $post->post_type === 'resources' ) {
        $lyticsTopics = get_the_terms( $post->ID, 'lytics_topics' );
        $metaLyticsTopics = '';
        foreach ( $lyticsTopics as $lyticsTopic ) {
            $metaLyticsTopics .= $lyticsTopic->name . ", ";
        }
        echo '<meta name="lytics:topics" content="' . esc_html($metaLyticsTopics) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'add_lytics_topics_meta_tag' , 2 );
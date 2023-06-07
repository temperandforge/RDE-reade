
<?php

/**
 * Registers the `slug` taxonomy,
 * for use with 'caller'.
 */

// function press_source_init() {
function generateTaxonomy($slug, $post_type_slugs, $singular_name, $plural_name) {
	register_taxonomy( $slug, $post_type_slugs, [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( "$plural_name", TEXTDOMAIN ),
			'singular_name'              => _x( $singular_name, 'taxonomy general name', TEXTDOMAIN ),
			'search_items'               => __( "Search ".$plural_name, TEXTDOMAIN ),
			'popular_items'              => __( "Popular ".$plural_name, TEXTDOMAIN ),
			'all_items'                  => __( "All ".$plural_name, TEXTDOMAIN ),
			'parent_item'                => __( "Parent ".$singular_name, TEXTDOMAIN ),
			'parent_item_colon'          => __( "Parent ".$singular_name.":", TEXTDOMAIN ),
			'edit_item'                  => __( "Edit ".$singular_name, TEXTDOMAIN ),
			'update_item'                => __( "Update ".$singular_name, TEXTDOMAIN ),
			'view_item'                  => __( "View ".$singular_name, TEXTDOMAIN ),
			'add_new_item'               => __( "Add New ".$singular_name, TEXTDOMAIN ),
			'new_item_name'              => __( "New $singular_name", TEXTDOMAIN ),
			'separate_items_with_commas' => __( "Separate ".strtolower($plural_name)." with commas", TEXTDOMAIN ),
			'add_or_remove_items'        => __( "Add or remove ".strtolower($plural_name), TEXTDOMAIN ),
			'choose_from_most_used'      => __( "Choose from the most used ".strtolower($plural_name), TEXTDOMAIN ),
			'not_found'                  => __( "No ".strtolower($plural_name)." found.", TEXTDOMAIN ),
			'no_terms'                   => __( "No ".strtolower($plural_name), TEXTDOMAIN ),
			'menu_name'                  => __( $plural_name, TEXTDOMAIN ),
			'items_list_navigation'      => __( $plural_name." list navigation", TEXTDOMAIN ),
			'items_list'                 => __( $plural_name." list", TEXTDOMAIN ),
			'most_used'                  => _x( "Most Used", $slug, TEXTDOMAIN ),
			'back_to_items'              => __( "&larr; Back to ".$plural_name, TEXTDOMAIN ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'press_source',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}
// add_action( 'init', 'press_source_init' );

//TODO
/**
 * Sets the post updated messages for the `slug` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `slug` taxonomy.
 */
function cpt_updated_messages( &$messages, $slug, $singular_name, $plural_name) {
	$messages[$slug] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( $singular_name.' added.', TEXTDOMAIN ),
		2 => __( $singular_name.' deleted.', TEXTDOMAIN ),
		3 => __( $singular_name.' updated.', TEXTDOMAIN ),
		4 => __( $singular_name.' not added.', TEXTDOMAIN ),
		5 => __( $singular_name.' not updated.', TEXTDOMAIN ),
		6 => __( $plural_name.' deleted.', TEXTDOMAIN ),
	];
}
//TODO example
function press_source_updated_messages( $messages ) {

	$slug          = " press_source"; 
	$singular_name = "Press Source";
	$plural_name   = "Press Sources";
	
	cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
	return $messages;
}

add_filter( 'term_updated_messages', 'press_source_updated_messages' );

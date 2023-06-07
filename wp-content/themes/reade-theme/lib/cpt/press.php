<?php

/**
 * Registers the `press` post type.
 */
function press_init() { //TODO former or ladder overriding
	register_post_type(
		'press',
		[
			'labels'                => [
				'name'                  => __( 'Press', TEXTDOMAIN ),
				'singular_name'         => __( 'Press Article', TEXTDOMAIN ),
				'all_items'             => __( 'All Press Articles', TEXTDOMAIN ),
				'archives'              => __( 'Press Archives', TEXTDOMAIN ),
				'attributes'            => __( 'Press Article Attributes', TEXTDOMAIN ),
				'insert_into_item'      => __( 'Insert into Press Article', TEXTDOMAIN ),
				'uploaded_to_this_item' => __( 'Uploaded to this Press Article', TEXTDOMAIN ),
				'featured_image'        => _x( 'Featured Image', 'press', TEXTDOMAIN ),
				'set_featured_image'    => _x( 'Set featured image', 'press', TEXTDOMAIN ),
				'remove_featured_image' => _x( 'Remove featured image', 'press', TEXTDOMAIN ),
				'use_featured_image'    => _x( 'Use as featured image', 'press', TEXTDOMAIN ),
				'filter_items_list'     => __( 'Filter Press Articles list', TEXTDOMAIN ),
				'items_list_navigation' => __( 'Press Articles list navigation', TEXTDOMAIN ),
				'items_list'            => __( 'Press Articles list', TEXTDOMAIN ),
				'new_item'              => __( 'New Press Article', TEXTDOMAIN ),
				'add_new'               => __( 'Add New', TEXTDOMAIN ),
				'add_new_item'          => __( 'Add New Press Article', TEXTDOMAIN ),
				'edit_item'             => __( 'Edit Press Article', TEXTDOMAIN ),
				'view_item'             => __( 'View Press Article', TEXTDOMAIN ),
				'view_items'            => __( 'View Press Articles', TEXTDOMAIN ),
				'search_items'          => __( 'Search Press Articles', TEXTDOMAIN ),
				'not_found'             => __( 'No Press Articles found', TEXTDOMAIN ),
				'not_found_in_trash'    => __( 'No Press Articles found in trash', TEXTDOMAIN ),
				'parent_item_colon'     => __( 'Parent Press Article:', TEXTDOMAIN ),
				'menu_name'             => __( 'Press Articles', TEXTDOMAIN ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-media-document',
			'show_in_rest'          => true,
			'rest_base'             => 'press',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

	generateTaxonomy(
		'press_source',  //$slug
		[ 'press' ],     //$post_type_slugs
		'Press Source',  //$singular_name
		'Press Sources', //$plural_name
	);
	
	generateTaxonomy(
		'press_category',  //$slug
		[ 'press' ],       //$post_type_slugs
		'Press Category',  //$singular_name
		'Press Categories',//$plural_name
	);
}

add_action( 'init', 'press_init' );

/**
 * Sets the post updated messages for the `press` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `press` post type.
 */
function press_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['press'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Press updated. <a target="_blank" href="%s">View Press</a>', TEXTDOMAIN ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', TEXTDOMAIN ),
		3  => __( 'Custom field deleted.', TEXTDOMAIN ),
		4  => __( 'Press updated.', TEXTDOMAIN ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Press restored to revision from %s', TEXTDOMAIN ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Press published. <a href="%s">View Press</a>', TEXTDOMAIN ), esc_url( $permalink ) ),
		7  => __( 'Press saved.', TEXTDOMAIN ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Press submitted. <a target="_blank" href="%s">Preview Press</a>', TEXTDOMAIN ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Press scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Press</a>', TEXTDOMAIN ), date_i18n( __( 'M j, Y @ G:i', TEXTDOMAIN ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Press draft updated. <a target="_blank" href="%s">Preview Press</a>', TEXTDOMAIN ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'press_updated_messages' );

/**
 * Sets the bulk post updated messages for the `press` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `press` post type.
 */
function press_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['press'] = [
		/* translators: %s: Number of Pxresses. */
		'updated'   => _n( '%s Press updated.', '%s Pxresses updated.', $bulk_counts['updated'], TEXTDOMAIN ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Press not updated, somebody is editing it.', TEXTDOMAIN ) :
						/* translators: %s: Number of Pxresses. */
						_n( '%s Press not updated, somebody is editing it.', '%s Pxresses not updated, somebody is editing them.', $bulk_counts['locked'], TEXTDOMAIN ),
		/* translators: %s: Number of Pxresses. */
		'deleted'   => _n( '%s Press permanently deleted.', '%s Pxresses permanently deleted.', $bulk_counts['deleted'], TEXTDOMAIN ),
		/* translators: %s: Number of Pxresses. */
		'trashed'   => _n( '%s Press moved to the Trash.', '%s Pxresses moved to the Trash.', $bulk_counts['trashed'], TEXTDOMAIN ),
		/* translators: %s: Number of Pxresses. */
		'untrashed' => _n( '%s Press restored from the Trash.', '%s Pxresses restored from the Trash.', $bulk_counts['untrashed'], TEXTDOMAIN ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'press_bulk_updated_messages', 10, 2 );



add_filter( 'term_updated_messages', 'press_source_updated_messages' );
function press_source_updated_messages( $messages ) {

	$slug          = "press_source"; 
	$singular_name = "Press Source";
	$plural_name   = "Press Sources";
	
	// cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
	$messages[$slug] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( $singular_name.' added.', TEXTDOMAIN ),
		2 => __( $singular_name.' deleted.', TEXTDOMAIN ),
		3 => __( $singular_name.' updated.', TEXTDOMAIN ),
		4 => __( $singular_name.' not added.', TEXTDOMAIN ),
		5 => __( $singular_name.' not updated.', TEXTDOMAIN ),
		6 => __( $plural_name.' deleted.', TEXTDOMAIN ),
	];
	return $messages;
}

add_filter( 'term_updated_messages', 'press_category_updated_messages' );
function press_category_updated_messages( $messages ) {

	$slug          = "press_category"; 
	$singular_name = "Press Category";
	$plural_name   = "Press Categories";
	
	// cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
	$messages[$slug] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( $singular_name.' added.', TEXTDOMAIN ),
		2 => __( $singular_name.' deleted.', TEXTDOMAIN ),
		3 => __( $singular_name.' updated.', TEXTDOMAIN ),
		4 => __( $singular_name.' not added.', TEXTDOMAIN ),
		5 => __( $singular_name.' not updated.', TEXTDOMAIN ),
		6 => __( $plural_name.' deleted.', TEXTDOMAIN ),
	];
	return $messages;
}

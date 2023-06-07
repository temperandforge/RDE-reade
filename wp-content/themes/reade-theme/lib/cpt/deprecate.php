<?php

/**
 * Registers the `resource` post type.
 */
function resource_init() {
	register_post_type(
		'resource',
		[
			'labels'                => [
				'name'                  => __( 'Resources', TEXTDOMAIN ),
				'singular_name'         => __( 'Resource', TEXTDOMAIN ),
				'all_items'             => __( 'All Resources', TEXTDOMAIN ),
				'archives'              => __( 'Resource Archives', TEXTDOMAIN ),
				'attributes'            => __( 'Resource Attributes', TEXTDOMAIN ),
				'insert_into_item'      => __( 'Insert into Resource', TEXTDOMAIN ),
				'uploaded_to_this_item' => __( 'Uploaded to this Resource', TEXTDOMAIN ),
				'featured_image'        => _x( 'Featured Image', 'resource', TEXTDOMAIN ),
				'set_featured_image'    => _x( 'Set featured image', 'resource', TEXTDOMAIN ),
				'remove_featured_image' => _x( 'Remove featured image', 'resource', TEXTDOMAIN ),
				'use_featured_image'    => _x( 'Use as featured image', 'resource', TEXTDOMAIN ),
				'filter_items_list'     => __( 'Filter Resources list', TEXTDOMAIN ),
				'items_list_navigation' => __( 'Resources list navigation', TEXTDOMAIN ),
				'items_list'            => __( 'Resources list', TEXTDOMAIN ),
				'new_item'              => __( 'New Resource', TEXTDOMAIN ),
				'add_new'               => __( 'Add New', TEXTDOMAIN ),
				'add_new_item'          => __( 'Add New Resource', TEXTDOMAIN ),
				'edit_item'             => __( 'Edit Resource', TEXTDOMAIN ),
				'view_item'             => __( 'View Resource', TEXTDOMAIN ),
				'view_items'            => __( 'View Resources', TEXTDOMAIN ),
				'search_items'          => __( 'Search Resources', TEXTDOMAIN ),
				'not_found'             => __( 'No Resources found', TEXTDOMAIN ),
				'not_found_in_trash'    => __( 'No Resources found in trash', TEXTDOMAIN ),
				'parent_item_colon'     => __( 'Parent Resource:', TEXTDOMAIN ),
				'menu_name'             => __( 'Resources', TEXTDOMAIN ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'has_archive'           => true,
			// 'hierarchical'          => false,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'resource',
			'rest_controller_class' => 'WP_REST_Posts_Controller',

			// 'label'                 => __('Drink'),
			// 'description'           => __('Drinks'),
			// 'labels'                => $labels,
			// 'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			// 'hierarchical'          => false,
			// 'public'                => true,
			// 'show_ui'               => true,
			// 'show_in_menu'          => true,
			// 'show_in_rest'			    => true,    
			'rewrite' => array(
			  'slug'       => 'resources',
			  'with_front' => true
			),
			// 'menu_position'         => 3,
			// 'menu_icon'             => 'dashicons-screenoptions',
			// 'show_in_admin_bar'     => true,
			// 'show_in_nav_menus'     => true,
			// 'show_admin_column'     => true,
			// 'show_admin_column'     => true,
			// 'can_export'            => true,
			// 'has_archive'           => false,
			// 'exclude_from_search'   => false,
			// 'publicly_queryable'    => true,
			// 'capability_type'       => 'page',
		]
	);

	//Taxonomy
	$tax_labels = array(
		'name'                  => __( 'Resource Type', TEXTDOMAIN ),
		'singular_name'         => __( 'Resource Type', TEXTDOMAIN ),
		'menu_name'             => __( 'Resources Types', TEXTDOMAIN ),
		'name_admin_bar'        => __( 'Resources Types', TEXTDOMAIN ),
		'archives'              => __( 'Resource Type Archives', TEXTDOMAIN ),
		'parent_item_colon'     => __( 'Parent Resource Type:', TEXTDOMAIN ),
		'all_items'             => __( 'All Resources Types', TEXTDOMAIN ),
		'add_new_item'          => __( 'Add New Resource Type', TEXTDOMAIN ),
		'add_new'               => __( 'Add New Resource Type', TEXTDOMAIN ),
		'new_item'              => __( 'New Resource Type', TEXTDOMAIN ),
		'edit_item'             => __( 'Edit Resource Type', TEXTDOMAIN ),
		'update_item'           => __( 'Update Resource Type', TEXTDOMAIN ),
		'view_item'             => __( 'View Resource Type', TEXTDOMAIN ),
		'search_items'          => __( 'Search Resource Type', TEXTDOMAIN ),
		'not_found'             => __( 'Not found', TEXTDOMAIN ),
		'not_found_in_trash'    => __( 'Not found in Trash', TEXTDOMAIN ),
		'featured_image'        => __( 'Featured Image', TEXTDOMAIN ),
		'set_featured_image'    => __( 'Set featured image', TEXTDOMAIN ),
		'remove_featured_image' => __( 'Remove featured image', TEXTDOMAIN ),
		'use_featured_image'    => __( 'Use as featured image', TEXTDOMAIN ),
		'insert_into_item'      => __( 'Insert into Resource Type', TEXTDOMAIN ),
		'uploaded_to_this_item' => __( 'Uploaded to this Resource Type', TEXTDOMAIN ),
		'items_list'            => __( 'Resources Types list', TEXTDOMAIN ),
		'items_list_navigation' => __( 'Resources Types list navigation', TEXTDOMAIN ),
		'filter_items_list'     => __( 'Filter Resources Types list', TEXTDOMAIN ),
	);
	$tax_args = array(
		'label'                 => __( 'Resources Types', TEXTDOMAIN ),
		'description'           => __( 'Resources Types', TEXTDOMAIN ),
		'labels'                => $tax_labels,
		'show_in_rest'          => true,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-tickets-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'show_admin_column'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		// 'rewrite'
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_taxonomy( 'resource_type', 'resource', $tax_args );
	

}

add_action( 'init', 'resource_init' );

/**
 * Sets the post updated messages for the `resource` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `resource` post type.
 */
function resource_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['resource'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Resource updated. <a target="_blank" href="%s">View Resource</a>', TEXTDOMAIN ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', TEXTDOMAIN ),
		3  => __( 'Custom field deleted.', TEXTDOMAIN ),
		4  => __( 'Resource updated.', TEXTDOMAIN ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Resource restored to revision from %s', TEXTDOMAIN ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Resource published. <a href="%s">View Resource</a>', TEXTDOMAIN ), esc_url( $permalink ) ),
		7  => __( 'Resource saved.', TEXTDOMAIN ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Resource submitted. <a target="_blank" href="%s">Preview Resource</a>', TEXTDOMAIN ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Resource scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Resource</a>', TEXTDOMAIN ), date_i18n( __( 'M j, Y @ G:i', TEXTDOMAIN ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Resource draft updated. <a target="_blank" href="%s">Preview Resource</a>', TEXTDOMAIN ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'resource_updated_messages' );

/**
 * Sets the bulk post updated messages for the `resource` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `resource` post type.
 */
function resource_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['resource'] = [
		/* translators: %s: Number of Resources. */
		'updated'   => _n( '%s Resource updated.', '%s Resources updated.', $bulk_counts['updated'], TEXTDOMAIN ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Resource not updated, somebody is editing it.', TEXTDOMAIN ) :
						/* translators: %s: Number of Resources. */
						_n( '%s Resource not updated, somebody is editing it.', '%s Resources not updated, somebody is editing them.', $bulk_counts['locked'], TEXTDOMAIN ),
		/* translators: %s: Number of Resources. */
		'deleted'   => _n( '%s Resource permanently deleted.', '%s Resources permanently deleted.', $bulk_counts['deleted'], TEXTDOMAIN ),
		/* translators: %s: Number of Resources. */
		'trashed'   => _n( '%s Resource moved to the Trash.', '%s Resources moved to the Trash.', $bulk_counts['trashed'], TEXTDOMAIN ),
		/* translators: %s: Number of Resources. */
		'untrashed' => _n( '%s Resource restored from the Trash.', '%s Resources restored from the Trash.', $bulk_counts['untrashed'], TEXTDOMAIN ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'resource_bulk_updated_messages', 10, 2 );

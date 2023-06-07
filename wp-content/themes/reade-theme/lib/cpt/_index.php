<?php //STARTER

/**
 * Sets the post updated messages for the `slug` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `slug` taxonomy.
 */
function cpt_updated_messages( 
	$messages, 
	$slug, 
	$singular_name, 
	$plural_name
) {
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

function generateTaxonomy(
   $tax_slug, 
   $tax_post_type_slugs, 
   $tax_singular_name, 
   $tax_plural_name
) {
	register_taxonomy( $tax_slug, $tax_post_type_slugs, [
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
			'name'                       => __( "$tax_plural_name", TEXTDOMAIN ),
			'singular_name'              => _x( "$tax_singular_name", 'taxonomy general name', TEXTDOMAIN ),
			'search_items'               => __( "Search ".$tax_plural_name, TEXTDOMAIN ),
			'popular_items'              => __( "Popular ".$tax_plural_name, TEXTDOMAIN ),
			'all_items'                  => __( "All ".$tax_plural_name, TEXTDOMAIN ),
			'parent_item'                => __( "Parent ".$tax_singular_name, TEXTDOMAIN ),
			'parent_item_colon'          => __( "Parent ".$tax_singular_name.":", TEXTDOMAIN ),
			'edit_item'                  => __( "Edit ".$tax_singular_name, TEXTDOMAIN ),
			'update_item'                => __( "Update ".$tax_singular_name, TEXTDOMAIN ),
			'view_item'                  => __( "View ".$tax_singular_name, TEXTDOMAIN ),
			'add_new_item'               => __( "Add New ".$tax_singular_name, TEXTDOMAIN ),
			'new_item_name'              => __( "New $tax_singular_name", TEXTDOMAIN ),
			'separate_items_with_commas' => __( "Separate ".strtolower($tax_plural_name)." with commas", TEXTDOMAIN ),
			'add_or_remove_items'        => __( "Add or remove ".strtolower($tax_plural_name), TEXTDOMAIN ),
			'choose_from_most_used'      => __( "Choose from the most used ".strtolower($tax_plural_name), TEXTDOMAIN ),
			'not_found'                  => __( "No ".strtolower($tax_plural_name)." found.", TEXTDOMAIN ),
			'no_terms'                   => __( "No ".strtolower($tax_plural_name), TEXTDOMAIN ),
			'menu_name'                  => __( $tax_plural_name, TEXTDOMAIN ),
			'items_list_navigation'      => __( $tax_plural_name." list navigation", TEXTDOMAIN ),
			'items_list'                 => __( $tax_plural_name." list", TEXTDOMAIN ),
			'most_used'                  => _x( "Most Used", $tax_slug, TEXTDOMAIN ),
			'back_to_items'              => __( "&larr; Back to ".$tax_plural_name, TEXTDOMAIN ),
		],
		'show_in_rest'          => true,
		'rest_base'             => $tax_slug, //STARTER
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );
	
	//cpt_updated_messages( $messages, $tax_slug, $tax_singular_name, $tax_plural_name);
}

function cpt_init(
   $slug,
   $name,
   $singular_name,
   $plural_name,
   $rest_base,
   $menu_icon,
   $supports = [ 'title', 'editor', 'thumbnail', 'excerpt' ],
   $taxonomies = []
) {
   register_post_type(
      $slug,
      [
			'labels'                => [
				'name'                  => __( "$name", TEXTDOMAIN ),
				'singular_name'         => __( "$singular_name", TEXTDOMAIN ),
				'all_items'             => __( "All $plural_name", TEXTDOMAIN ),
				'archives'              => __( "$name Archives", TEXTDOMAIN ),
				'attributes'            => __( "$name Article Attributes", TEXTDOMAIN ),
				'insert_into_item'      => __( "Insert into $singular_name", TEXTDOMAIN ),
				'uploaded_to_this_item' => __( "Uploaded to this $singular_name", TEXTDOMAIN ),
				'featured_image'        => _x( "Featured Image", $slug, TEXTDOMAIN ),
				'set_featured_image'    => _x( "Set featured image", $slug, TEXTDOMAIN ),
				'remove_featured_image' => _x( "Remove featured image", $slug, TEXTDOMAIN ),
				'use_featured_image'    => _x( "Use as featured image", $slug, TEXTDOMAIN ),
				'filter_items_list'     => __( "Filter $plural_name list", TEXTDOMAIN ),
				'items_list_navigation' => __( "$plural_name list navigation", TEXTDOMAIN ),
				'items_list'            => __( "$plural_name list", TEXTDOMAIN ),
				'new_item'              => __( "New $singular_name", TEXTDOMAIN ),
				'add_new'               => __( "Add New", TEXTDOMAIN ),
				'add_new_item'          => __( "Add New $singular_name", TEXTDOMAIN ),
				'edit_item'             => __( "Edit $singular_name", TEXTDOMAIN ),
				'view_item'             => __( "View $singular_name", TEXTDOMAIN ),
				'view_items'            => __( "View $plural_name", TEXTDOMAIN ),
				'search_items'          => __( "Search $plural_name", TEXTDOMAIN ),
				'not_found'             => __( "No $plural_name found", TEXTDOMAIN ),
				'not_found_in_trash'    => __( "No $plural_name found in trash", TEXTDOMAIN ),
				'parent_item_colon'     => __( "Parent $singular_name:", TEXTDOMAIN ),
				'menu_name'             => __( "$plural_name", TEXTDOMAIN ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => $supports,
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => $menu_icon,
			'show_in_rest'          => true,
			'rest_base'             => $rest_base,
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
   );

   foreach($taxonomies as $idx => $tax ) {
      generateTaxonomy(...$tax);
      //    'press_source',  //$slug
      //    [ 'press' ],     //$post_type_slugs
      //    'Press Source',  //$singular_name
      //    'Press Sources', //$plural_name
      // );
   }
}

function setup_custom_post_types() {
   /**
    * Make sure to add the messages for any taxonomies declared
    *
    * $menu_icons - @see https://developer.wordpress.org/resource/dashicons/#admin-site
    */
   
   // /** 
   //  * PLACEHOLDER
   //  */
   // cpt_init(
   //    $slug,
   //    $name,
   //    $singular_name,
   //    $plural_name,
   //    $rest_base,
   //    $menu_icon,
   //    $support = [ 'title', 'editor', 'thumbnail', 'excerpt' ],
   //    $taxonomies = [
   //       [$tax_slug, [ $post_type_slugs ], $tax_singular_name, $tax_plural_name],
   //       [$tax_slug, [ $post_type_slugs ], $tax_singular_name, $tax_plural_name],
   //    ]
   // );


   /** 
    * Services
    */
   cpt_init(
      'services', //$slug,
      'Services', //$name,
      'Service',  //$singular_name,
      'Services', //$plural_name,
      'services', //$rest_base,
      'dashicons-list-view', //$menu_icon,
      $supports = [ 'title', 'editor', 'thumbnail', 'excerpt' ], //$supports
      $taxonomies = [
         [
            'service_categories',           // $tax_slug
            [ 'services' ],      // $post_type_slugs,
            'Service Category',  // $tax_singular_name, 
            'Service Categories' // $tax_plural_name
         ],
      ]
   );

   /** 
    * Tools 
    */
   cpt_init(
      'tools',
      'Tools',
      'Tool',
      'Tools',
      'tools',
      'dashicons-admin-tools',
      $supports = [ 'title', 'editor', 'thumbnail', 'excerpt' ],
      $taxonomies = [
         [
            'tool_categories', 
            [ 'tools' ], 
            "Tool Category",
            "Tool Categories"
         ]
      ]
   );

   //TODO
   /*** Copy and Update for each Taxonomy */
   function press_source_updated_messages( $messages ) {

      $slug          = "tools_category"; 
      $singular_name = "Tool Category";
      $plural_name   = "Tool Categories";
      
      cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
      return $messages;
   }
   
   add_filter( 'term_updated_messages', 'press_source_updated_messages' );
}
add_action( 'init', 'setup_custom_post_types' );
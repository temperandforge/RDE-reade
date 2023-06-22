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
		1 => __( $singular_name.' added.', 'reade-theme' ),
		2 => __( $singular_name.' deleted.', 'reade-theme' ),
		3 => __( $singular_name.' updated.', 'reade-theme' ),
		4 => __( $singular_name.' not added.', 'reade-theme' ),
		5 => __( $singular_name.' not updated.', 'reade-theme' ),
		6 => __( $plural_name.' deleted.', 'reade-theme' ),
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
			'name'                       => __( "$tax_plural_name", 'reade-theme' ),
			'singular_name'              => _x( "$tax_singular_name", 'taxonomy general name', 'reade-theme' ),
			'search_items'               => __( "Search ".$tax_plural_name, 'reade-theme' ),
			'popular_items'              => __( "Popular ".$tax_plural_name, 'reade-theme' ),
			'all_items'                  => __( "All ".$tax_plural_name, 'reade-theme' ),
			'parent_item'                => __( "Parent ".$tax_singular_name, 'reade-theme' ),
			'parent_item_colon'          => __( "Parent ".$tax_singular_name.":", 'reade-theme' ),
			'edit_item'                  => __( "Edit ".$tax_singular_name, 'reade-theme' ),
			'update_item'                => __( "Update ".$tax_singular_name, 'reade-theme' ),
			'view_item'                  => __( "View ".$tax_singular_name, 'reade-theme' ),
			'add_new_item'               => __( "Add New ".$tax_singular_name, 'reade-theme' ),
			'new_item_name'              => __( "New $tax_singular_name", 'reade-theme' ),
			'separate_items_with_commas' => __( "Separate ".strtolower($tax_plural_name)." with commas", 'reade-theme' ),
			'add_or_remove_items'        => __( "Add or remove ".strtolower($tax_plural_name), 'reade-theme' ),
			'choose_from_most_used'      => __( "Choose from the most used ".strtolower($tax_plural_name), 'reade-theme' ),
			'not_found'                  => __( "No ".strtolower($tax_plural_name)." found.", 'reade-theme' ),
			'no_terms'                   => __( "No ".strtolower($tax_plural_name), 'reade-theme' ),
			'menu_name'                  => __( $tax_plural_name, 'reade-theme' ),
			'items_list_navigation'      => __( $tax_plural_name." list navigation", 'reade-theme' ),
			'items_list'                 => __( $tax_plural_name." list", 'reade-theme' ),
			'most_used'                  => _x( "Most Used", $tax_slug, 'reade-theme' ),
			'back_to_items'              => __( "&larr; Back to ".$tax_plural_name, 'reade-theme' ),
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
   $taxonomies = [],
	$has_archive = true,
	$publicly_queryable = true,
) {
   register_post_type(
      $slug,
      [
			'labels'                => [
				'name'                  => __( "$name", 'reade-theme' ),
				'singular_name'         => __( "$singular_name", 'reade-theme' ),
				'all_items'             => __( "All $plural_name", 'reade-theme' ),
				'archives'              => __( "$name Archives", 'reade-theme' ),
				'attributes'            => __( "$name Article Attributes", 'reade-theme' ),
				'insert_into_item'      => __( "Insert into $singular_name", 'reade-theme' ),
				'uploaded_to_this_item' => __( "Uploaded to this $singular_name", 'reade-theme' ),
				'featured_image'        => _x( "Featured Image", $slug, 'reade-theme' ),
				'set_featured_image'    => _x( "Set featured image", $slug, 'reade-theme' ),
				'remove_featured_image' => _x( "Remove featured image", $slug, 'reade-theme' ),
				'use_featured_image'    => _x( "Use as featured image", $slug, 'reade-theme' ),
				'filter_items_list'     => __( "Filter $plural_name list", 'reade-theme' ),
				'items_list_navigation' => __( "$plural_name list navigation", 'reade-theme' ),
				'items_list'            => __( "$plural_name list", 'reade-theme' ),
				'new_item'              => __( "New $singular_name", 'reade-theme' ),
				'add_new'               => __( "Add New", 'reade-theme' ),
				'add_new_item'          => __( "Add New $singular_name", 'reade-theme' ),
				'edit_item'             => __( "Edit $singular_name", 'reade-theme' ),
				'view_item'             => __( "View $singular_name", 'reade-theme' ),
				'view_items'            => __( "View $plural_name", 'reade-theme' ),
				'search_items'          => __( "Search $plural_name", 'reade-theme' ),
				'not_found'             => __( "No $plural_name found", 'reade-theme' ),
				'not_found_in_trash'    => __( "No $plural_name found in trash", 'reade-theme' ),
				'parent_item_colon'     => __( "Parent $singular_name:", 'reade-theme' ),
				'menu_name'             => __( "$plural_name", 'reade-theme' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => $supports,
			'has_archive'           => $has_archive,
			'publicly_queryable'    => $publicly_queryable,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null, //TODO
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
   //    $supports = [ 'title', 'editor', 'thumbnail', 'excerpt' ],
   //    $taxonomies = [
   //       [$tax_slug, [ $post_type_slugs ], $tax_singular_name, $tax_plural_name],
   //       [$tax_slug, [ $post_type_slugs ], $tax_singular_name, $tax_plural_name],
   //    ]
   // );
   
   // /** 
   //  * PLACEHOLDER
   //  */
   cpt_init(
      'faqs',
      'FAQs',
      'FAQ',
      'FAQs',
      'faqs',
      'dashicons-products', //$menu_icon,
      $supports = [ 'title', 'editor', 'thumbnail', 'excerpt' ],
      $taxonomies = [
         [
            'faq_categories', // $tax_slug
            [ 'faqs' ],       // $post_type_slugs,
            'FAQ Category',   // $tax_singular_name, 
            'FAQ Categories'  // $tax_plural_name
         ],
      ],
		false, //$has_archive
		false //$publicly_queryable
   );
   
	
	/** 
    * Products
    */
   cpt_init( //TODO woocommerce
      'products', //$slug,
      'Products', //$name,
      'Product',  //$singular_name,
      'Products', //$plural_name,
      'products', //$rest_base,
      'dashicons-products', //$menu_icon,
      $supports = [ 'title', 'editor', 'thumbnail', 'excerpt' ],
      $taxonomies = [
         [
            'product_categories', // $tax_slug
            [ 'products' ],       // $post_type_slugs,
            'Product Category',  // $tax_singular_name, 
            'Product Categories' // $tax_plural_name
         ],
      ]
   );


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
      'team', //$slug,
      'Team', //$name,
      'Team Member', //$singular_name,
      'Team', //$plural_name,
      'team',        //$rest_base,
      'dashicons-admin-tools', //TODO //$menu_icon, 
      $supports = [ 'title', 'editor', 'thumbnail', 'excerpt' ],
      $taxonomies = [
         [
            'team_categories', 
            [ 'team' ], 
            "Team Category",
            "Team Categories"
         ]
		],
		false, //$has_archive
		false //$publicly_queryable
   );

   /** 
    * Tools 
    */
   cpt_init(
      'tools', //$slug,
      'Tools', //$name,
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
		],
		true //$has_archive
   );

   //TODO
   /*** Copy and Update for each Taxonomy */
	add_filter( 'term_updated_messages', 'faq_category_updated_messages' );
   function faq_category_updated_messages( $messages ) {

      $slug          = "faq_category"; 
      $singular_name = "FAQ Category";
      $plural_name   = "FAQ Categories";
      
      cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
      return $messages;
   }
	
   add_filter( 'term_updated_messages', 'product_category_updated_messages' );
   function product_category_updated_messages( $messages ) {

      $slug          = "product_category"; 
      $singular_name = "Product Category";
      $plural_name   = "Product Categories";
      
      cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
      return $messages;
   }

	add_filter( 'term_updated_messages', 'service_category_updated_messages' );
   function service_category_updated_messages( $messages ) {

      $slug          = "service_category"; 
      $singular_name = "Service Category";
      $plural_name   = "Service Categories";
      
      cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
      return $messages;
   }
	
	add_filter( 'term_updated_messages', 'tools_category_updated_messages' );
   function tools_category_updated_messages( $messages ) {

      $slug          = "tools_category"; 
      $singular_name = "Tool Category";
      $plural_name   = "Tool Categories";
      
      cpt_updated_messages($messages, $slug, $singular_name, $plural_name);
      return $messages;
   }
   
}
add_action( 'init', 'setup_custom_post_types' );

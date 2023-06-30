<?php
define('TEXTDOMAIN', 'acl-theme');
define("IS_LOCAL", wp_get_environment_type() == "local");
//TODO if( IS_LOCAL) { define("REMOTE_URL", "https://reade.wpengine.com"); }

//PRE_LAUNCH if( IS_LOCAL ) { //rm theme-develop
ini_set("error_log", get_stylesheet_directory() . "/debug.txt");

require_once( get_stylesheet_directory() . '/lib/theme-setup.php' );
require_once( get_stylesheet_directory() . '/lib/theme-enqueue-scripts.php' );
require_once( get_stylesheet_directory() . '/template-parts/blocks/_index.php' );

//PRE_LAUNCH
require_once (get_stylesheet_directory() . '/lib/tf-db-sync.php');

// function reade_load_theme_textdomain() {
//   load_theme_textdomain( 'reade-theme', get_template_directory() . '/languages' );
// }
// add_action( 'after_setup_theme', 'reade_load_theme_textdomain' );

//TODO setup placeholder structure for new /post


// prevent uncategorized from being an option in acf taxonomy fields
add_filter('acf/fields/taxonomy/wp_list_categories/name=categories_in_dropdown', 'exclude_taxonomy_args', 10, 2);
function exclude_taxonomy_args( $args, $field ) {
  $args['exclude'] = array('1'); //the IDs of the excluded terms
  return $args;
}
<?php
define('TEXTDOMAIN', 'acl-theme');
define("IS_LOCAL", wp_get_environment_type() == "local");
define("REMOTE_URL", "http://reade.wpengine.com");

ini_set("error_log", get_stylesheet_directory() . "/debug.txt");
if( IS_LOCAL ) {
}

require_once( get_stylesheet_directory() . '/lib/theme-setup.php' );
require_once( get_stylesheet_directory() . '/lib/theme-enqueue-scripts.php' );
//require_once( get_stylesheet_directory() . '/template-parts/blocks/_index.php' );

// function reade_load_theme_textdomain() {
//   load_theme_textdomain( 'reade-theme', get_template_directory() . '/languages' );
// }
// add_action( 'after_setup_theme', 'reade_load_theme_textdomain' );


//TODO setup placeholder structure for new /post

if( IS_LOCAL ) {
   require_once (get_stylesheet_directory() . '/lib/tf-db-sync.php');
}

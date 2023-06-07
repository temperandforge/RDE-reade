<?php

ini_set("error_log", get_stylesheet_directory() . "/debug.txt");

define('TEXTDOMAIN', 'acl-theme');
define("IS_LOCAL", wp_get_environment_type() == "local");
// define("REMOTE_URL", "");

$menus_arr = array(
   // 'top-navigation' 	=> __( 'Top Navigation' ),
   'primary-navigation' => __( 'Primary Navigation', TEXTDOMAIN ),
   'mobile-navigation' 	=> __( 'Mobile Navigation', TEXTDOMAIN ),
   'mobile-nav-bottom' 	=> __( 'Mobile Nav Bottom', TEXTDOMAIN ),
   'footer-navigation' 	=> __( 'Footer Navigation', TEXTDOMAIN ),
   'footer-nav-bottom' 	    => __( 'Footer Nav Bottom', TEXTDOMAIN ), 
 );

require_once( get_stylesheet_directory() . '/lib/theme-setup.php' );
require_once( get_stylesheet_directory() . '/lib/theme-enqueue-scripts.php' );
require_once( get_stylesheet_directory() . '/blocks/_index.php' );

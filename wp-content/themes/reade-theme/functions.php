<?php
define('TEXTDOMAIN', 'acl-theme');
define("IS_LOCAL", wp_get_environment_type() == "local");
define("REMOTE_URL", "https://reade.wpengine.com");

if( IS_LOCAL ) {
   ini_set("error_log", get_stylesheet_directory() . "/debug.txt");
}

require_once( get_stylesheet_directory() . '/lib/theme-setup.php' );
require_once( get_stylesheet_directory() . '/lib/theme-enqueue-scripts.php' );
require_once( get_stylesheet_directory() . '/template-parts/blocks/_index.php' );

//PRE_LAUNCH
require_once (get_stylesheet_directory() . '/lib/tf-db-sync.php');

/** Language Switching -> handled by gtranslate */
// add_action( 'after_setup_theme', 'reade_load_theme_textdomain' );
// function reade_load_theme_textdomain() {
//   load_theme_textdomain( 'reade-theme', get_template_directory() . '/languages' );
// }

/** Add woocommerce theme support **/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
   add_theme_support( 'woocommerce' );
}

/** disable default styling for woocommerce **/
if (class_exists('Woocommerce')){
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
}

/** enable gutenberg for woocommerce **/
function activate_gutenberg_product( $can_edit, $post_type ) {
if ( $post_type == 'product' ) {
	   $can_edit = true;
   }
	return $can_edit;
}

add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );
   
// enable taxonomy fields for woocommerce with gutenberg on
function enable_taxonomy_rest( $args ) {
   $args['show_in_rest'] = true;
   return $args;
}

add_filter( 'woocommerce_taxonomy_args_product_cat', 'enable_taxonomy_rest' );
add_filter( 'woocommerce_taxonomy_args_product_tag', 'enable_taxonomy_rest' );

//rid of resize warnings for woocommerce being outputted on the page
if( IS_LOCAL ) {
   add_filter('woocommerce_resize_images', static function() {
      return false;
   });
}

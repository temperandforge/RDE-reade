<?php
/**
 * Enqueue all styles and scripts
 */

 //PRE_LAUNCH
function theme_scripts() {
	$theme = wp_get_theme();
	$theme_uri = get_template_directory_uri();

	wp_deregister_script( 'wp-embed' );

   wp_dequeue_style( 'wp-block-library' ); // Wordpress core
   wp_dequeue_style( 'wp-blocks-style' ); // Wordpress core
   wp_dequeue_style( 'classic-theme-styles-css' ); // Wordpress core
   wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
   wp_dequeue_style( 'wc-blocks-style' ); // WooCommerce


	// Deregister the jquery version bundled with WordPress.
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js', array(), null, true );
	wp_enqueue_script( 'jquery-passive', $theme_uri . "/assets/js/passive.js", ['jquery'], $theme->version, true);

	wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], $theme->version, true);
	
   wp_enqueue_script('lity', "https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js", ['jquery'], $theme->version, true);
	
	wp_enqueue_style('theme-styles', $theme_uri . "/assets/css/bundle-posttwnd.css",  false, $theme->version);
	wp_enqueue_script('theme', $theme_uri . "/assets/js/bundle.js", ['jquery'], $theme->version, true);

}
add_action( 'wp_enqueue_scripts', 'theme_scripts', 10 );

function prefix_add_footer_styles() {
	$theme = wp_get_theme();
	$theme_uri = get_template_directory_uri();
   
   wp_enqueue_style('slick-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css', false, $theme->version);
   wp_enqueue_style('lity-styles', "https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css", false, $theme->version);
};
add_action( 'get_footer', 'prefix_add_footer_styles' );

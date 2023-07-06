<?php
/**
 * Enqueue all styles and scripts
 */

 //PRE_LAUNCH
function theme_scripts() {
	$theme = wp_get_theme();
	$theme_uri = get_template_directory_uri();

	wp_deregister_script( 'wp-embed' );

	// Deregister the jquery version bundled with WordPress.
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true );

	// slick
	// wp_enqueue_style('slick-styles', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, $theme->version);
	// // wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.theme.css', false, $theme->version);
	// wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], $theme->version, true);
	
	//lity
	// wp_enqueue_style('lity', "https://cdn.jsdelivr.net/npm/lity@2.4.1/dist/lity.min.css", false, $theme->version);
	// wp_enqueue_script('lity', "https://cdn.jsdelivr.net/npm/lity@2.4.1/dist/lity.min.js", ['jquery'], $theme->version, true);
	
   //drag scroll
	wp_enqueue_script('theme-dragscroll', $theme_uri . '/assets/js/dragscroll.js', '', $theme->version, true);

	wp_enqueue_style('theme-css', $theme_uri . "/assets/css/bundle-twnd.css",  false, $theme->version);
	
	wp_enqueue_script('theme-js', $theme_uri . "/assets/js/bundle.js", ['jquery'], $theme->version, true);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts', 10 );

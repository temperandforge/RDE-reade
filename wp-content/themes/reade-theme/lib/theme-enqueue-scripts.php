<?php
/**
 * Enqueue all styles and scripts
 */

//TODO - https://kinsta.com/blog/eliminate-render-blocking-javascript-css/
function theme_scripts() {
	$theme = wp_get_theme();
	$theme_uri = get_template_directory_uri();

	wp_deregister_script( 'wp-embed' );

	// Deregister the jquery version bundled with WordPress.
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true );

	//wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap',  false, null);

	//basicscroll - hero parallax
	// wp_enqueue_script('basicscroll', 'https://cdn.jsdelivr.net/npm/basicscroll@3.0.4/dist/basicScroll.min.js',  ['jquery'], null, true);
	
	//bootstrap accordion
	//wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js',  [], null, true);

	// slick
	// wp_enqueue_style('slick-styles', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, $theme->version);
	// // wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.theme.css', false, $theme->version);
	// wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], $theme->version, true);
	
	//lity
	// wp_enqueue_style('lity', "https://cdn.jsdelivr.net/npm/lity@2.4.1/dist/lity.min.css", false, $theme->version);
	// wp_enqueue_script('lity', "https://cdn.jsdelivr.net/npm/lity@2.4.1/dist/lity.min.js", ['jquery'], $theme->version, true);
	
	// wp_enqueue_script('isotope-layout', "https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js", ['jquery'], $theme->version, true);

	//svelte/bundle
	// wp_enqueue_style('theme-css', $theme_uri . "/assets/css/bundle-twnd.css",  false, $theme->version);
	wp_enqueue_style('theme-css', $theme_uri . "/assets/css/bundle-twnd.css",  false, $theme->version);
	
	// theme js
	//wp_enqueue_script('theme-js', $theme_uri . "/assets/js/bundle.js", ['jquery', 'wp-api'], $theme->version, true);
	wp_enqueue_script('theme-js', $theme_uri . "/assets/js/bundle.js", ['jquery'], $theme->version, true);
	// wp_enqueue_script('main-js', $theme_uri . "/src/main.js", ['jquery'], $theme->version, true);

	//drag scroll
	wp_enqueue_script('theme-dragscroll', $theme_uri . '/assets/js/dragscroll.js', '', $theme->version, true);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts', 10 );

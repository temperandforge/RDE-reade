<?php
/**
 * Enqueue all styles and scripts
 */

 //PRE_LAUNCH
function theme_scripts() {
	$theme = wp_get_theme();
	$theme_uri = get_template_directory_uri();

	wp_deregister_script( 'wp-embed' );
   //STARTER
   wp_dequeue_style( 'wp-block-library' ); // Wordpress core
   wp_dequeue_style( 'wp-blocks-style' ); // Wordpress core
   wp_dequeue_style( 'classic-theme-styles-css' ); // Wordpress core
   wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
   wp_dequeue_style( 'wc-blocks-style' ); // WooCommerce

   //TODO just for build wp_enqueue_style('slick-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css', false, $theme->version);
   //TODO just for build wp_enqueue_style('lity-styles', "https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css", false, $theme->version);
   // wp_enqueue_style('theme-css', $theme_uri . "/assets/css/bundle-twnd.css",  false, $theme->version);

	// Deregister the jquery version bundled with WordPress.
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
	//TODO  // wp_enqueue_script( 'cash-dom', 'https://cdn.jsdelivr.net/npm/cash-dom@8.1.5/dist/cash.min.js', array(), null, true );
   //<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js', array(), null, true );
	wp_enqueue_script( 'jquery-passive', $theme_uri . "/assets/js/passive.js", ['jquery'], $theme->version, true);

	// slick //TODO remove -> loadjs?
	//wp_enqueue_style('slick-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css', false, $theme->version);
	wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], $theme->version, true);
	
	//lity
	//wp_enqueue_style('lity-styles', "https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css", false, $theme->version);
	//TODO Just for build? wp_enqueue_script('lity', "https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js", ['jquery'], $theme->version, true);
	
   // bundle
	wp_enqueue_style('theme-css', $theme_uri . "/assets/css/bundle-twnd.css",  false, $theme->version);
	//TODO wp_enqueue_style('theme-css', $theme_uri . "/assets/css/critical.css",  false, $theme->version);
	wp_enqueue_script('theme-js', $theme_uri . "/assets/js/bundle.js", ['jquery'], $theme->version, true);

   // Add filters to catch and modify the styles and scripts as they're loaded.
   // add_filter( 'style_loader_tag', __NAMESPACE__ . '\wpdocs_my_add_sri', 10, 2 );
   add_filter( 'style_loader_tag',  'wpdocs_my_add_sri', 10, 2 );
   add_filter( 'script_loader_tag', 'wpdocs_my_add_sri', 10, 2 );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts', 10 );


//TODO integrity
/**
* Add SRI attributes based on defined script/style handles.
*/
function wpdocs_my_add_sri( $html, $handle ) : string {
   switch( $handle ) {
      //Style
       case 'lity-styles':
           $html = str_replace( ' />', ' integrity="sha512-UiVP2uTd2EwFRqPM4IzVXuSFAzw+Vo84jxICHVbOA1VZFUyr4a6giD9O3uvGPFIuB2p3iTnfDVLnkdY7D/SJJQ==" crossorigin="anonymous" />', $html );
           break;
       case 'slick-styles':
           $html = str_replace( ' />', ' integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" />', $html );
           break;


      //Script
       case 'jquery':
           $html = str_replace( '></script>', ' integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous"></script>', $html );
           break;
       case 'lity':
           $html = str_replace( '></script>', ' integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA==" crossorigin="anonymous"></script>', $html );
           break;
       case 'slick':
           $html = str_replace( '></script>', ' integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>', $html );
           break;
   } 
   return $html;
}


function prefix_add_footer_styles() {
	$theme = wp_get_theme();
	$theme_uri = get_template_directory_uri();
   
   wp_enqueue_style('theme-css', $theme_uri . "/assets/css/bundle-twnd.css",  false, $theme->version);
   wp_enqueue_style('slick-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css', false, $theme->version);
   wp_enqueue_style('lity-styles', "https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css", false, $theme->version);
   add_filter( 'style_loader_tag',  'wpdocs_my_add_sri', 10, 2 );
   add_filter( 'script_loader_tag', 'wpdocs_my_add_sri', 10, 2 );
};
// add_action( 'get_footer', 'prefix_add_footer_styles' );

<?php

/** 
 * Enable YAML file processing
 * */
// require_once __DIR__ . '/../vendor/autoload.php';
//use Symfony\Component\Yaml\Yaml;
// $yaml = Yaml::parse(file_get_contents(get_stylesheet_directory() . '/scripts/site.yml'));
// $yamlString = Yaml::dump($yaml);
// $siteObj = yaml_parse($yamlString);

class SetupAuto {
   // Constructor
   public function __construct() {
      //independent
      update_option('blog_public', '0'); //Discourage Search Engines From Indexing
      //flush permalinks/ changes post permalink
      $this->home(); // set sattic page as home
      $this->syncPages();
      $this->publishPrivacyPolicyPage();
      // remove default post, sample page
      // generate pages
      // set home page
      // geneate cpts
      // discourage search enginers
      $this->generateMenus();
   }

   function home() {
      $title = 'Home';
      if(!get_page_by_title($title)) {
         wp_insert_post([
            'menu_order' => -90,
            'post_type' => 'page',
            'post_title' => $title,
            'post_status' => 'publish',
         ]);
      }
   
      if ( $home = get_page_by_title( $title ))
      {
         update_option( 'page_on_front', $home->ID );
         update_option( 'show_on_front', 'page' );
      }
   }
   function syncPages() {
      foreach(array_keys(json_decode(file_get_contents(__DIR__ . '/site.json'), true)['pages']) as $title) {
         if(!get_posts([
            'post_type'=>'page',
            'title'=> $title,
            'post_status'=>'publish'
         ])) {
            $page_id = wp_insert_post([
               'post_type'    => 'page',
               'post_title'   => $title,
               'post_status'  => 'publish'
               //'post_content' => ''
            ]);
         }
      }
   }
   function publishPrivacyPolicyPage() {
      // check/generate, publish privacy policy page and set template
      if($privacy = get_posts([
         'post_type'=>'page',
         'title'=>"Privacy Policy",
         'post_status'=>'draft'
         ])) {
         $privacy = $privacy[0];
         $tmp = wp_update_post([
            'ID' => $privacy->ID,
            'post_status' => 'publish'
         ]);
         update_post_meta( $privacy->ID, '_wp_page_template', 'templates/legal.php' );
      } 
      // else {
      //    error_log(json_encode("No Privacy Page Found", JSON_PRETTY_PRINT));//debug
      // }

   }

   //https://wordpress.stackexchange.com/questions/44736/programmatically-add-a-navigation-menu-and-menu-items
   function generateMenus() {
      //global $menus_arr;
   
      $menus_arr = [
         'primary-navigation' => __( 'Primary Navigation' ),
         'footer-legal' => __( 'Footer Legal' ),
         // 'mobile-navigation' => __( 'Mobile Navigation' ),
         // 'footer' => __( 'Footer Navigation' ),
      ];
      $locations = get_theme_mod('nav_menu_locations');
      // foreach($site['menus']) {
      //    if(!has_nav_menu('primary-navigation')) {
      //       $mid = wp_create_nav_menu( 'Top Navigation' );
      //       $locations['primary-navigation'] = $mid;
      //    }
      // }
      // if(!has_nav_menu('primary-navigation')) {
      //    $mid = wp_create_nav_menu( 'Primary Navigation' );
      //    $locations['primary-navigation'] = $mid;
      // }
      foreach($menus_arr as $key => $val) {
         //if(!has_nav_menu($key)) {
         if(!$menu_exists = wp_get_nav_menu_object( $val )) {
            $menu_id = wp_create_nav_menu( $val );
            $locations[$key] = $menu_id;
            wp_update_nav_menu_item(
               $menu_id, 
               0, 
               [
                  'menu-item-title' =>  __('Home'),
                  //'menu-item-classes' => 'home',
                  'menu-item-url' => home_url( '/' ), 
                  'menu-item-status' => 'publish'
               ]
            );
         } 
         // else {
         //    error_log(json_encode($menu_exists, JSON_PRETTY_PRINT));//debug
         // }
      }
      // if(!has_nav_menu('mobile-navigation')) {
      //    $mid = wp_create_nav_menu( 'Mobile Navigation' );
      //    $locations['mobile-navigation'] = $mid;
      // }
      // if(!has_nav_menu('footer-navigation')) {
      //    $mid = wp_create_nav_menu( 'Footer Navigation' );
      //    $locations['footer-navigation'] = $mid;
      // }
      set_theme_mod( 'nav_menu_locations', $locations );
   }
}

//$auto = null;
//add_action( 'init', 'initSetup' );
function initSetup() { 
	$auto = new SetupAuto(); 
   return new WP_REST_Response('complete', 200);
}
function initPages() { 
	if(!$auto) {
      return new WP_Error('auto not setup', 500);
   }
   $auto->generatePages();
   return new WP_REST_Response('complete', 200);
}


// Rest api stuff - TODO nonce
add_action('rest_api_init', function () {
	$namespace = 'dev/v1';
	register_rest_route( $namespace, '/setup', array(
		'methods'  => 'GET',
		'callback' => 'initSetup',
		// 'permission_callback' => function( WP_REST_Request $request ) {
		// 	return current_user_can( 'manage_options' );
		// },
	));
	register_rest_route( $namespace, '/pages', array(
		'methods'  => 'GET',
		'callback' => 'initPages',
	));
});
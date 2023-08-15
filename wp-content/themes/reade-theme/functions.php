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
add_filter('woocommerce_resize_images', static function() {
    return false;
});






















/**
 * Salesforce
 */
add_menu_page(
   'Salesforce OAuth', // name in title bar
   'Salesforce OAuth', // text in menu
   'activate_plugins', // capability required - should be adminstrator capability
   'salesforce-oauth',  // menu slug
   'doSalesforceOAuth', // callback function for content
   'dashicons-money-alt', // icon
   '999'                  // position - we'll put it at the bottom
);

function getAccessToken($code) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://test.salesforce.com/services/oauth2/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_POSTFIELDS => 
            array(
                'grant_type' => 'authorization_code',
                'client_id' => '3MVG9eMnfmfDO5NCm2GJ.ybXbGH8w.AT81nrmhmZ2YuPyf9wi1RdfBCwryqA9sigaG26HlP1hEBPMy5xcqEtU',
                'client_secret' => '780E2DBC70E8BA933AE11F149986C4D92D8258EBD6B8ED7BDE1073D560ABDF00',
                'redirect_uri' => get_site_url() . '/wp-admin/admin.php?page=salesforce-oauth',
                'code' => $code
            )
        ,
        CURLOPT_HTTPHEADER     => array(
            "application/x-www-form-urlencoded"
        )
    ));

    $response = curl_exec( $curl );
    $err      = curl_error( $curl );
    curl_close( $curl );
    return $response;

}

function refreshToken($token) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://test.salesforce.com/services/oauth2/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_POSTFIELDS => 
            array(
                'grant_type' => 'refresh_token',
                'client_id' => '3MVG9eMnfmfDO5NCm2GJ.ybXbGH8w.AT81nrmhmZ2YuPyf9wi1RdfBCwryqA9sigaG26HlP1hEBPMy5xcqEtU',
                'client_secret' => '780E2DBC70E8BA933AE11F149986C4D92D8258EBD6B8ED7BDE1073D560ABDF00',
                'refresh_token' => $token
            )
        ,
        CURLOPT_HTTPHEADER     => array(
            "application/x-www-form-urlencoded"
        )
    ));

    $response = curl_exec( $curl );
    $err      = curl_error( $curl );
    curl_close( $curl );
    return $response;
}



function doSalesforceOAuth() {

   // get tokens
   $accessToken = get_option('salesforce_access_token');
   $refreshToken = get_option('salesforce_refresh_token');
   
   // check for code parameter in url
   if (!empty($_GET['code'])) {

      $token = json_decode(getAccessToken($_GET['code']));
      

      update_option('salesforce_access_token', $token->access_token);
      update_option('salesforce_refresh_token', $token->refresh_token);

      ?>
      <div class="salesforce-oauth-successful" style="padding-top: 50px;">
         <h1>Salesforce Authorized</h1>
         <p>Salesforce has been successfully connected and authorized.</p>
      </div>
      <?php


   } else {

      if (!empty($accessToken) && !empty($refreshToken)) {

         
         $new = json_decode(refreshToken($refreshToken));
         update_option('salesforce_access_token', $new->access_token);
         //update_option('salesforce_refresh_token', $new->refresh_token);

         //echo '<pre>'; print_r($new); echo '</pre>';

         //echo get_option('salesforce_access_token');
         //echo get_option('salesforce_refresh_token');
         
         ?>
         <div class="salesforce-oauth-successful" style="padding-top: 50px;">
            <h1>Salesforce Authorized</h1>
            <p>Salesforce is authorized.  Nothing to do here.</p>
         </div>
         <?php
      } else {

         // admin needs to authorize
         ?>
         <div class="salesforce-oauth" style="padding-top: 50px;">
            <h1>Connect To Salesforce</h1>
            <p>Salesforce app is not connected and authorized.  Click the link below to authorize this website's connection to salesforce.</p>
            <a href="https://test.salesforce.com/services/oauth2/authorize?response_type=code&client_id=3MVG9eMnfmfDO5NCm2GJ.ybXbGH8w.AT81nrmhmZ2YuPyf9wi1RdfBCwryqA9sigaG26HlP1hEBPMy5xcqEtU&redirect_uri=<?php echo get_site_url(); ?>/wp-admin/admin.php?page=salesforce-oauth">Authorize Salesforce</a>
         </div>
         <?php
      }
   }
}

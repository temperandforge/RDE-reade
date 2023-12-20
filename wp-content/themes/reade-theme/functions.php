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

/* redirect single team member to /about-us/leadership/#team-member */
function custom_rewrite_rule() {
    add_rewrite_rule('^team/([^/]+)/?', 'index.php?team_member=$matches[1]', 'top');
}
add_action('init', 'custom_rewrite_rule');

function custom_query_vars($vars) {
    $vars[] = 'team_member';
    return $vars;
}
add_filter('query_vars', 'custom_query_vars');

function custom_team_member_redirect() {
    if (get_query_var('team_member')) {
        $team_member = get_query_var('team_member');
        wp_redirect('/about-us/leadership/#' . $team_member, 301);
        exit();
    }
}
add_action('template_redirect', 'custom_team_member_redirect');


/* Disable tag pages, author page, user page, attachment page, media page */
function disable_sections() {
    if (is_tag()) {
        global $wp_query;
        wp_redirect(home_url(), 301);
        exit();
    }
    if (is_author()) {
        global $wp_query;
        wp_redirect(home_url(), 301);
        exit();
    }

    // attachment pages already redirect to the /wp-content/uploads/2023/x/x.ext
}

add_action('template_redirect', 'disable_sections');

/* Remove wc-all-blocks-style-css stylesheet */
function remove_wc_all_blocks_style_css() {
  wp_deregister_style( 'wc-all-blocks-style' );
}
add_action( 'enqueue_block_assets', 'remove_wc_all_blocks_style_css', 1, 1 );

/* Custom menu walker to add svg to menu-primary-navigation-1 */
class Custom_Menu_Walker extends Walker_Nav_Menu {
    // Override the start_el method
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Check if the current menu item has children
        $has_children = in_array('menu-item-has-children', $item->classes);

        // Add an SVG icon if the item has children
        if ($has_children) {
            $svg_icon = '<svg width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.677253 0.716315C0.91359 0.479978 1.29677 0.479978 1.5331 0.716315L4.729 3.91221L7.9249 0.716315C8.16124 0.479978 8.54442 0.479978 8.78076 0.716315C9.01709 0.952652 9.01709 1.33583 8.78076 1.57217L5.15693 5.19599C4.92059 5.43233 4.53742 5.43233 4.30108 5.19599L0.677253 1.57217C0.440916 1.33583 0.440916 0.952652 0.677253 0.716315Z" fill="#004455"/>
</svg>
'; // You can replace this with your SVG code
        } else {
            $svg_icon = '';
        }

        $output .= $indent . '<li id="menu-item-' . $item->ID . '" class="' . implode(' ', $item->classes) . '">';

        $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= $svg_icon . '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

//TODO remove
add_action('rest_api_init', function () {
   $namespace = 'meta/v1';
   register_rest_route($namespace, 'out', array(
     'methods'  => 'GET',
     'callback' => 'get_missing_meta',
   //   'permission_callback' => function (WP_REST_Request $request) {
   //     return current_user_can('manage_options');
   //   },
   ));
   register_rest_route($namespace, 'get_missing_meta', array(
     'methods'  => 'GET',
     'callback' => 'get_missing_meta',
   //   'permission_callback' => function (WP_REST_Request $request) {
   //     return current_user_can('manage_options');
   //   },
   ));
});

function get_missing_meta() {
   $res = [];
   foreach(['post', 'page', 'product'] as $post_type) {
      $posts = get_posts(array(
         'post_type' => $post_type,//['post', 'page'],//, 'product'],  // Adjust the post type as needed
         'posts_per_page' => -1,
         'post_status' => 'publish',
         'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => '_yoast_wpseo_metadesc',
                'value' => '',
                'compare' => 'NOT EXISTS',
            ),
            // array(
            //     'key' => '_yoast_wpseo_metadesc',
            //     'compare' => 'NOT IN',
            //     'value' => array('1', '0'),
            // ),
            array(
               'key' => '_yoast_wpseo_title',
               'value' => '',
               'compare' => 'NOT EXISTS',
            ),
            // array(
            //    'key' => '_yoast_wpseo_title',
            //    'compare' => 'NOT IN',
            //    'value' => array('1', '0'),
            // ),
         ),
      ));

      $posts = array_map(
         function($p) {
            return [$p->post_title, get_permalink($p->ID), get_post_meta($p->ID, '_yoast_wpseo_title', true), get_post_meta($p->ID, '_yoast_wpseo_metadesc', true)];
         },
         $posts
      );

      // // Specify the file path where you want to save the CSV
      // $csvFilePath = get_stylesheet_directory_uri() ."/$post_type.csv";

      // // Open the CSV file for writing
      // $csvFile = fopen($csvFilePath, 'w');

      // if ($csvFile) {
      //    // Loop through the data and write it to the CSV file
      //    foreach ($posts as $row) {
      //       fputcsv($csvFile, $row);
      //    }

      //    // Close the CSV file
      //    fclose($csvFile);

      //    echo "CSV file has been created successfully at $csvFilePath";
      // } else {
      //    echo "Failed to open the CSV file for writing.";
      // }
      $res[] = $posts;
   }


   return $res;
   // return array_map(
   //    function($p) {
   //       return [$p->post_title, get_permalink($p->ID), get_post_meta($p->ID, '_yoast_wpseo_title', true), get_post_meta($p->ID, '_yoast_wpseo_metadesc', true)];
   //    },
   //    $posts
   // );
}

//138 locally
define('ALL_PRODUCTS_CAT_ID', 368);

function contactform_dequeue_scripts() {
        global $post;
        if (!has_shortcode($post->post_content, 'contact-form-7')) {
            wp_dequeue_script('contact-form-7');
            wp_dequeue_script('google-recaptcha');
            wp_dequeue_style('contact-form-7');
        }
}
add_action('wp_enqueue_scripts', 'contactform_dequeue_scripts', 99);
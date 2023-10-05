<?php

// Include WordPress and WooCommerce files if not already included
if (!function_exists('wc_get_products')) {
   // include_once(ABSPATH . 'wp-load.php');
   // include_once(WC()->plugin_path() . '/includes/wc-core-functions.php');
   die();
}

// convert to json; provide different interface for faster setup validation

class WooCommerceChecker {
   // property declaration
   public $version = '0.0.1';

   // method declaration
   public function displayVersion() {
      echo $this->version;
   }
   
   public function syncCSV() {
      
   }

   public function syncJSON() {

   }

   public function listProducts() {
      $res = [];
      // $products_query = new WP_Query([
      //    'post_type'      => 'product',
      //    'posts_per_page' => -1, // Retrieve all products
      // ]);
      $products_query = get_posts([
         'post_type'      => 'product',
         'posts_per_page' => -1, // Retrieve all products
      ]);
      // if ($products_query->have_posts()) {
      //    while ($products_query->have_posts()) {
      //       $products_query->the_post();
      if ($products_query) {
         foreach ($products_query as $idx => $prd) {
            // $products_query->the_post();
            
            // Get product information
            // $product = wc_get_product(get_the_ID());
            $product = wc_get_product($prd->ID);
            
            // You can now access product data
            $product_id    = $product->get_id();
            $product_title = $product->get_title();
            $product_sku   = $product->get_sku();
            $product_price = $product->get_price();
            $attributes    = $product->get_attributes();
            $meta          = get_post_meta($product->get_id());
            // $short    = get_field($product->get_id());
            $short         = $product->get_description();
            $excerpt       = $prd->post_excerpt; //?

            //TODO blocks
   
            // Do something with the product data
            // echo '<script>console.log('.json_encode($product, JSON_PRETTY_PRINT).');</script>';//debug
            $res[] = "Product ID: $product_id, Title: $product_title, Description: $short, Excerpt: $excerpt, SKU: $product_sku, Price: $product_price, Attributes:" . json_encode($attributes);// . "Meta: " . json_encode($meta);
         }
         // wp_reset_postdata();
      } else {
         $res[] = 'No products found.';
      }

      return $res;
   }
}

add_action('wp_footer', function() {
   $wcc_client = new WooCommerceChecker();
   echo '<script>console.log('.json_encode($wcc_client->listProducts()[4], JSON_PRETTY_PRINT).');</script>';//debug
});

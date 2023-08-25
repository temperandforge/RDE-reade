<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// get fields
$productfields = get_fields();

// get product info
$qo = get_queried_object();
$product = new WC_Product($qo->ID);

// use "global $product" in blocks to get product info

// if a sub product is being accessed, redirect to the main product (identified in cross-sell), otherwise 
// go to homepage
if (!get_field('is_main_product', $product->get_id())) {
   $cs = $product->get_cross_sell_ids();
   if (!empty($cs)) {
      wp_redirect(get_permalink($cs[0]), 301);
      exit;
   } else {
      wp_redirect(get_site_url());
      exit;
   }
}

get_header();


?>
<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
   
      <div class="theme-inner-wrap">
         <article class="single-product">
         	<?php
            
         	the_content($product->get_description());

         	/* temp */

         	 if (isset($_GET['empty_cart'])) {
         	 	$woocommerce->cart->empty_cart();
         	 }

         	// temp
         	// echo '<h3>Cart</h3>';
         	// echo '<a href="?empty_cart">Empty Cart</a>';
         	// echo '<pre>'; print_r($woocommerce->cart->get_cart_contents()); echo '</pre>';

         	?>
         </article>
     </div>
 </div>
</main>
<?php

get_footer();

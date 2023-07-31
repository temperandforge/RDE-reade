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
get_header();

// get fields
$productfields = get_fields();

// get product info
$qo = get_queried_object();
$product = new WC_Product($qo->ID);

// use "global $product" in blocks to get product info



?>
<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
   
      <div class="theme-inner-wrap">
         <article class="single-product">
         	<?php

         	// only simple products should be shown.  others should 404.  all products base types are simple
         	// the variants should never be shown on a top level product page

         	if ($product->get_type() != 'simple') {
         		die();
         	}

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

<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

$page_id = is_shop() ? wc_get_page_id( 'shop' ) : false;

?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
   
      <div class="theme-inner-wrap">
         <article class="product-archive">
         	<?php

            if ($page_id) {
               $post = get_post($page_id);
               echo the_content(null, false, $post);
            } else {
               echo 'archive page';
            }

         	?>
         </article>
     </div>
 </div>
</main>
<?php

get_footer( );

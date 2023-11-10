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

if (stripos($_SERVER['REQUEST_URI'], 'product-category/sustainable-products') !== false) {
   wp_redirect(get_site_url() . '/sustainable-products/', 301);
   exit;
}

if ($qo = get_queried_object()) {
   if ($qo->parent != 0) {
      $parent = $qo->parent;
      $category_url = get_term_link($parent, 'product_cat');
    
      if (!is_wp_error($category_url)) {
         wp_redirect($category_url);
         exit;
      } else {
         wp_redirect(get_site_url() . '/products');
         exit;
      }
   }
}

$page_id = is_shop() ? wc_get_page_id( 'shop' ) : false;

get_header();

?>
<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
   
      <div class="theme-inner-wrap">
         <article class="product-archive">
         	<?php

            if ($page_id) {
               
               /*
               * product post type archive page
               */
               
               $post = get_post($page_id);
               echo the_content(null, false, $post);

            } else {

               /*
               * product category archive page
               */
               $qobj = get_queried_object();
               
               
               if ($qobj && $qobj->term_id == ALL_PRODUCTS_CAT_ID) {

                  // Retrieve the acf values for "secondary hero" from the "products" page to include in the header for this page
                  $field_values = parse_blocks(get_post_field('post_content', 88));

                  if (!empty($field_values)) {
                     $found_block_key = false;
                     foreach ($field_values AS $k => $fv) {
                        if ($fv['blockName'] == 'acf/secondary-hero') {
                           $found_block_key = $k;
                           break;
                        }
                     }

                     if ($found_block_key !== false) {

                        $field_values[$found_block_key]['attrs']['data']['image'] = array('ID' => $field_values[$found_block_key]['attrs']['data']['image']);
                        include( locate_template( 'template-parts/blocks/secondary-hero.php', false, false, $args = $field_values[$found_block_key]['attrs']['data'] ?: array()) );
                     }
                  }


                   

               } else {
                  // product archive hero
                  $pah_fields = array(
                     'headline' => $qobj->name,
                     'text' => $qobj->description,
                     'applications' => get_field('applications', $qobj)
                  );

                  $thumbnail_id = get_term_meta($qobj->term_id, 'thumbnail_id', true);
                  if ($thumbnail_id) {
                     if($img = wp_get_attachment_image_src($thumbnail_id, 'full')) {
                        $pah_fields['image']['sizes']['large'] = $img[0];
                        $pah_fields['image']['alt'] = $qobj->name . ' Category Image';
                        $pah_fields['image']['sizes']['large_width'] = $img[1];
                        $pah_fields['image']['sizes']['large_height'] = $img[2];
                     }
                  }



                  include( locate_template( 'template-parts/blocks/product-archive-hero.php', false, false, $args = $pah_fields ?: array()) );
               }



               // product archive main
               $pam_fields = array(
                  'column_1_text' => '',
                  'column_2_text' => '',
                  'term_id' => $qobj->term_id
               );
               
               include( locate_template( 'template-parts/blocks/product-archive-main.php', false, false, $args = $pam_fields ?: array()) );



               // cta
               include( locate_template( 'template-parts/blocks/primary-footer-cta.php', false, false, $args = get_fields($qobj) ?: array()) );
            }

         	?>
         </article>
     </div>
 </div>
</main>
<?php

get_footer( );

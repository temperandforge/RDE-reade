<?php

require_once __DIR__ . '/../../../../../../wp-load.php';

// output buffering start
ob_start();

         $per_page = 6;

         /* Product category images */

         $category_images = [];

         $product_categories = get_terms(array(
           'taxonomy'   => 'product_cat',
           'hide_empty' => false,
           'exclude'    => array(get_option('default_product_cat')),
           'parent' => 0,
           // 'orderby' => 'name',
           // 'order' => 'ASC'
         ));
         
         if (!empty($product_categories)) {
            foreach ($product_categories AS $product_category) {
               $thumbnail_id = get_term_meta($product_category->term_id, 'thumbnail_id', true);
               if ($thumbnail_id) {
                  if ($image_attributes = wp_get_attachment_image_src($thumbnail_id, 'large')) {
                     $category_images[$product_category->term_id] = $image_attributes;
                  }
               } else {
                  if (!empty($options['category_fallback_image']['url'])) {
                     $category_images[$product_category->term_id] = array(
                        0 => $options['category_fallback_image']['sizes']['medium_large'],
                        1 => $options['category_fallback_image']['sizes']['medium_large-width'],
                        2 => $options['category_fallback_image']['sizes']['medium_large-height']
                     );
                  }
               }
            }
         }




         /* Gather products */
         $products = new WP_Query(array(
           'post_type' => 'product',
           'post_status' => 'publish',
           'posts_per_page' => -1,
           'meta_query' => array(
               array(
                  'key' => 'is_main_product', // Your ACF field name
                  'value' => '1', // Value to match (true)
                  'compare' => '=', // Use '=' for exact matching
                  'type' => 'NUMERIC', // Specify the data type of your custom field (use 'NUMERIC' for true/false values)
               ),
            ),
           'order' => 'ASC',
           'orderby' => 'name'
         ));
         
         if (!empty($products->posts)) {
            
            foreach ($products->posts AS $prodpost) {
               ?>
               <div class="pab-product" data-search-terms="<?php echo strtolower($prodpost->post_title); ?>">
                  <a class="fillall" href="<?php echo get_permalink($prodpost->ID) ?>">
                     <span class="sr-only"><?php echo $prodpost->post_title; ?> Product</span>
                  </a>
                  <div class="pab-category-image">
                     <?php
                     
                        $product_categories = wp_get_post_terms($prodpost->ID, 'product_cat');

                        if (!empty($product_categories)) {
                           $firstCat = $product_categories[0]->term_id;
                           ?>
                           <img src="<?php echo $category_images[$firstCat][0]; ?>" alt="<?php echo $product_categories[0]->name; ?> Category" width="<?php echo $category_images[$firstCat][1]; ?>" height="<?php echo $category_images[$firstCat][2]; ?>">
                           <?php
                        }

                     ?>
                  </div>
                  <div class="pab-category-info">
                     <div class="pab-category-info-left">
                        <?php echo str_replace(array('®'), array('<sup>®</sup>'), $prodpost->post_title); ?>
                     </div>
                     <div class="pab-category-info-right">
                        &nbsp;
                     </div>
                  </div>
               </div>
               <?php
            }
         }

      


         /* Gather categories */
         $product_categories = get_terms(array(
           'taxonomy'   => 'product_cat',
           'hide_empty' => false,
           'exclude'    => array(get_option('default_product_cat')),
           'parent' => 0,
           // 'orderby' => 'name',
           // 'order' => 'ASC'
         ));
         
         if (!empty($product_categories)) {

            $count = count($product_categories);
            $pages = ceil($count / $per_page);

            foreach ($product_categories AS $product_category) {

               // permalink
               $permalink = get_term_link($product_category, 'product_cat');

               // thumbnail id
               $thumbnail_id = get_term_meta($product_category->term_id, 'thumbnail_id', true);

               // product count
               $query_args = array(
                    'post_type'      => 'product',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'term_id',
                            'terms'    => $product_category->term_id,
                        ),
                    ),
                    'meta_query'     => array(
                        array(
                            'key'     => 'is_main_product',
                            'value'   => true,
                            'compare' => '='
                        ),
                    ),
                );

                $products_query = new WP_Query($query_args);
                $product_count = $products_query->found_posts;
                $product_search_terms = [];

                if (!empty($products_query->posts)) {
                  foreach ($products_query->posts AS $qpost) {
                     $product_search_terms[] = strtolower($qpost->post_title);
                  }
                }



               ?>
               <div class="pab-category" data-search-terms="<?php echo strtolower($product_category->name); ?> <?php echo implode(' ', $product_search_terms); ?>">
                  <a class="fillall" href="<?php echo $permalink; ?>">
                     <span class="sr-only"><?php echo $product_category->name; ?> Category</span>
                  </a>
                  <div class="pab-category-image">
                     <?php

                     if ($thumbnail_id) {
                        if ($image_attributes = wp_get_attachment_image_src($thumbnail_id, 'large')) {
                           ?>
                           <img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo $product_category->name; ?> Category" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>">
                           <?php
                        }
                     } else {
                        if (!empty($options['category_fallback_image']['url'])) {
                           ?>
                           <img src="<?php echo $options['category_fallback_image']['sizes']['medium_large']; ?>" alt="<?php echo $product_category->name; ?> Category" width="<?php echo $options['category_fallback_image']['sizes']['medium_large-width']; ?>" height="<?php echo $options['category_fallback_image']['sizes']['medium_large-height']; ?>">
                           <?php
                        }
                     }

                     ?>
                  </div>
                  <div class="pab-category-info">
                     <div class="pab-category-info-left">
                        <?php echo str_replace(array('®'), array('<sup>®</sup>'), $product_category->name); ?>
                     </div>
                     <div class="pab-category-info-right">
                        <span><?php echo $product_count; ?></span>
                     </div>
                  </div>
               </div>
               <?php
            }
         }

// get output buffer and echo it
$contents = ob_get_clean();
echo $contents;
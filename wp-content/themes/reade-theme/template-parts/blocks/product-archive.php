<?php

$fields = get_fields();
$options = get_fields('options');

?>
<div class="product-archive-block">
   <div class="pab-top">
      <?php

      if (!empty($fields['headline'])) {
         ?>
         <h2 class="pab-headline"><?php echo $fields['headline']; ?></h2>
         <?php
      }

      if (!empty($fields['text'])) {
         ?>
         <div class="pab-text">
            <?php echo $fields['text']; ?>
         </div>
         <?php
      }

      ?>
   </div>

   <div class="pab-filters">
      <div class="pab-filters-left">
         <?php

         $filter1_options = array(
            'id' => 'filter1',
            'width' => '192px',
            'select_text' => !empty($options['sort_text']) ? $options['sort_text'] : 'Sort',
            'svg' => '<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M0.1853 0.965493C-0.045104 1.17537 -0.0617475 1.53228 0.148125 1.76269L4.91632 6.99734C5.02326 7.11473 5.17471 7.18164 5.3335 7.18164C5.4923 7.18164 5.64375 7.11473 5.75069 6.99734L10.5189 1.76268C10.7288 1.53228 10.7121 1.17537 10.4817 0.965492C10.2513 0.755619 9.89439 0.772263 9.68452 1.00267L5.3335 5.77932L0.982492 1.00267C0.772619 0.772264 0.415704 0.75562 0.1853 0.965493Z" fill="#006078"/>
               </svg>',
            'values' => array(
               'alpha' => 'Alphabetical',
               'reversealpha' => 'Reverse Alphabetical'
            )
         );

         tf_dropdown($filter1_options);

         ?>
      </div>
      <div class="pab-filters-right">
         <input class="pab-filters-search" type="text" value="" placeholder="<?php echo !empty($options['search_placeholder_text']) ? $options['search_placeholder_text'] : 'Search'; ?>">
         <hr>
      </div>
   </div>

   <div class="pab-categories">
         <?php

         $per_page = 6;

         $product_categories = get_terms(array(
           'taxonomy'   => 'product_cat',
           'hide_empty' => false,
           'exclude'    => array(get_option('default_product_cat'))
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
                        if ($image_attributes = wp_get_attachment_image_src($thumbnail_id, 'medium')) {
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
                        <?php echo $product_category->name; ?>
                     </div>
                     <div class="pab-category-info-right">
                        <span><?php echo $product_count; ?></span>
                     </div>
                  </div>
               </div>
               <?php
            }
         }

         ?>
   </div>

   <div class="pab-pagination">
      <div class="pab-pagination-dots">
         <!-- empty, dots generated by js -->
      </div>
      <div class="pab-pagination-arrows">
         <button class="prev-btn btn-dark-blue-blue"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.55382 15.4445L3.10937 10M3.10937 10L8.55382 4.55557M3.10937 10L17.1094 10" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
         <button class="next-btn btn-dark-blue-blue"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.7274 4.55554L17.1719 9.99999M17.1719 9.99999L11.7274 15.4444M17.1719 9.99999L3.17188 9.99999" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
      </div>
   </div>


</div>
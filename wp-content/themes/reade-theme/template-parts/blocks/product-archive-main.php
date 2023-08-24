<?php

if (is_archive()) {
   $fields = $args;
} else {
   $fields = get_fields();
}

$options = get_fields('options');

?>
<div class="product-archive-main">
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
         <form id="pab-filters-form">
         <input class="pab-filters-search" type="text" value="" placeholder="<?php echo !empty($options['search_placeholder_text']) ? $options['search_placeholder_text'] : 'Search'; ?>">
         <span id="pab-filters-search-icon"></span>
         </form>
         <hr>
      </div>
   </div>

   <div class="pab-search-empty">
      <h3 class="pab-search-empty-title">Search: "<span id="pab-search-term"></span>"</h3>
      <p class="pab-search-empty-text"><?php echo !empty($options['empty_search_text']) ? $options['empty_search_text'] : 'No results'; ?></p>
   </div>

   <div class="pab-categories">
         <?php

         $per_page = 6;

         if (is_archive()) {
            $term = get_term_by('id', $fields['term_id'], 'product_cat');
         } else {
            // get products from sustainable products category
            $term = get_term_by('name', 'Sustainable Products', 'product_cat');
         }

         $query_args = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'tax_query'      => array(
               array(
                'taxonomy' => 'product_cat',
               'field'    => 'term_id',
               'terms'    => $term->term_id,
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

         $products = new WP_Query($query_args);


         if (!empty($products->posts)) {

            ?>
            <div class="pab-top-wrap">
               <div class="pab-top-wrap-left">
                  <?php

                  if (!empty($fields['column_1_text'])) {
                     echo $fields['column_1_text']; 
                  } else {
                     echo !empty($options['product_name_text']) ? $options['product_name_text'] : 'Product Name';
                  }

                  ?>
               </div>
               <div class="pab-top-wrap-right">
                  <?php

                  if (!empty($fields['column_2_text'])) {
                     echo $fields['column_2_text'];
                  } else {
                     echo !empty($options['description_text']) ? $options['description_text'] : 'Description';
                  }

                  ?>
               </div>
            </div>
            <?php

            foreach ($products->posts AS $prod) {

               $prodinfo = new WC_Product($prod->ID);
               $permalink = $prodinfo->get_permalink();



               ?>
               <div class="pab-category" data-search-terms="<?php echo strtolower($prodinfo->get_name()); echo ' ' . strip_tags(str_replace(array('<', '>', '"', "'"), ' ', $prodinfo->get_short_description())); ?>">
                  <div class="pab-category-wrap">
                     <a class="fillall" href="<?php echo $permalink; ?>">
                        <span class="sr-only"><?php echo $prodinfo->get_name(); ?></span>
                     </a>
                     <div class="pab-prod-left">
                        <div class="pab-category-info-left">
                           <?php echo str_replace(array('®'), array('<sup>®</sup>'), $prodinfo->get_name()); ?>
                        </div>
                     </div>
                     <div class="pab-prod-middle">
                        <?php echo str_replace(array('®'), array('<sup>®</sup>'), $prodinfo->get_short_description()); ?>
                     </div>
                     <div class="pab-prod-right">
                        <a class="btn-light-blue-blue btn-arrow">
                           <?php
                           echo !empty($options['view_product_text']) ? $options['view_product_text'] : 'View Product';
                           ?>
                           <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.88128C12.348 5.53957 12.902 5.53957 13.2437 5.88128L16.7437 9.38128C17.0854 9.72299 17.0854 10.277 16.7437 10.6187L13.2437 14.1187C12.902 14.4604 12.348 14.4604 12.0063 14.1187C11.6646 13.777 11.6646 13.223 12.0063 12.8813L14.0126 10.875H3.875C3.39175 10.875 3 10.4832 3 10C3 9.51675 3.39175 9.125 3.875 9.125H14.0126L12.0063 7.11872C11.6646 6.77701 11.6646 6.22299 12.0063 5.88128Z" fill="#009FC6"/>
                           </svg>
                        </a>
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
         <button class="prev-btn btn-blue-dark-blue" aria-label="Previous"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.55382 15.4445L3.10937 10M3.10937 10L8.55382 4.55557M3.10937 10L17.1094 10" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
         <button class="next-btn btn-blue-dark-blue" aria-label="Next"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.7274 4.55554L17.1719 9.99999M17.1719 9.99999L11.7274 15.4444M17.1719 9.99999L3.17188 9.99999" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
      </div>
   </div>


</div>
<?php get_header();

$options = get_fields('options');

// function to return post type name instead of post type
function get_post_type_nat($pt) {
   if ($pt == 'post') {
      return 'News';
   }
   if ($pt == 'team') {
      return 'Leadership';
   }
   if ($pt == 'ms-documents') {
      return 'Materials Science Documents';
   }

   return ucwords($pt);
}

// rebuild search query,
// only including products with acf field "is_main_product" with a value of "1"
$args = [
   'post_status' => 'publish',
   'posts_per_page' => -1,
   's' => !empty(get_query_var('s')) ? get_query_var('s') : '',
   'meta_query' => [
        'relation' => 'OR',
        [
            'key' => 'is_main_product',
            'value' => '1',
            'compare' => '=',
            'type' => 'NUMERIC'
        ],
        [
            'key' => 'is_main_product',
            'compare' => '=',
            'value' => '0',
            'type' => 'NUMERIC'
        ],
    ],
];

if (!empty($_GET['type']) && in_array($_GET['type'], array('post', 'page', 'product', 'ms-documents', 'careers', 'team'))) {
   $args['post_type'] = $_GET['type'];
} else {
   $args['post_type'] = array('post', 'page', 'product', 'ms-documents', 'careers', 'team');
}

$query = new WP_Query($args);
$searchperpage = 10;
?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">
         <article class="search-results--page-content site-search">
               <div class="site-search-header">
                  <div class="site-search-header-left">
                     <a href="<?php echo get_site_url(); ?>" class="btn-light-blue-blue btn-arrow-reverse btn-news-back">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99372 5.88128C7.65201 5.53957 7.09799 5.53957 6.75628 5.88128L3.25628 9.38128C2.91457 9.72299 2.91457 10.277 3.25628 10.6187L6.75628 14.1187C7.09799 14.4604 7.65201 14.4604 7.99372 14.1187C8.33543 13.777 8.33543 13.223 7.99372 12.8813L5.98744 10.875H16.125C16.6082 10.875 17 10.4832 17 10C17 9.51675 16.6082 9.125 16.125 9.125H5.98744L7.99372 7.11872C8.33543 6.77701 8.33543 6.22299 7.99372 5.88128Z" fill="#009FC6"/>
                        </svg>
                        <?php echo !empty($options['search_back_text']) ? $options['search_back_text'] : 'Back'; ?>
                     </a>

                     <h1 class="site-search-title"><?php echo !empty($options['search_text_prefix']) ? $options['search_text_prefix'] : 'Search:'; ?> <?php echo !empty(get_query_var('s')) ? get_query_var('s') : ''; ?></h1>

                     <div class="site-search-results-count">
                        (<?php echo $query->found_posts; ?> <?php echo !empty($options['search_results_text']) ? $options['search_results_text'] : 'results'; ?>)
                     </div>
                  </div>
                  <div class="site-search-header-right">
                     <?php

                     $filter = [
                        'id' => 'site-search-filter',
                        'width' => '100%',
                        'svg' => '<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M0.519284 0.965493C0.28888 1.17537 0.272237 1.53228 0.482109 1.76269L5.25031 6.99734C5.35724 7.11473 5.50869 7.18164 5.66749 7.18164C5.82629 7.18164 5.97774 7.11473 6.08467 6.99734L10.8529 1.76268C11.0627 1.53228 11.0461 1.17537 10.8157 0.965492C10.5853 0.755619 10.2284 0.772263 10.0185 1.00267L5.66749 5.77932L1.31648 1.00267C1.1066 0.772264 0.749688 0.75562 0.519284 0.965493Z" fill="#006078"/>
                           </svg>',
                        'show_all' => true,
                        'show_all_text' => !empty($options['filter_all_text'])
                                             ? $options['filter_all_text']
                                             : 'All',
                        'select_text' => !empty($options['filter_text']) ? $options['filter_text'] : 'Filter by type',
                        'values' => [
                           'careers' => 'Careers',
                           'team' => 'Leadership',
                           'ms-documents' => 'Materials Science Documents',
                           'post' => 'News',
                           'page' => 'Page',
                           'product' => 'Product'
                        ]
                     ];

                     if (!empty($_GET['type']) && in_array($_GET['type'], array('post', 'page', 'product', 'ms-documents', 'careers', 'team'))) {
                        $filter['select_text'] = get_post_type_nat($_GET['type']);
                     }

                     tf_dropdown($filter);

                     ?>
                  </div>
               </div>

               <div class="site-search-results">
                  <?php

                  if (!$query->found_posts) {
                     ?>
                     <p class="site-search-results-empty">
                        <?php

                        echo !empty($options['search_results_empty_text'])
                           ? $options['search_results_empty_text']
                           : 'Sorry, no search results were found';

                        ?>
                     </p>
                     <?php
                  } else {
                     while( $query->have_posts() ) { $query->the_post(); 
                        ?>
                        <div class="site-search-result-container">
                           <div class="site-search-result">
                              <div class="site-search-result-left">
                                 <div class="site-search-result-type">
                                    <?php echo get_post_type_nat(get_post_type()); ?>
                                 </div>
                                    <h2 class="site-search-result-heading">
                                       <?php the_title(); ?>
                                    </h2>
                              </div>
                              <div class="site-search-result-right">
                                 <button class="btn-blue-dark-blue btn-arrow btn-search-result">
                                    <?php

                                    if (strtolower(get_post_type()) == 'product') {
                                       echo !empty($options['search_product_button_text'])
                                          ? $options['search_product_button_text']
                                          : 'View More';
                                    } else {
                                       echo !empty($options['search_button_text'])
                                          ? $options['search_button_text']
                                          : 'Read More';
                                    }

                                    ?>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.88128C12.348 5.53957 12.902 5.53957 13.2437 5.88128L16.7437 9.38128C17.0854 9.72299 17.0854 10.277 16.7437 10.6187L13.2437 14.1187C12.902 14.4604 12.348 14.4604 12.0063 14.1187C11.6646 13.777 11.6646 13.223 12.0063 12.8813L14.0126 10.875H3.875C3.39175 10.875 3 10.4832 3 10C3 9.51675 3.39175 9.125 3.875 9.125H14.0126L12.0063 7.11872C11.6646 6.77701 11.6646 6.22299 12.0063 5.88128Z" fill="#FAFAFA"/>
                                    </svg>
                                 </button>
                              </div>
                              <a class="fillall" href="<?php echo get_permalink(get_the_ID()); ?>">
                                 <span class="sr-only">View <?php echo the_title(); ?> Search Result</span>
                              </a>
                           </div>
                        </div>
                        <?php
                     }
                  }

                  ?>
               </div>

               <?php

               if (ceil($query->found_posts/$searchperpage) > 1) {
                  ?>
                  <button id="site-search-load-more" class="btn-blue-dark-blue">
                     <?php

                     echo !empty($options['search_load_more'])
                        ? $options['search_load_more']
                        : 'Load More';

                     ?>
                  </button>
                  <?php
               }

               ?>

         </article>
      </div>
   </div>
</main>

<?php get_footer(); ?>

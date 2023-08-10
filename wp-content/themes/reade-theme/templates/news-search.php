<?php /* Template Name: News Search */
get_header();

$options = get_fields('options');
$view_more_button_text = get_field('view_more_button_text', 'options') ? get_field('view_more_button_text', 'options') : 'View More';

?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">

         <div class="news-search">

         <?php

         if (trim($_GET['sv']) != '') {
            $search_posts = get_posts(
                array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'numberposts' => -1,
                    's' => sanitize_text_field($_GET['sv'])
                )
            );

            $search_results = count($search_posts);

            // set up variable for partial depending on if there were search results
            if ($search_results) {
                $hero_headline = ($options['search_query_label'] ? $options['search_query_label'] : 'Search:') . ' ' . $_GET['sv'];
                $hero_description = '(' . $search_results . ' ' . ($search_results == 1 ? 'result' : 'results') . ')';
                $hero_search = false;
                $hero_breadcrumbs = array(
                    '/news/' => '<svg class="first-arrow" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99372 5.88128C7.65201 5.53957 7.09799 5.53957 6.75628 5.88128L3.25628 9.38128C2.91457 9.72299 2.91457 10.277 3.25628 10.6187L6.75628 14.1187C7.09799 14.4604 7.65201 14.4604 7.99372 14.1187C8.33543 13.777 8.33543 13.223 7.99372 12.8813L5.98744 10.875H16.125C16.6082 10.875 17 10.4832 17 10C17 9.51675 16.6082 9.125 16.125 9.125H5.98744L7.99372 7.11872C8.33543 6.77701 8.33543 6.22299 7.99372 5.88128Z" fill="#009FC6"/>
                    </svg> ' . ($options['back_to_all_news_button_text'] ? $options['back_to_all_news_button_text'] : 'Back To All News')
                );
            } else {
                $hero_headline = $options['no_search_results'] ? $options['no_search_results'] : 'No Results';
                $hero_description = '&nbsp;';
                $hero_search = false;
                $hero_breadcrumbs = array(
                    '/news/' => '<svg class="first-arrow" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99372 5.88128C7.65201 5.53957 7.09799 5.53957 6.75628 5.88128L3.25628 9.38128C2.91457 9.72299 2.91457 10.277 3.25628 10.6187L6.75628 14.1187C7.09799 14.4604 7.65201 14.4604 7.99372 14.1187C8.33543 13.777 8.33543 13.223 7.99372 12.8813L5.98744 10.875H16.125C16.6082 10.875 17 10.4832 17 10C17 9.51675 16.6082 9.125 16.125 9.125H5.98744L7.99372 7.11872C8.33543 6.77701 8.33543 6.22299 7.99372 5.88128Z" fill="#009FC6"/>
                    </svg> ' .( $options['back_to_all_news_button_text'] ? $options['back_to_all_news_button_text'] : 'Back To All News')
                );
            }

            // include partial
            include get_stylesheet_directory() . '/template-parts/blocks/partial/blog-hero.php';

            if ($search_results) {
                ?>
                <div class="news-archive-articles">
                    <?php
    
                    foreach ($search_posts AS $sp) {
                        $npost = $sp;
                        include get_stylesheet_directory() . '/template-parts/blocks/partial/news-card-regular.php';
                    }
    
                    ?>
                </div>
                <button id="view-more" class="btn-white-blue view-more"><?php echo $view_more_button_text; ?></button>
                <?php
             }

         } else {

            // no search value was sent via get
            $hero_headline = $options['no_search_results'] ? $options['no_search_results'] : 'No Results';
            $hero_description = '&nbsp;';
            $hero_search = false;
            $hero_breadcrumbs = array(
                '/news/' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99372 5.88128C7.65201 5.53957 7.09799 5.53957 6.75628 5.88128L3.25628 9.38128C2.91457 9.72299 2.91457 10.277 3.25628 10.6187L6.75628 14.1187C7.09799 14.4604 7.65201 14.4604 7.99372 14.1187C8.33543 13.777 8.33543 13.223 7.99372 12.8813L5.98744 10.875H16.125C16.6082 10.875 17 10.4832 17 10C17 9.51675 16.6082 9.125 16.125 9.125H5.98744L7.99372 7.11872C8.33543 6.77701 8.33543 6.22299 7.99372 5.88128Z" fill="#009FC6"/>
                </svg> ' .( $options['back_to_all_news_button_text'] ? $options['back_to_all_news_button_text'] : 'Back To All News')
            );

             // include partial
             include get_stylesheet_directory() . '/template-parts/blocks/partial/blog-hero.php';
         }

         
        the_content();

        

         ?>


         </div>

      </div>
   </div>
</main>

<?php
get_footer(); ?>

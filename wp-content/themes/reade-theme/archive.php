<?php 

$qo = get_queried_object();

if ($qo) {
   $cat_ID = get_queried_object()->term_id;
} else {
   $cat_ID = false;
}

$qobj = $qo;
$view_more_button_text = get_field('view_more_button_text', 'options') ? get_field('view_more_button_text', 'options') : 'View More';
get_header(); ?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">
         <article class="archive-default-content">

         <?php

         // set up variables for blog hero partial
         $hero_headline = $qobj->name;
         $hero_description = $qobj->description;
         $hero_search = true;
         $hero_breadcrumbs = array(
            '/news/' => '<svg class="first-arrow" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99372 5.88128C7.65201 5.53957 7.09799 5.53957 6.75628 5.88128L3.25628 9.38128C2.91457 9.72299 2.91457 10.277 3.25628 10.6187L6.75628 14.1187C7.09799 14.4604 7.65201 14.4604 7.99372 14.1187C8.33543 13.777 8.33543 13.223 7.99372 12.8813L5.98744 10.875H16.125C16.6082 10.875 17 10.4832 17 10C17 9.51675 16.6082 9.125 16.125 9.125H5.98744L7.99372 7.11872C8.33543 6.77701 8.33543 6.22299 7.99372 5.88128Z" fill="#009FC6"/>
            </svg> All News'
         );


         // include blog hero partial
         include 'template-parts/blocks/partial/blog-hero.php';

         ?>

         <div class="news-archive-articles">
            <?php

            $posts = get_posts(array('status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'numberposts' => '-1', 'category' => $cat_ID));

            if (!empty($posts)) {

               foreach ($posts AS $art) {
                  $npost = $art;
                  include 'template-parts/blocks/partial/news-card-regular.php';
               }

            } else {
               ?>
               <p><?php echo get_field('no_posts_found', 'options') ? get_field('no_posts_found', 'options') : 'Sorry, no posts were found.'; ?></p>
               <?php
            }

            ?>
         </div>

         <button id="view-more" class="btn-white-blue view-more"><?php echo $view_more_button_text; ?></button>


         <?php include( locate_template( 'template-parts/blocks/primary-footer-cta.php', false, false, $args = get_fields($qobj) ?: array()) );  ?>
         













            
         </article>
      </div>
   </div>
</main>
<?php

$fields = get_fields($qobj);
get_footer(); ?>

<?php get_header(); ?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">
         <article class="search-results--page-content">
            <div class="grid grid-cols-3 gap-4">
            <?php
            while( have_posts() ) { the_post(); ?>
               <div class="search-result--entry">
                  <h2>
                     <?php the_title(); ?>
                  </h2>
               </div>
            <?php } ?>
            </div>
         </article>
      </div>
   </div>
</main>

<?php get_footer(); ?>

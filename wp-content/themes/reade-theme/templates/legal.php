<?php /* Template Name: Legal */
get_header(); ?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">

         <div class="page-legal-hero">
            <h1><?php echo $post->post_title; ?></h1>
            <?php

            $fields = get_fields();

            if (!empty($fields['effective_date'])) {
               ?>
               <p class="last__updated"><?php echo $fields['effective_date']; ?></p>
               <?php
            } else {
               ?>
               <p class="last__updated"><?php echo __("Last Updated:", 'reade-themepnpm');?> <time><?php echo date('F j, Y', strtotime($post->post_modified)); ?></time></p>
               <?php
            }

            ?>
         </div>
         <div class="page-legal-content--container">
            <article class="page-legal-content--article">
               <!-- <aside class="in-page-nav-desktop"> <nav> </nav> </aside> -->
               <aside class="in-page-nav psuedo-select">
                  <p class="psuedo-select-active">
                     <span><?php echo __("Select", TEXTDOMAIN);?></span>
                     <svg class="svg-arrow-down" aria-hidden="true" width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M0.519284 0.965493C0.28888 1.17537 0.272236 1.53228 0.482109 1.76269L5.25031 6.99734C5.35724 7.11473 5.50869 7.18164 5.66749 7.18164C5.82629 7.18164 5.97774 7.11473 6.08467 6.99734L10.8529 1.76268C11.0627 1.53228 11.0461 1.17537 10.8157 0.965492C10.5853 0.755619 10.2284 0.772263 10.0185 1.00267L5.66749 5.77932L1.31648 1.00267C1.1066 0.772264 0.749688 0.75562 0.519284 0.965493Z" fill="#004455"/> </svg>
                  </p>
                  <nav class="pseudo-select-nav">
                     <ul class="pseudo-select-menu--list"></ul>
                  </nav>
               </aside>
               <div class="page-legal-content--wrap">
                  <?php the_content(); ?>
               </div>
            </article>
         </div>
      </div>
   </div>
   <svg aria-hidden="true" width="170" height="224" viewBox="0 0 170 224" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M19.2041 44.916L93.8502 1L168.398 44.916L93.8083 88.832V185.673L19.2041 141.771V44.916ZM19.2041 44.916L93.8083 88.832L168.398 44.916V141.771L93.8083 185.673" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/> <path d="M0.999025 148.318L40.1267 125.298L79.2031 148.318L40.1047 171.337V222.099L0.999025 199.087V148.318ZM0.999025 148.318L40.1047 171.337L79.2031 148.318V199.087L40.1047 222.099" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/> </svg>
</main>

<?php
get_footer(); ?>

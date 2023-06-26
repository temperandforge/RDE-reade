<?php /* Template Name: Legal */
get_header(); ?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="inner-wrap">

         <div class="page-legal-hero">
            <h1><?php echo $post->post_title; ?></h1>
            <p class="last__updated"><?php echo __("Last Updated:", 'reade-themepnpm');?> <time><?php echo date('F j, Y', strtotime($post->post_modified)); ?></time></p>
         </div>
         <div class="page-legal-content--container">
            <article class="page-legal-content--article">
               <!-- <aside class="in-page-nav-desktop"> <nav> </nav> </aside> -->
               <aside class="in-page-nav psuedo-select">
                  <p class="psuedo-select-active">
                     <span><?php echo __("Select", TEXTDOMAIN);?></span>
                     <svg class="svg-arrow-down" aria-hidden="true" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M12.5195 9.18821L8.36096 13.3468M8.36096 13.3468L4.2024 9.18821M8.36096 13.3468L8.36097 2.65332" stroke="#6A6EFF" stroke-width="1.27558" stroke-linecap="round" stroke-linejoin="round"/> </svg>
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

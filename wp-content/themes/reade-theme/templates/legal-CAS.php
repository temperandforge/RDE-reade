<?php /* Template Name: Legal CAS */
get_header(); ?>

<main id="main-content" class="main-content-wrap">
   <div class="main">
      <div class="inner-wrap">

<h1><?php echo $post->post_title; ?></h1>
<p class="last__updated">Last Updated: <time><?php echo date('F j, Y', strtotime($post->post_modified)); ?></time></p>
<div class="legal-content-wrap">
   
   <aside class="in-page-nav-desktop">
      <nav>
      </nav>
   </aside>
   <aside class="in-page-nav-mobile psuedo-select">
      <p class="psuedo-select-active flex font-medium items-center justify-between mb-0 text-primary">
         <span>Sub Section 1</span>
         <svg clas="arrow-down ml-2" aria-hidden="true" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M12.5195 9.18821L8.36096 13.3468M8.36096 13.3468L4.2024 9.18821M8.36096 13.3468L8.36097 2.65332" stroke="#6A6EFF" stroke-width="1.27558" stroke-linecap="round" stroke-linejoin="round"/> </svg>
      </p>
      <nav>
      </nav>
   </aside>

   <article class="page-legal-content">
      <?php the_content(); ?>
   </article> 

</div>

      </div>
   </div>
</main>

<?php
get_footer(); ?>
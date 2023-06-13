<?php /* Template Name: Legal */

$fields = get_fields(); 

get_header(); ?>

<main id="main_content" class="main-content-wrap">
   <div class="main">
      <div class="inner-wrap">
         <article class="page-legal-content">
            <h1><?php echo __($post->post_title, TEXTDOMAIN); ?></h1>
            <!-- //TODO -->
            <p class="legal--last-updated"><?php echo __("Last Updated on: $post->post_modified", TEXTDOMAIN); ?></p>
            <div class="flex flex-col lg:flex-row-reverse">
               <aside class="legal-sidebar">
                  <p class="legal-sidebar-active"></p>
                  <nav class="in-page-nav"><ul></ul></nav>
               </aside>
               <div>
                  <?php the_content(); ?>
               </div>
            </div>
         </article>
      </div>
   </div>
</main>

<?php
//loop
get_footer(); ?>

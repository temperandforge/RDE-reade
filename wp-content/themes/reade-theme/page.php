<?php 
$fields = get_fields(); 

get_header(); ?>

<main id="main_content" class="main-content-wrap">
   <div class="main">
      <div class="inner-wrap">
         <article class="page-default-content">
            <?php the_content(); ?>
         </article>
      </div>
   </div>
</main>

<?php
//loop
get_footer(); ?>

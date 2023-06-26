<?php 

$fields = get_fields(); 

get_header(); ?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="inner-wrap">
         <article class="page-default-content">
            <?php //_e(get_the_content(), TEXTDOMAIN); ?>
            <?php the_content(); ?>
         </article>
      </div>
   </div>
</main>

<?php
//loop
get_footer(); ?>

<?php 
define ('WPLANG', 'fr_FR');

$fields = get_fields(); 

get_header(); ?>

<main id="main_content" class="main-content-wrap">
   <div class="main">
      <div class="inner-wrap">
         <article class="page-default-content">
            <?php _e(get_the_content(), TEXTDOMAIN); ?>
         </article>
      </div>
   </div>
</main>

<?php
//loop
get_footer(); ?>

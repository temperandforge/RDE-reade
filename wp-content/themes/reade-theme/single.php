<?php 

$fields = get_fields();
$dec_image = get_field('single_decorative_image', 'options');
$fallback_image = get_field('article_fallback_image', 'options');
$related_posts_text = get_field('related_posts_text', 'options');

// $feat_img = get_post_thumbanil()

get_header(); ?>

<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">
         <article class="single-content">
            
            <?php

            setup_postdata(the_post());

            $single_cat = get_the_category();

            // set up variables for blog hero partial
            $hero_headline = get_the_title();
            $hero_description = false;
            $hero_search = false;
            $hero_breadcrumbs = array(
               '/news/' => 'All News',
               get_category_link($single_cat[0]->term_id) => $single_cat[0]->name
            );


            // include blog hero partial
            include 'template-parts/blocks/partial/blog-hero.php';

            ?>

            <div id="single-container" class="single-container">
               <?php
   
               if (!$dec_image) {
                  $dec_image = $fallback_image;
               }

               if ($dec_image) {
                  ?>
                  <img class="dec-image" src="<?php echo $dec_image['url']; ?>"
                     alt="<?php echo $dec_image['alt']; ?>"
                     width="<?php echo $dec_image['width']; ?>"
                     height="<?php echo $dec_image['height']; ?>"
                  ><?php 
               }

               ?>
               <div class="single-container-left">
                  <?php
                  include 'template-parts/single/share.php';
                  ?>
               </div>
               <div class="single-container-middle">
                  <p class="post-meta">
                     <?php echo date("M jS, Y", strtotime(get_the_date())); ?><br />
                     <?php if (!empty($fields['author'])) {
                        echo $fields['author'];
                     } ?>
                  </p>

                  <?php
                  if (get_the_post_thumbnail_url()) {
                     echo get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'single-featured-image'));
                  } else {
                     ?>
                     <img class="single-featured-image" src="<?php echo $fallback_image['url']; ?>"
                        alt="<?php echo $fallback_image['alt']; ?>"
                        width="<?php echo $fallback_image['width']; ?>"
                        height="<?php echo $fallback_image['height']; ?>"
                     >
                     <?php
                  }

                  ?>
                  <div id="single-news-content">
                     <?php the_content(); ?>
                  </div>
               </div>
               <div class="single-container-right">
                  <?php
                  include 'template-parts/single/aside-form.php';
                  ?>
               </div>
            </div>

            <div class="single-related-posts">
               <?php
               $args = array(
                  'numberposts' => 3,
                  'category'    => $single_cat[0]->term_id,
                  'post_status' => 'publish',
                  'orderby'     => 'date',
                  'order'       => 'DESC',
                  'post__not_in' => array(get_the_ID()),
               );

               $rposts = get_posts($args);

               if (count($rposts)) {
                  ?>
                  <div class="single-related-posts">
                     <h4 class="single-related-text"><?php echo $related_posts_text ? $related_posts_text : 'Related Posts:'; ?></h4>
                     <div class="single-related-post-container">
                        <?php

                        foreach ($rposts AS $npost) {
                           include 'template-parts/blocks/partial/news-card-regular.php';
                        }

                        ?>
                     </div>
                  </div>
                  <?php
               }
               ?>
            </div>
            
         </article>
      </div>
   </div>
</main>

<?php
//loop
get_footer(); ?>

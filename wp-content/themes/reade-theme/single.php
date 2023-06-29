<?php 

$fields = get_fields();
$dec_image = get_field('single_decorative_image', 'options');
$fallback_image = get_field('article_fallback_image', 'options');

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
                     <?php the_author(); ?>
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
            <!--
            <div class="single-hero">
               <div class="single-hero-img">
                  <?php echo get_the_post_thumbnail(); ?>
               </div>
               <div class="d-flex justify-content-between gap-5 align-items-end">
                  <div>
                     <h1 class="title is-2"><?php echo get_the_title(); ?></h1>
                     <?php 
                     $aid = $post->post_author;
                     if($first_name = get_the_author_meta('first_name', $aid)):
                        $author_name = $first_name . " " . get_the_author_meta('last_name', $aid); 
                        ?>
                        <p>Written by: <?php echo $author_name; ?></p>
                     <?php endif; ?>
                  </div>
                  <div class="single-social-share d-flex mb-3">
                     <p class="mr-4">Share:</p>
                     <?php include( locate_template('patterns/social-links.php', false, false, $args=['share'=>true]));?>
                  </div>
               </div>
            </div>
            <?php the_content(); ?>
            <?php if($fields['article_companies']): ?>
            <div class="companies-included">
               <p><?php echo get_field('included_companies_label','options')?:'Companies included in this article:';?></p>
            </div>
            <?php endif; ?>
            <?php if($author_name && $author_img = get_avatar($aid, 96, $author_name)): ?>
            <div class="author-about">
               <div class="d-flex align-items-center">
                  <?php echo $author_img; ?>
                  <div class="author-bio-wrap">
                     <p><?php echo $author_name; ?></p>
                     <?php if($bio = get_field('author_biodescr', 'user_'.$aid)): ?>
                        <p class="mb-0"><?php echo $bio; ?></p>
                     <?php endif; ?>
               </div>
            </div>
            <?php endif; ?>
            -->
         </article>
      </div>
   </div>
</main>

<?php
//loop
get_footer(); ?>

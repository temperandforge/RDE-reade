<?php 
//$fields = get_fields(); 

$cat_ID = get_queried_object()->term_id;
//TODO pagination, category
$featured = get_posts([
   'post_type'      => 'resource',
   'post_status'    => 'publish',
   'posts_per_page' => -1,
   'category'       => $cat_ID,
   'post__in'       => get_option( 'sticky_posts' ),
]);
$remaining = get_posts([
   'post_type'      => 'resource',
   'post_status'    => 'publish',
   'posts_per_page' => -1,
   'category'       => $cat_ID,
   'post__not_in'       => get_option( 'sticky_posts' ),
]);

get_header(); ?>
<main id="main_content" class="main-content-wrap">
   <div class="main">
      <div class="inner-wrap">
         <article class="archive-default-content">
            <h2 class="title is-3"><?php echo get_queried_object()->name; ?></h2>
            <!-- dropdown -->
            <h3 class="title is-4">Featured:</h3>
            <div class="archive-post-wrap">
            <?php foreach($featured as $p): ?>
               <div class="archive-post">
                  <div class="archive-post-img">
                     <svg class="svg-paperclip" aria-hidden="true" width="50" height="51" viewBox="0 0 50 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="25" cy="25.5" r="24" stroke="white" stroke-width="2"/>
                        <path d="M27.1085 13.3501C29.7433 13.3501 31.8793 15.4861 31.8793 18.1209V30.7708C31.8793 34.57 28.7994 37.6499 25.0002 37.6499C21.201 37.6499 18.1211 34.57 18.1211 30.7708V22.8375H19.2294V30.7708C19.2294 33.9579 21.8131 36.5416 25.0002 36.5416C28.1873 36.5416 30.771 33.9579 30.771 30.7708V18.1209C30.771 16.0982 29.1312 14.4584 27.1085 14.4584C25.0858 14.4584 23.446 16.0982 23.446 18.1209V30.7708C23.446 31.6291 24.1419 32.3249 25.0002 32.3249C25.8585 32.3249 26.5544 31.6291 26.5544 30.7708V19.675H27.6627V30.7708C27.6627 32.2412 26.4706 33.4332 25.0002 33.4332C23.5298 33.4332 22.3377 32.2412 22.3377 30.7708V18.1209C22.3377 15.4861 24.4737 13.3501 27.1085 13.3501Z" fill="#003C71" stroke="white"/>
                     </svg>
                  </div>
                  <div class="archive-post-content">
                     <h3 class="title"><?php the_title();?></h3>
                     <a href="" class="btn">View</a>
                  </div>
               </div>
            <?php endforeach; ?>
            </div>
         </article>
      </div>
   </div>
</main>
<?php
//loop
get_footer(); ?>
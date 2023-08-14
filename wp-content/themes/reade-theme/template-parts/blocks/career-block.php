<?php

$post_type = 'careers';
$career_posts = [];
if(is_single()) {
   global $post;
   $post_type = $post_type;
} else {
   $fields = get_fields() ?: [];
   if(array_key_exists('careers', $fields) && $fields['careers']) {
      $career_posts = $fields['careers'];
   }
}

// if(!$career_posts) {
//    global $wp_query; 
//    $wp_query = new WP_Query([
//       'orderby'        => 'date',
//       'order'          => 'ASC',
//       'post_type'      => $post_type,
//       'posts_per_page' => -1,
//       'post_status'    => 'publish',
//       'posts__not_in'  => [get_the_ID()],
//    ]);
//    $career_posts = $wp_query->posts;
// }

?>

<div class="career-block--section">
 <div class="career-block--main">
  <div class="career-block--inner">
   <?php if(!empty($fields['heading']) || !empty($fields['content'])) :?>
    <div class="career-block--heading">
     <?php if(!empty($fields['heading'])) :?>
      <h2><?php echo $fields['heading'] ;?></h2>
     <?php endif ;?>
     <?php if(!empty($fields['content'])) :?>
      <p><?php echo $fields['content'] ;?></p>
     <?php endif ;?>
     <?php if(empty($career_posts)) :?>
      <p><strong>There are no positions currently available at this time. Contact us for more information</strong></p>
      <a 
      href="mailto:"
      target="_target"
      class="btn-blue-dark-blue btn-arrow">
       <span>Contact</span>
       <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.36956C12.348 6.02785 12.902 6.02785 13.2437 6.36956L16.7437 9.86956C17.0854 10.2113 17.0854 10.7653 16.7437 11.107L13.2437 14.607C12.902 14.9487 12.348 14.9487 12.0063 14.607C11.6646 14.2653 11.6646 13.7113 12.0063 13.3696L14.0126 11.3633H3.875C3.39175 11.3633 3 10.9715 3 10.4883C3 10.005 3.39175 9.61328 3.875 9.61328H14.0126L12.0063 7.607C11.6646 7.26529 11.6646 6.71127 12.0063 6.36956Z" fill="#FAFAFA"/>
       </svg>
      </a>
     <?php endif ;?>
    </div>
   <?php endif ;?>

   <?php if(!empty($career_posts)) :?>
    <div class="career-block--slider">
     <?php foreach($career_posts as $job) :?>
      <div class="career-block--slide<?php echo (count($career_posts) == 1) ? ' solo-slide' : null ;?>">
       <div class="career-block--job">
        <div class="career-block--content">
         <h3><?php echo $job->post_title ;?></h3>
         <p><?php echo  $job->post_excerpt;?></p>
         <a href="<?php echo get_permalink($job->ID) ;?>" class="btn-blue-dark-blue btn-arrow">
          <span>View Position</span>
          <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
           <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.36956C12.348 6.02785 12.902 6.02785 13.2437 6.36956L16.7437 9.86956C17.0854 10.2113 17.0854 10.7653 16.7437 11.107L13.2437 14.607C12.902 14.9487 12.348 14.9487 12.0063 14.607C11.6646 14.2653 11.6646 13.7113 12.0063 13.3696L14.0126 11.3633H3.875C3.39175 11.3633 3 10.9715 3 10.4883C3 10.005 3.39175 9.61328 3.875 9.61328H14.0126L12.0063 7.607C11.6646 7.26529 11.6646 6.71127 12.0063 6.36956Z" fill="#FAFAFA"/>
          </svg>
         </a>
        </div>
       </div>
      </div>
     <?php endforeach ; wp_reset_query(); ?>
    </div>
   <?php endif ;?>

   <?php if(count($career_posts) >= 3) :?>
    <div class="career-block--nav">
     <div class="career-block--dots"></div>
     <div class="career-block--arrows"></div>
    </div>
    <?php endif ;?>
  </div>
 </div>
</div>
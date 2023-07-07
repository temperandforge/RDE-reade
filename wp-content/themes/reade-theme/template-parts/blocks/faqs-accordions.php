<?php 

$post_type = 'faqs';
$recommended_posts = [];
if(is_single()) {
   global $post;
   $post_type = $post_type;
} else {
   $fields = get_fields() ?: [];
   if(array_key_exists('faqs', $fields) && $fields['faqs']) {
      $recommended_posts = $fields['faqs'];
   }
}

if(!$recommended_posts) {
   global $wp_query; 
   $wp_query = new WP_Query([
      'orderby'        => 'date',
      'order'          => 'ASC',
      'post_type'      => $post_type,
      'posts_per_page' => -1,
      'post_status'    => 'publish',
      'posts__not_in'  => [get_the_ID()],
   ]);
   $recommended_posts = $wp_query->posts;
}

?>

<div class="faqs-accordion--section">
 <ul class="faq-list">
  <?php foreach($recommended_posts as $post) :
  $question = $post->post_title;
  $answer = get_post_field('post_content', $post->ID);
  $link = get_field('link', $post->ID);
  ?>
  <li class="faq-accordion">
   <button class="accordion-btn" aria-expanded="false">
    <strong><?php echo $question; ?></strong>
   </button>
   <div class="accordion-answer" aria-hidden="true" >
    <?php echo $answer; ?>
    <?php if(!empty($link)) :?>
     <a 
     class="faq-btn" 
     href="<?php echo $link['url'] ;?>"
     target="<?php echo $link['target'] ?: '_self' ;?>"><?php echo $link['title'] ;?></a>
     <?php endif ;?>
    </div>
  </li>
  <?php endforeach; wp_reset_postdata(); ?>
 </ul>
</div>
<?php

$fields = get_fields();

?>

<div class="position-hero--section">
 <div class="position-hero--main">
  <div class="position-hero--inner">
   <div class="position-hero--wrap">
    <div class="position-hero--heading">
     <a 
      href="/about-us/careers/"
      target="_self"
      class="position-btn">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
       <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99372 5.88128C7.65201 5.53957 7.09799 5.53957 6.75628 5.88128L3.25628 9.38128C2.91457 9.72299 2.91457 10.277 3.25628 10.6187L6.75628 14.1187C7.09799 14.4604 7.65201 14.4604 7.99372 14.1187C8.33543 13.777 8.33543 13.223 7.99372 12.8813L5.98744 10.875H16.125C16.6082 10.875 17 10.4832 17 10C17 9.51675 16.6082 9.125 16.125 9.125H5.98744L7.99372 7.11872C8.33543 6.77701 8.33543 6.22299 7.99372 5.88128Z" fill="#009FC6"/>
      </svg>
      <span>Back to Careers</span>
     </a>
     <h1><?php echo (!empty($fields['heading'])) ? $fields['heading'] : get_the_title() ;?></h1>
    </div>
    <?php if(!empty($fields['content'])) :?>
     <div class="position-hero--content">
      <?php echo $fields['content'] ;?>
     </div>
    <?php endif ;?>
    <?php if(($fields['include_featured_image'])) :?>
     <figure class="position-hero--figure">
      <?php echo get_the_post_thumbnail() ;?>
     </figure>
    <?php endif ;?>
   </div>
   <?php if($fields['icon'] != 'no-svg') :?>
    <div class="position-hero--decor <?php echo $fields['icon'] ;?>" aria-hidden="true"></div>
   <?php endif ;?>
  </div>
 </div>
</div>
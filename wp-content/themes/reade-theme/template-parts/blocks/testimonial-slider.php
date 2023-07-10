<?php

$fields = get_fields();
if(IS_LOCAL) {
echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
}

?>

<div class="testimonial-slider--section">
 <div class="testimonial-slider--main">
  <div class="testimonial-slider--inner">
   <div class="testimonial-slider--wrap">
    <div class="testimonial-slider--slider">
     <?php foreach($fields['testimonials'] as $testimonial) :?>
      <div class="testimonial-slider--slide">
       <div class="testimonial-slider--info">
        <span class="sr-only">Here is a quote from: </span>
        <p><strong><?php echo $testimonial['name'] ;?></strong></p>
        <?php if(!empty($testimonial['company'])) :?>
         <p><?php echo $testimonial['company'] ;?></p>
        <?php endif ;?>
       </div>
       <div class="testimonial-slider--quote">
        <p>"<?php echo $testimonial['quote'] ;?>"</p>
       </div>
      </div>
     <?php endforeach ;?>
    </div>
    <div class="testimonial-slider--nav">
     <div class="testimonial-slider--arrows">        
      <button class="slick-prev-arrow" aria-label="Previous">
         <span class="sr-only">Previous slide</span>
         <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8.91319 16.1227L3.46875 10.6782M3.46875 10.6782L8.91319 5.23379M3.46875 10.6782L17.4687 10.6782" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
         </svg>
        </button>
        <button class="slick-next-arrow" aria-label="Next">
         <span class="sr-only">Next slide</span>
         <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12.0868 5.23376L17.5313 10.6782M17.5313 10.6782L12.0868 16.1227M17.5313 10.6782L3.53125 10.6782" stroke="white" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
         </svg>
        </button>
       </div>
     <div class="testimonial-slider--dots"></div>
    </div>
   </div>
  </div>
 </div>
</div>
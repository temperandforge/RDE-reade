<?php

$fields = get_fields();

?>

<div class="industry-slider--section">
 <div class="industry-slider--main">
  <div class="industry-slider--inner">
   <div class="industry-slider--wrap">
    <?php if((!empty($fields['heading'])) || (!empty($fields['content']))) :?>
     <div class="industry-slider--heading">
      <?php if(!empty($fields['heading'])) :?>
       <h2><?php echo $fields['heading'] ;?></h2>
      <?php endif ;?>
      <?php if(!empty($fields['content'])) :?>
       <p><?php echo $fields['content'] ;?></p>
      <?php endif ;?>
     </div>
    <?php endif ;?>

    <div class="industry-slider--slider">
     <?php foreach($fields['items'] as $item) :?>
      <div class="industry-slider--item">
       <div class="industry-slider--content">
        <?php if(!empty($item['heading'])) :?>
         <h3><?php echo $item['heading'] ;?></h3>
        <?php endif ;?>
        <?php if(!empty($item['content'])) :?>
         <p><?php echo $item['content'] ;?></p>
        <?php endif ;?>
       </div>
      </div>
     <?php endforeach ;?>
    </div>
    <?php foreach($fields['items'] as $index=>$item) :
     $totalItems = count($fields['items'])?>
     <?php if($index === 0) :?>
      <div class="industry-slider--nav" <?php if($totalItems <= 6) :?>
       style="display: none;" aria-hidden="true"
      <?php endif ;?>>
       <div class="industry-slider--dots"></div>
       <div class="industry-slider--arrows">
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
      </div>
     <?php endif ;?>
    <?php endforeach ;?>
   </div>
  </div>
 </div>
</div>


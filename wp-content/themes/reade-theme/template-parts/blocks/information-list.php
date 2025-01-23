<?php

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = get_fields() ?: []) {
?>



<?php 
} ?>


<?php

$fields = get_fields();

?>

<div class="information-list--section section-full"
   style="
      <?php if( $pt = $fields['padding-row']['padding-top'] ): ?>
         padding-top: <?php echo $fields['padding-row']['padding-top'].'em;'; ?>
      <?php endif; ?>
      <?php if( $pb = $fields['padding-row']['padding-bottom'] ): ?>
         padding-bottom: <?php echo $fields['padding-row']['padding-bottom'].'em;'; ?>
      <?php endif; ?>
      <?php if( $fields['background_color'] ): ?>
         background-color: <?php echo $fields['background_color']; ?>
      <?php endif; ?>
   ">
 <div class="information-list--main theme-main">
  <div class="information-list--inner">
   <div class="information-list--wrap">
    <?php if((!empty($fields['heading'])) || (!empty($fields['content']))) :?>
     <div class="information-list--heading">
      <?php if(!empty($fields['heading'])) :?>
       <h1><?php echo $fields['heading'] ;?></h1>
      <?php endif ;?>
      <?php if(!empty($fields['content'])) :?>
       <p><?php echo $fields['content'] ;?></p>
      <?php endif ;?>
     </div>
    <?php endif ;?>

    <div class="information-list--slider">
    <?php foreach($fields['bullet_point_list_items'] as $item) :
        if (!empty($item['bullet_point_title']) && !empty($item['bullet_point'])) {
            ?>
            <div class="information-list--item">
               <div class="bullet"></div>
                <div class="information-list--content">
                    <?php if(!empty($item['bullet_point_title'])) :?>
                        <p class="information-list--tile-heading"><?php echo $item['bullet_point_title'] ;?></p>
                    <?php endif ;?>
                    <?php if(!empty($item['bullet_point'])) :?>
                        <p><?php echo $item['bullet_point'] ;?></p>
                    <?php endif ;?>
                </div>
            </div>
            <?php
        }
    endforeach ;?>
    
    </div>
    <?php


    $totalItems = 0;

    foreach ($fields['bullet_point_list_items'] AS $index => $item) {
        if (!empty($item['bullet_point_title']) && !empty($item['bullet_point'])) {
            $totalItems++;
        }
    }

    foreach($fields['bullet_point_list_items'] as $index=>$item) :

     if($index === 0) :?>
      <div class="information-list--nav" <?php if($totalItems <= 6) :?>
       style="display: none;" aria-hidden="true"
      <?php endif ;?>>
       <div class="information-list--dots"></div>
       <div class="information-list--arrows">
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


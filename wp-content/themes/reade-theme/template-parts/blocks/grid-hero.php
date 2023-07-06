<?php

$fields = get_fields();

?>

<div class="grid-hero--section">
 <div class="grid-hero--wrap">
  <div class="grid-hero--inner">
   <?php if(!empty($fields['image'])) :?>
    <figure class="grid-hero--figure">
     <?php echo wp_get_attachment_image( $fields['image']['ID'], 'full' ); ;?>
    </figure>
   <?php endif ;?>
   <div class="grid-hero--content">
    <?php if($fields['heading']) :?>
     <h1><?php echo $fields['heading'] ;?></h1>
    <?php endif ;?>
    <?php if($fields['content']) :?>
     <p><?php echo $fields['content'] ;?></p>
    <?php endif ;?>
    <svg class="box-svg" width="170" height="224" viewBox="0 0 170 224" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
     <path d="M19.2041 44.916L93.8502 1L168.398 44.916L93.8083 88.832V185.673L19.2041 141.771V44.916ZM19.2041 44.916L93.8083 88.832L168.398 44.916V141.771L93.8083 185.673" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
     <path d="M0.999025 148.318L40.1267 125.298L79.2031 148.318L40.1047 171.337V222.099L0.999025 199.087V148.318ZM0.999025 148.318L40.1047 171.337L79.2031 148.318V199.087L40.1047 222.099" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round"/>
    </svg>
   </div>
  </div>
 </div>
</div>
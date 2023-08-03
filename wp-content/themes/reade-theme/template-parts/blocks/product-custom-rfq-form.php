<?php

$fields = get_fields();

?>

<div class="rfq-form--section">
 <div class="rfq-form--main">
  <div class="rfq-form--inner">
   <div class="rfq-form--wrap">
    <?php if((!empty($fields['heading'])) || (!empty($fields['content']))) :?>
     <div class="rfq-form--heading">
      <?php if(!empty($fields['heading'])) :?>
       <h2><?php echo $fields['heading'] ;?></h2>
      <?php endif ;?>
      <?php if(!empty($fields['content'])) :?>
       <p><?php echo $fields['content'] ;?></p>
      <?php endif ;?>
     </div>
    <?php endif ;?>
    <div class="rfq-form--form">
     <?php echo do_shortcode($fields['form_code']); ?>
     <?php if($fields['icon'] != 'no-svg') :?>
      <div class="rfq-form--decor <?php echo $fields['icon'] ;?>" aria-hidden="true"></div>
     <?php endif ;?>
    </div>
    <?php if(!empty($fields['image'])) :?>
     <div class="rfq-form--image">
      <figure>
       <?php echo wp_get_attachment_image( $fields['image']['ID'], 'full' );?>
      </figure>
     </div>
    <?php endif ;?>
   </div>
  </div>
 </div>
</div>


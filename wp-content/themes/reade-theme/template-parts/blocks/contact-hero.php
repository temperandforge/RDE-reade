<?php

$fields = get_fields();

?>

<div class="contact-hero--section">
 <div class="contact-hero--wrap">

  <figure class="contact-hero--figure">
   <?php echo wp_get_attachment_image( $fields['image']['ID'], 'full' );?>
  </figure>
  <div class="contact-hero--content">
   <?php if(!empty($fields['heading'])) :?>
    <h1><?php echo $fields['heading'] ;?></h1>
   <?php endif ;?>
   <?php if(!empty($fields['content'])) :?>
    <p><?php echo $fields['content'] ;?></p>
   <?php endif ;?>
  </div>
  
 </div>
</div>
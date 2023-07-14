<?php

if($fields = get_fields()): 

?>

<div class="call-to-action">
   <div class="call-to-action-content">
   </div>
   <div class="call-to-action-img">
      <picture>
         <?php echo wp_get_attachment_image($fields['img']['ID'], [2048,2048], false, ['role'=>'presentation']); ?>
      </picture>
   </div>
</div>

<?php endif;?>
<?php

$fields = get_fields();
if(IS_LOCAL) {
echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
}

?>

<div class="contact-form--section">
 <div class="contact-form--wrap">
  <?php if(($fields['heading']) || (!empty($fields['content']))) :?>
   <div class="contact-form--heading">
    <?php if($fields['heading']) :?>
     <h2><?php echo $fields['heading'] ;?></h2>
    <?php endif ;?>
    <?php if($fields['content']) :?>
     <p><?php echo $fields['content'] ;?></p>
    <?php endif ;?>
   </div>
  <?php endif ;?>
  <div class="contact-form--form">
   <?php if($fields['form_code']): ?>
    <?php echo do_shortcode($fields['form_code']); ?>
   <?php endif ;?>
  </div>
 </div>
</div>


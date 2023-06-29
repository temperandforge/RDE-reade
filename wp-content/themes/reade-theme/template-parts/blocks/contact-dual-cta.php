<?php

$fields = get_fields();
if(IS_LOCAL) {
echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
}

?>

<div class="contact-dual-cta--section">
 <div class="contact-dual-cta--wrap">
  <div class="contact-dual-cta--inner">
   <?php foreach($fields['ctas'] as $index=>$cta) :?>
    <div class="contact-dual-cta--single">
     <?php if(!empty($cta['heading'])) :?>
      <h2
      class="<?php echo (empty($cta['content'])) ? 'heading-solo' : null ;?>"
      ><?php echo $cta['heading'] ;?></h2>
     <?php endif ;?>
     <?php if(!empty($cta['content'])) :?>
      <p><?php echo $cta['content'] ;?></p>
     <?php endif ;?>
     <?php if(!empty($cta['link'])) :?>
      <a href="<?php echo $cta['link']['url'] ;?>" class="dual-cta-btn"><?php echo $cta['link']['title'] ;?></a>
     <?php endif ;?>
    </div>
   <?php endforeach ;?>
  </div>
 </div>
</div>

<?php

$fields = get_fields();

?>

<div class="sustainable-dual-cta--section <?php echo $fields['background_color'] ;?> <?php echo $fields['background_texture'] == 'none' ? null : $fields['background_texture'] ;?>">
 <div class="sustainable-dual-cta--wrap">
  <div class="sustainable-dual-cta--inner">
   <?php foreach($fields['ctas'] as $cta) :?>
    <div class="sustainable-dual-cta--cta">
     <div class="sustainable-dual-cta--content">
      <?php if(!empty($cta['heading'])) :?>
       <h2><?php echo $cta['heading'] ;?></h2>
      <?php endif ;?>
      <?php if(!empty($cta['content'])) :?>
       <p><?php echo $cta['content'] ;?></p>
      <?php endif ;?>
      <?php if(!empty($cta['link'])) :?>
       <a 
       href="<?php echo $cta['link']['title'] ;?>"
       class="sustainable-btn"
       target="<?php echo $cta['link']['target'] ?: '_self' ;?>"><?php echo $cta['link']['title'] ;?></a>
      <?php endif ;?>
     </div>
    </div>
   <?php endforeach ;?>
  </div>
 </div>
</div>
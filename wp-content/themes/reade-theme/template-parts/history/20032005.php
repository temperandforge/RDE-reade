<div id="history-0305" class="historical-event panel">
 <h3 class=""><?php echo __($fields['events'][10]['heading'], TEXTDOMAIN);?></h3>  
 <?php if(!empty($fields['events'][10]['image'])) :?>
  <figure>
   <?php echo wp_get_attachment_image($fields['events'][10]['image']['id'], 'full', ) ;?>
  </figure>
<?php endif ;?>
 <div class="history-content">
  <h2><?php echo __($fields['events'][10]['year_display'], TEXTDOMAIN);?></h2>
  <div class="history-content--info"><?php echo __($fields['events'][10]['content'], TEXTDOMAIN);?></div>
 </div>
</div>
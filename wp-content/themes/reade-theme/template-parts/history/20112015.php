<div id="history-1115" class="historical-event panel">
 <h3 class=""><?php echo __($fields['events'][11]['heading'], TEXTDOMAIN);?></h3>  
 <?php if(!empty($fields['events'][11]['image'])) :?>
  <figure>
   <?php echo wp_get_attachment_image($fields['events'][11]['image']['id'], 'full', ) ;?>
  </figure>
<?php endif ;?>
 <div class="history-content">
  <h2><?php echo __($fields['events'][11]['year_display'], TEXTDOMAIN);?></h2>
  <div class="history-content--info"><?php echo __($fields['events'][11]['content'], TEXTDOMAIN);?></div>
 </div>
</div>
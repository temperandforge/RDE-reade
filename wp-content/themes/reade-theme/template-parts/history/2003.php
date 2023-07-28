<div id="history-2003" class="historical-event panel">
 <h3 class=""><?php echo __($args['heading'], TEXTDOMAIN);?></h3>  
 <?php if(!empty($args['image'])) :?>
  <figure>
   <?php echo wp_get_attachment_image($args['image']['id'], 'full', ) ;?>
  </figure>
<?php endif ;?>
 <div class="history-content">
  <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
  <div class="history-content--info"><?php echo __($args['content'], TEXTDOMAIN);?></div>
 </div>
</div>
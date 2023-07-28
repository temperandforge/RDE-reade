<div id="history-1989" class="historical-event panel">
 <div class="history-content">
  <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
  <h3 class=""><?php echo __($args['heading'], TEXTDOMAIN);?></h3>  
  <div class="history-content--info"><?php echo __($args['content'], TEXTDOMAIN);?></div>
 </div>
 <?php if(!empty($args['image'])) :?>
  <figure>
   <?php echo wp_get_attachment_image($args['image']['id'], 'full', ) ;?>
  </figure>
<?php endif ;?>
</div>
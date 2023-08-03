<div id="history-1905" class="historical-event panel">
  <?php if(!empty($args['image'])) :?>
  <figure>
   <?php echo wp_get_attachment_image($args['image']['id'], 'full', ) ;?>
  </figure>
  <?php endif ;?>
  <div class="history-content">
   <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
   <div class="history-content--info"><?php echo __($args['content'], TEXTDOMAIN);?></div>
   <h3 class=""><?php echo __($args['heading'], TEXTDOMAIN);?></h3>  
  </div>
  <div id="historySVG3" aria-hidden="true"></div>
</div>
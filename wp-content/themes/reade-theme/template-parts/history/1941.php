<div id="history-1941" class="historical-event panel">
  <?php if(!empty($args['image'])) :?>
   <div class="history-figure">
    <figure>
     <?php echo wp_get_attachment_image($args['image']['id'], 'full', ) ;?>
    </figure>
   </div>
  <?php endif ;?>
  <div class="history-content">
   <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
   <h3 class=""><?php echo __($args['heading'], TEXTDOMAIN);?></h3>  
   <div class="history-content--info"><?php echo __($args['content'], TEXTDOMAIN);?></div>
  </div>
</div>
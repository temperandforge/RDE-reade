<div id="history-2018" class="historical-event panel">
   <div class="history-content">
      <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
      <div class="max-w-md"><?php echo __($args['content'], TEXTDOMAIN);?></div>
   </div>
   <?php if(!empty($args['image'])) :?>
      <figure class="primary-figure">
         <?php echo wp_get_attachment_image($args['image']['id'], 'full', ) ;?>
      </figure>
   <?php if(!empty($args['secondary_image'])) :?>
      <figure class="secondary-figure">
         <?php echo wp_get_attachment_image($args['secondary_image']['id'], 'full', ) ;?>
      </figure>
   <?php endif ;?>
   <?php endif ;?>
   <h3 class="mt-4"><?php echo __($args['heading'], TEXTDOMAIN);?></h3>
</div>

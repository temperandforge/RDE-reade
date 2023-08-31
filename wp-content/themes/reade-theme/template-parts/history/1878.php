<div id="history-1878" class="historical-event panel">
      <?php if(!empty($args['image'])) :?>
         <figure>
            <?php echo wp_get_attachment_image($args['image']['id'], 'full') ;?>
         </figure>
      <?php endif ;?>
      <div class="history-content">
         <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
         <div class="history-content--info">
            <h3><?php echo __($args['heading'], TEXTDOMAIN);?></h3>
            <div class="max-w-full"><?php echo __($args['content'], TEXTDOMAIN);?></div>
         </div>
      </div>
      <div id="historySVG1" aria-hidden="true"></div>
      <div id="historySVG2" aria-hidden="true"></div>
</div>
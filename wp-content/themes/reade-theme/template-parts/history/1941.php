<div id="history-1941" class="historical-event panel">
   <?php if (!empty($args['image'])) : ?>
      <div class="history-figure">
         <figure>
            <?php echo wp_get_attachment_image($args['image']['id'], 'full',); ?>
         </figure>
      </div>
   <?php endif; ?>
   <div class="history-content">
      <svg aria-hidden="true" class="current-year-dot" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
         <circle cx="13.5" cy="13.3588" r="5.52344" fill="#009FC6" />
         <circle cx="13.502" cy="13.3588" r="12.1152" stroke="#009FC6" stroke-width="2" />
      </svg>
      <h2><?php echo __($args['year'], TEXTDOMAIN); ?></h2>
      <h3 class=""><?php echo __($args['heading'], TEXTDOMAIN); ?></h3>
      <div class="history-content--info"><?php echo __($args['content'], TEXTDOMAIN); ?></div>
   </div>
</div>

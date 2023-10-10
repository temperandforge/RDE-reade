<div id="history-1115" class="historical-event panel">
   <h3 class=""><?php echo __($fields['events'][11]['heading'], TEXTDOMAIN); ?></h3>
   <?php if (!empty($fields['events'][11]['image'])) : ?>
      <figure>
         <?php echo wp_get_attachment_image($fields['events'][11]['image']['id'], 'full',); ?>
      </figure>
   <?php endif; ?>
   <div class="history-content">
      <div class="rel">
         <svg aria-hidden="true" class="current-year-dot" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="13.5" cy="13.3588" r="5.52344" fill="#009FC6" />
            <circle cx="13.502" cy="13.3588" r="12.1152" stroke="#009FC6" stroke-width="2" />
         </svg>
         <h2><?php echo __($fields['events'][11]['year_display'], TEXTDOMAIN); ?></h2>
      </div>
      <div class="history-content--info"><?php echo __($fields['events'][11]['content'], TEXTDOMAIN); ?></div>
   </div>
</div>

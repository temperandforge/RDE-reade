<div id="history-1773" class="historical-event panel">
   <div class="year">
      <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
   </div>
   <div class="scroll-btn">
      <em class="_text-left"><?php echo __('Scroll For Our Story', TEXTDOMAIN) ?></em>
         <svg aria-hidden="true" width="135" height="135" viewBox="0 0 135 135" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="67.0969" cy="67.8937" r="67.0969" fill="#009FC6"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M73.2634 55.2399C74.3133 54.1901 76.0154 54.1901 77.0652 55.2399L87.8181 65.9928C88.8679 67.0426 88.8679 68.7447 87.8181 69.7945L77.0652 80.5475C76.0154 81.5973 74.3133 81.5973 73.2634 80.5475C72.2136 79.4976 72.2136 77.7956 73.2634 76.7457L79.4273 70.5819H48.282C46.7973 70.5819 45.5937 69.3783 45.5938 67.8937C45.5938 66.409 46.7973 65.2054 48.282 65.2054H79.4273L73.2634 59.0416C72.2136 57.9918 72.2136 56.2897 73.2634 55.2399Z" fill="#FAFAFA"/>
      </svg>
   </div>
   <div class="history-content">
      <svg aria-hidden="true" class="current-year-dot" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
         <circle cx="13.5" cy="13.3588" r="5.52344" fill="#009FC6" />
         <circle cx="13.502" cy="13.3588" r="12.1152" stroke="#009FC6" stroke-width="2" />
      </svg>
      <h3><?php echo __($args['heading'], TEXTDOMAIN);?></h3>
      <div class="max-w-full mb-8"><?php echo __($args['content'], TEXTDOMAIN);?></div>
   </div>
   <?php if(!empty($args['image'])) :?>
      <figure>
         <?php echo wp_get_attachment_image($args['image']['id'], 'full', ) ;?>
      </figure>
   <?php endif ;?>
</div>

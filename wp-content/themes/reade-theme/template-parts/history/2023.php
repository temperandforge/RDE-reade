<div id="history-2023" class="historical-event panel w-200vw">
   <div class="history-content">
      <h2><?php echo __($args['year'], TEXTDOMAIN);?></h2>
      <h3><?php echo __($args['heading'], TEXTDOMAIN);?></h3>
      <p><?php echo $args['content'] ;?></p>
   </div>
      <?php if(!empty($args['image'])) :?>
            <figure>
               <?php echo wp_get_attachment_image($args['image']['id'], 'full', ) ;?>
            </figure>
         <?php endif ;?>
      <button class="btn--back-to-start">
         <em><?php echo __( "Back to beginning", TEXTDOMAIN);?></em>
         <svg aria-hidden="true" width="135" height="135" viewBox="0 0 135 135" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle cx="67.8508" cy="67.3499" r="67.0969" fill="#009FC6"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M61.6897 54.6958C60.6399 53.646 58.9378 53.646 57.888 54.6958L47.135 65.4487C46.0852 66.4986 46.0852 68.2007 47.135 69.2505L57.888 80.0034C58.9378 81.0532 60.6399 81.0532 61.6897 80.0034C62.7395 78.9536 62.7395 77.2515 61.6897 76.2017L55.5259 70.0378H86.6711C88.1558 70.0378 89.3594 68.8343 89.3594 67.3496C89.3594 65.8649 88.1558 64.6614 86.6711 64.6614H55.5259L61.6897 58.4975C62.7395 57.4477 62.7395 55.7456 61.6897 54.6958Z" fill="#FAFAFA"/> </svg>
      </button>
</div>

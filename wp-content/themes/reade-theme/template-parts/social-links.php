<div class="footer-social">
   <?php if($social_links): foreach($social_links as $sl):?>
      <a class="social-icon" href="<?php echo array_key_exists('share', $args) ? social_share($sl['label']) : $sl['link'];?>" rel="noreferrer" target="_blank">
         <span class="sr-only visually-hidden">visit <?php echo $sl['label'];?> profile</span>
         <?php svg($sl['label']); ?>
      </a>
   <?php endforeach; endif; ?>
</div> 

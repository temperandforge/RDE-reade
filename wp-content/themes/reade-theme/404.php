<?php 
//TODO define ('WPLANG', 'fr_FR');

$option_fields = get_fields('options') ?: [];
get_header(); 
?>
<main id="main-content" class="main-content-wrap">
   <div class="theme-main">
      <div class="theme-inner-wrap">
         <article class="error-404-content grid place-items-center">

            <div class="status-404 text-primary">
               <h1>404</h1>
               <p><?php _e( 'Settings Page', 'reade-theme' ); ?></p>
            </div>
            <p><?php echo __($option_fields['404_msg'] ?: "Oops! Sorry, this page doesn't exist or was removed.", TEXTDOMAIN); ?></p>
            <?php 
            if($buttons = $option_fields['404_buttons']): ?>
            <div class="btns-wrap">
               <?php foreach($buttons as $idx => $btn): 
                  if(!$btn = $btn['btn']) continue; ?>
               <a href="<?php echo $btn['url'];?>" class="btn <?php echo "btn-".strval($idx); ?>" target="<?php echo $btn['target']?:'_self';?>">
                  <span class="inline-block">
                     <?php echo __($btn['title'], 'reade-theme'); ?>
                  </span>
               </a>
               <?php endforeach; ?>
               </div>
            <?php endif; ?>
         </article>
      </div>
   </div>
   <?php svg('404-graphic'); ?>
</main>
<?php
get_footer(); ?>

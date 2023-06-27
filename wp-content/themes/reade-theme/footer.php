<?php
//TODO divide into parts
   $option_fields = get_fields('options') ?: [];
   // $locations = $option_fields['locations'] ?: [];
   $social_links = [];
   if(array_key_exists('social_links', $option_fields)) {
      $social_links = $option_fields['social_links']; 
   }
?>
<footer id="site-footer" class="site-footer">
   <div class="theme-main">
      <div class="theme-inner-wrap-wide">
         <div class="footer-info footer-row-1">
            <div class="footer-links">
               <?php
                  $location = 'footer-navigation';
                  if(!has_nav_menu($location)) {
                     $location = 'primary-navigation';
                  }
                  wp_nav_menu( array(
                     'menu' => get_term(get_nav_menu_locations()[$location], 'nav_menu')->name,
                     'container' => false, // remove nav container
                     'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                     'menu_class' => 'footer-links-list menu-section-list', // adding custom nav class
                     'depth' => 2, // limit the depth of the nav
                     ) );
                  ?>
            </div>
            <div class="flex flex-col">
               <a class="footer-logo-link" href="/">
                  <!-- <span class="sr-only visually-hidden"><?php //echo get_bloginfo(); ?> - go to home</span> -->
                  <?php if($option_fields && array_key_exists('logo_footer', $option_fields) && $logo = $option_fields['logo_footer']) { 
                     echo wp_get_attachment_image($logo['ID'], 'thumbnail', false, ['role' => 'presentation']); 
                  } else { ?>
                     <span class="sr-only"><?php echo __("Home - ".get_bloginfo(), TEXTDOMAIN); ?></span>
                     <?php svg('logo'); ?>
                     <!--//TODO -->
                     <!-- <img src="<?php //echo get_stylesheet_directory(); ?>/assets/svg/logo.svg" alt="Home - <?php //echo get_bloginfo() ?>"> -->
                  <?php } ?>
               </a>
               <div class="_mb-9">
                  <!-- TODO -->
                  <?php if(array_key_exists('contact_phone', $option_fields) && $phone = $option_fields['contact_phone']): ?>
                  <p class="footer-contact-phone">Phone: <a href="tel:<?php echo $phone;?>" rel="noreferrer"><?php echo $phone; ?></a></p>
                  <?php endif; ?>
                  <?php if(array_key_exists('contact_email', $option_fields) && $email = $option_fields['contact_email']): ?>
                     <p class="footer-contact-email">Email: <a href="mailto:<?php echo $email;?>" rel="noreferrer"><?php echo $email; ?></a></p>
                  <?php endif; ?>
               </div>
               <?php if($locations && $addr_one = $locations[0]['address_line_one']): ?>
                  <address>
                     <?php echo $addr_one; ?><br/>
                     <?php if($addr_two = $locations[0]['address_line_two']): ?>
                        <?php echo $addr_two; ?><br/>
                     <?php endif; ?>
                  </address>
               <?php endif; ?>
               <div class="footer-subscribe">
                  <?php 
                  if($footer_form_msg = $option_fields['footer_form_msg']): ?>
                     <div class="footer-form-msg"><?php echo $footer_form_msg; ?></div>
                  <?php 
                  endif;
                  if($footer_form_shortcode = $option_fields['footer_form_shortcode']) {
                     echo do_shortcode($footer_form_shortcode);
                  } ?>
               </div>
            <!-- </div> TODO -->
            </div>
         </div>
         <div class="footer-contact footer-row-2">
            <div class="flex flex-col items-center gap-y-6">
               <a class="footer-logo-link" href="/">
                  <!-- <span class="sr-only visually-hidden"><?php //echo get_bloginfo(); ?> - go to home</span> -->
                  <?php if($option_fields && array_key_exists('logo_footer', $option_fields) && $logo = $option_fields['logo_footer']) { 
                     echo wp_get_attachment_image($logo['ID'], 'thumbnail', false, ['role' => 'presentation']); 
                  } else { ?>
                     <span class="sr-only"><?php echo __("Home - ".get_bloginfo(), TEXTDOMAIN); ?></span>
                     <?php svg('logo'); ?>
                     <!--//TODO -->
                     <!-- <img src="<?php //echo get_stylesheet_directory(); ?>/assets/svg/logo.svg" alt="Home - <?php //echo get_bloginfo() ?>"> -->
                  <?php } ?>
               </a>
               <?php 
               if($social_links){
                  include( locate_template('template-parts/social-links.php'));
               } ?>
            </div>
            <!--TODO -->
            <?php if($btn = $option_fields['footer_contact']): ?>
            <a class="btn-green-dark-green" href="<?php echo $btn['url'];?>" target="<?php echo $btn['target']?:'_self';?>" rel="noreferrer">
               <?php echo __($btn['title'], TEXTDOMAIN); ?>
            </a>
            <?php endif; ?>
         </div>
         <div class="footer-bottom footer-row-3">
            <div class="footer-copyright">
               <p class="mb-0">All Rights Reserved. &copy; <?php echo date('Y', strtotime('now')) .' '. get_bloginfo(); ?></p>
            </div>
            <div class="footer-legal-wrap">
               <?php 
               wp_nav_menu( array(
                  'menu' => get_term(get_nav_menu_locations()['footer-nav-bottom'], 'nav_menu')->name,
                  'container' => false, // remove nav container
                  'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                  'menu_class' => 'footer-nav-bottom-list menu-section-list', // adding custom nav class
                  'depth' => 1, // limit the depth of the nav
                  ) );
                   ?>
            </div>
         </div>
      </div>
   </div>
</footer>


<!-- conditional polyfills for svelte -->
<script>
if (!('customElements' in window)) {
  window.requestAnimationFrame = window.requestAnimationFrame.bind(window);
  window.setTimeout = window.setTimeout.bind(window);
  document.write(
    '<script src="https://cdn.jsdelivr.net/combine/npm/promise-polyfill@8.1.0/dist/polyfill.min.js,npm/classlist-polyfill@1.2.0/src/index.js,npm/mdn-polyfills@5.19.0/Array.prototype.fill.js,npm/@webcomponents/webcomponentsjs@2.4.1/webcomponents-bundle.min.js"><\/script>'
  )
}
</script>

<?php wp_footer(); ?>

<?php 
if (array_key_exists('footer_code', $option_fields) && $footer_code = $option_fields['footer_code']) {
  // additional footer code for analytics and whatnot
  echo $footer_code;
} 
?>

</body>

</html>

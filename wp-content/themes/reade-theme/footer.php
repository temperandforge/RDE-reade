<?php
$option_fields = get_fields('options') ?: [];
$social_links = [];
if (array_key_exists('social_links', $option_fields)) {
   $social_links = $option_fields['social_links'];
}


if (is_woocommerce() || is_archive()) {
   $options = get_fields('options');
?>
   <div id="add-to-quote-success" class="lity-hide">
      <svg class="add-to-quote-success-close" width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg" data-lity-close>
         <circle cx="18.2539" cy="17.5269" r="17.3652" fill="#CFEEF7" />
         <path d="M22.9615 14.2339L19.6685 17.5269L22.9615 20.8199C23.057 20.9122 23.1332 21.0225 23.1856 21.1445C23.238 21.2665 23.2656 21.3978 23.2667 21.5305C23.2679 21.6633 23.2426 21.795 23.1923 21.9179C23.142 22.0408 23.0678 22.1524 22.9739 22.2463C22.88 22.3402 22.7683 22.4145 22.6454 22.4648C22.5225 22.515 22.3909 22.5403 22.2581 22.5392C22.1253 22.538 21.9941 22.5104 21.8721 22.458C21.7501 22.4056 21.6397 22.3294 21.5475 22.2339L18.2545 18.9409L14.9615 22.2339C14.8692 22.3294 14.7589 22.4056 14.6369 22.458C14.5149 22.5104 14.3837 22.538 14.2509 22.5392C14.1181 22.5403 13.9864 22.515 13.8635 22.4648C13.7406 22.4145 13.629 22.3402 13.5351 22.2463C13.4412 22.1524 13.3669 22.0408 13.3167 21.9179C13.2664 21.795 13.2411 21.6633 13.2422 21.5305C13.2434 21.3978 13.271 21.2665 13.3234 21.1445C13.3758 21.0225 13.452 20.9122 13.5475 20.8199L16.8405 17.5269L13.5475 14.2339C13.452 14.1417 13.3758 14.0313 13.3234 13.9093C13.271 13.7873 13.2434 13.6561 13.2422 13.5233C13.2411 13.3906 13.2664 13.2589 13.3167 13.136C13.3669 13.0131 13.4412 12.9014 13.5351 12.8075C13.629 12.7136 13.7406 12.6394 13.8635 12.5891C13.9864 12.5388 14.1181 12.5135 14.2509 12.5147C14.3837 12.5158 14.5149 12.5434 14.6369 12.5958C14.7589 12.6482 14.8692 12.7244 14.9615 12.8199L18.2545 16.1129L21.5475 12.8199C21.6397 12.7244 21.7501 12.6482 21.8721 12.5958C21.9941 12.5434 22.1253 12.5158 22.2581 12.5147C22.3909 12.5135 22.5225 12.5388 22.6454 12.5891C22.7683 12.6394 22.88 12.7136 22.9739 12.8075C23.0678 12.9014 23.142 13.0131 23.1923 13.136C23.2426 13.2589 23.2679 13.3906 23.2667 13.5233C23.2656 13.6561 23.238 13.7873 23.1856 13.9093C23.1332 14.0313 23.057 14.1417 22.9615 14.2339Z" fill="#004455" />
      </svg>
      <div class="atqs-container">
         <div class="atqs-container-left">
            <?php

            if (!empty($options['atqs_image'])) {
            ?>
               <style>
                  .atqs-container-left {
                     background-image: url('<?php echo $options['atqs_image']['url']; ?>');
                  }
               </style>
            <?php
            }

            if (!empty($options['atqs_success_text'])) {
            ?>
               <p class="atqs-success-text"><?php echo $options['atqs_success_text']; ?></p>
            <?php
            }

            ?>
         </div>
         <div class="atqs-container-right">
            <div class="atqs-container-right-top">
               <?php

               if (!empty($options['atqs_top_headline'])) {
               ?><p class="atqs-right-headline"><?php echo $options['atqs_top_headline']; ?></p><?php
                                                                                                }

                                                                                                if (!empty($options['atqs_top_button'])) {
                                                                                                   ?>
                  <a class="btn-blue-dark-blue btn-arrow" href="<?php echo $options['atqs_top_button']['url']; ?>">
                     <?php echo $options['atqs_top_button']['title']; ?>
                     <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.63128C12.348 6.28957 12.902 6.28957 13.2437 6.63128L16.7437 10.1313C17.0854 10.473 17.0854 11.027 16.7437 11.3687L13.2437 14.8687C12.902 15.2104 12.348 15.2104 12.0063 14.8687C11.6646 14.527 11.6646 13.973 12.0063 13.6313L14.0126 11.625H3.875C3.39175 11.625 3 11.2332 3 10.75C3 10.2668 3.39175 9.875 3.875 9.875H14.0126L12.0063 7.86872C11.6646 7.52701 11.6646 6.97299 12.0063 6.63128Z" fill="white" />
                     </svg>
                  </a>
               <?php
                                                                                                }

               ?>
            </div>
            <div class="atqs-container-right-bottom">
               <?php

               if (!empty($options['atqs_bottom_headline'])) {
               ?><p class="atqs-right-headline"><?php echo $options['atqs_bottom_headline']; ?></p><?php
                                                                                                   }

                                                                                                   if (!empty($options['atqs_bottom_button'])) {
                                                                                                      ?>
                  <a class="btn-green-black-text btn-arrow" href="<?php echo $options['atqs_bottom_button']['url']; ?>">
                     <?php echo $options['atqs_bottom_button']['title']; ?>
                     <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.63128C12.348 6.28957 12.902 6.28957 13.2437 6.63128L16.7437 10.1313C17.0854 10.473 17.0854 11.027 16.7437 11.3687L13.2437 14.8687C12.902 15.2104 12.348 15.2104 12.0063 14.8687C11.6646 14.527 11.6646 13.973 12.0063 13.6313L14.0126 11.625H3.875C3.39175 11.625 3 11.2332 3 10.75C3 10.2668 3.39175 9.875 3.875 9.875H14.0126L12.0063 7.86872C11.6646 7.52701 11.6646 6.97299 12.0063 6.63128Z" fill="white" />
                     </svg>
                  </a>
               <?php
                                                                                                   }

               ?>
            </div>
         </div>
      </div>
   </div>
<?php
}
?>
<footer id="site-footer" class="site-footer">
   <div class="theme-main">
      <div class="_theme-inner-wrap-wide">
         <div class="footer-info footer-row-1">
            <div class="footer-links">
               <?php
               $location = 'footer-navigation';
               if (!has_nav_menu($location)) {
                  $location = 'primary-navigation';
               }
               wp_nav_menu(array(
                  'menu' => get_term(get_nav_menu_locations()[$location], 'nav_menu')->name,
                  'container' => false, // remove nav container
                  'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                  'menu_class' => 'footer-links-list menu-section-list', // adding custom nav class
                  'depth' => 2, // limit the depth of the nav
               ));
               ?>
            </div>
            <div class="footer-logo-subscribe--wrap flex flex-col">
               <a class="footer-logo-link" href="/" aria-label="<?php echo get_bloginfo(); ?>">
                  <!-- <span class="sr-only visually-hidden"><?php //echo get_bloginfo(); 
                                                               ?> - go to home</span> -->
                  <?php //if($option_fields && array_key_exists('logo_footer', $option_fields) && $logo = $option_fields['logo_footer']) { 
                  //echo wp_get_attachment_image($logo['ID'], 'thumbnail', false, ['role' => 'presentation']); 
                  //} else { 
                  ?>
                  <span class="sr-only"><?php echo __("Home - " . get_bloginfo(), TEXTDOMAIN); ?></span>
                  <?php //svg('logo'); 
                  ?>
                  <!-- style="enable-background:new 0 0 624 204;"  -->
                  <svg class="svg-logo" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 624 204" xml:space="preserve">
                     <style type="text/css">
                        .st0 {
                           fill: #009FC6;
                        }
                     </style>
                     <path class="st0" d="M309.97,109.46c16.17,0,21.6-7.91,21.6-17.67h-24.3c-32.94,0-46.39,9.82-46.39,32.28 c0,23.78,21.81,33.81,45.37,33.81c17.45,0,30.97-6.33,38.39-18.54c0,17.23,0.65,17.45,23.34,17.45V96.37 c0-28.57-11.12-46.46-55.4-46.46h-40.79c0,21.59,0.87,23.12,19.63,23.12h21.81c17.89,0,25.96,3.71,25.96,18.76v17.89 c0,25.08,0,25.74-27.7,25.74c-15.49,0-20.94-4.8-20.94-11.56C290.55,109.87,290.64,109.46,309.97,109.46z"></path>
                     <path class="st0" d="M57.22,49.48v80.31c0,18.25-2.31,22.51-5.59,25.13c-7.11,5.69-18.19,3.93-24.08,3.93V86.52 C27.56,58.34,42.39,49.48,57.22,49.48z"></path>
                     <path class="st0" d="M99.32,104.78c19.4-1.84,38.17-17.08,38.17-45.87c0-17.89-6.54-44.35-59.11-44.35H9.1 c0,12.23,7.12,25.59,28.35,25.59h42.03c25.52,0,27.71,10.48,28.14,18.76c0.67,12.95-0.69,21.78-5.13,26.23 c-3.09,3.09-8.17,6.65-22.57,6.65h-8.29c-8.67,0-9.79,8.44-4.63,15.05l57.89,73.66c9.84,12.55,19.84,15.9,30.11,15.77h20.2 L99.32,104.78z"></path>
                     <path class="st0" d="M614.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H565c-16.23,0-21.67,8.76-21.67,18.1h58.8C613.57,111.86,614.9,109.2,614.9,94.84z"></path>
                     <path class="st0" d="M253.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H204c-16.23,0-21.67,8.76-21.67,18.1h58.8C252.57,111.86,253.9,109.2,253.9,94.84z"></path>
                     <path class="st0" d="M462.36,87.55c4.45,14.52,2.82,40.16,2.93,51.79c0,17.45,4.78,17.45,26.81,17.45V29.84 c0-10.47-0.66-15.7-3.93-18.32c-5.02-3.93-18.98-2.84-24.87-2.84v55.19c-3.93-8.07-17.23-15.71-32.94-15.71 c-38.39,0-48.86,25.96-48.86,54.75c0,28.57,10.91,55.19,49.08,55.19c21.75,0,27.35-14.38,27.02-24.69 c-3.56,0.47-9.17,2.44-20.7,1.96c-21.17-0.86-26.17-12.39-26.17-32.46c0-31.63-0.22-30.32,26.39-30.32 C451.4,72.6,458.97,76.48,462.36,87.55z"></path>
                  </svg>
                  <?php //} 
                  ?>
               </a>
               <div class="footer-subscribe">
                  <?php

                  if ($footer_form_code = $option_fields['footer_form']) {
                     echo $footer_form_code;
                  }

                  ?>
               </div>
            </div>
         </div>
         <div class="footer-contact footer-row-2">
            <div class="flex flex-col items-center gap-y-6">
               <a class="footer-logo-link" href="/">
                  <span class="sr-only"><?php echo __("Home - " . get_bloginfo(), TEXTDOMAIN); ?></span>
                  <!-- style="enable-background:new 0 0 624 204;"  -->
                  <svg class="svg-logo" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 624 204" xml:space="preserve">
                     <style type="text/css">
                        .st0 {
                           fill: #009FC6;
                        }
                     </style>
                     <path class="st0" d="M309.97,109.46c16.17,0,21.6-7.91,21.6-17.67h-24.3c-32.94,0-46.39,9.82-46.39,32.28 c0,23.78,21.81,33.81,45.37,33.81c17.45,0,30.97-6.33,38.39-18.54c0,17.23,0.65,17.45,23.34,17.45V96.37 c0-28.57-11.12-46.46-55.4-46.46h-40.79c0,21.59,0.87,23.12,19.63,23.12h21.81c17.89,0,25.96,3.71,25.96,18.76v17.89 c0,25.08,0,25.74-27.7,25.74c-15.49,0-20.94-4.8-20.94-11.56C290.55,109.87,290.64,109.46,309.97,109.46z"></path>
                     <path class="st0" d="M57.22,49.48v80.31c0,18.25-2.31,22.51-5.59,25.13c-7.11,5.69-18.19,3.93-24.08,3.93V86.52 C27.56,58.34,42.39,49.48,57.22,49.48z"></path>
                     <path class="st0" d="M99.32,104.78c19.4-1.84,38.17-17.08,38.17-45.87c0-17.89-6.54-44.35-59.11-44.35H9.1 c0,12.23,7.12,25.59,28.35,25.59h42.03c25.52,0,27.71,10.48,28.14,18.76c0.67,12.95-0.69,21.78-5.13,26.23 c-3.09,3.09-8.17,6.65-22.57,6.65h-8.29c-8.67,0-9.79,8.44-4.63,15.05l57.89,73.66c9.84,12.55,19.84,15.9,30.11,15.77h20.2 L99.32,104.78z"></path>
                     <path class="st0" d="M614.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H565c-16.23,0-21.67,8.76-21.67,18.1h58.8C613.57,111.86,614.9,109.2,614.9,94.84z"></path>
                     <path class="st0" d="M253.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H204c-16.23,0-21.67,8.76-21.67,18.1h58.8C252.57,111.86,253.9,109.2,253.9,94.84z"></path>
                     <path class="st0" d="M462.36,87.55c4.45,14.52,2.82,40.16,2.93,51.79c0,17.45,4.78,17.45,26.81,17.45V29.84 c0-10.47-0.66-15.7-3.93-18.32c-5.02-3.93-18.98-2.84-24.87-2.84v55.19c-3.93-8.07-17.23-15.71-32.94-15.71 c-38.39,0-48.86,25.96-48.86,54.75c0,28.57,10.91,55.19,49.08,55.19c21.75,0,27.35-14.38,27.02-24.69 c-3.56,0.47-9.17,2.44-20.7,1.96c-21.17-0.86-26.17-12.39-26.17-32.46c0-31.63-0.22-30.32,26.39-30.32 C451.4,72.6,458.97,76.48,462.36,87.55z"></path>
                  </svg>
               </a>
               <?php if ($social_links) {
                  include(locate_template('template-parts/social-links.php'));
               } ?>
            </div>
            <?php if ($btn = $option_fields['footer_contact']) : ?>
               <a class="btn-green-light-green _btn-green-dark-green" href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target'] ?: '_self'; ?>" rel="noreferrer">
                  <?php echo __($btn['title'], TEXTDOMAIN); ?>
               </a>
            <?php endif; ?>
         </div>
         <div class="footer-bottom footer-row-3">
            <p style="position: absolute; left: 0; bottom: 0.5rem; font-size:8px; opacity: 0.25; color: #000;"><a href="https://temperandforge.com">Boston Web Design</a> by T/F</p>
            <div class="footer-copyright">
               <p class="mb-0"><?php echo __('All Rights Reserved.', TEXTDOMAIN); ?> &copy; <?php echo date('Y', strtotime('now')) . ' ' . get_bloginfo(); ?></p>
            </div>
            <div class="footer-legal-wrap">
               <?php
               wp_nav_menu(array(
                  'menu' => get_term(get_nav_menu_locations()['footer-nav-bottom'], 'nav_menu')->name,
                  'container' => false, // remove nav container
                  'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                  'menu_class' => 'footer-nav-bottom-list menu-section-list', // adding custom nav class
                  'depth' => 1, // limit the depth of the nav
               ));
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

<!-- contact form submission firing event -->
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
  if (event.target.getAttribute('id') == 'reade-contact-form') {
    window.dataLayer.push({'event' : 'contactformsubmitted'})
    console.log('Sent GA conversion');
    gtag('event', 'conversion', {'send_to': 'AW-1071831283/xaqECPXvtKIZEPOxi_8D'});

  }
  if (event.target.getAttribute('id') == 'reade-toll-processing-request-form') {
     window.dataLayer.push({'event': 'submittollprocessingrequest'})
     gtag('event', 'conversion', {'send_to': 'AW-1071831283/xaqECPXvtKIZEPOxi_8D'});
  }
});
</script>


<?php wp_footer(); ?>

<!-- TODO security -->
<script>
   var cb = function() {
      let h = document.getElementsByTagName('head')[0];
      for (let src of [
            'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap',
            'https://use.typekit.net/gll2aqr.css',
            // '/wp-content/themes/reade-theme/assets/css/bundle-min.css'
         ]) {
         let l = document.createElement('link');
         l.rel = 'stylesheet';
         // l.href = '/wp-content/themes/reade-theme/assets/css/bundle-min.css';
         l.href = src;
         h.parentNode.insertBefore(l, h);
      }
   };
   var raf = requestAnimationFrame || mozRequestAnimationFrame || webkitRequestAnimationFrame || msRequestAnimationFrame;
   if (raf) raf(cb);
   else window.addEventListener('load', cb);
</script>

<?php
if (array_key_exists('footer_code', $option_fields) && $footer_code = $option_fields['footer_code']) {
   // additional footer code for analytics and whatnot
   echo $footer_code;
}

/** Conditionally load recaptcha scripts */
global $post;

if (!empty($post->post_content) && !has_shortcode($post->post_content, 'contact-form-7')) {
?>
   <script>
      if (document.getElementById('piq-itemized-rfq')) {
         function onSubmit(token) {
            //document.getElementById('piq-itemized-rfq').dispatchEvent(new Event('submit'));
         }
      }
      if (document.getElementById('custom-rfq-form')) {
         function onCustomSubmit(token) {
            //document.getElementById('custom-rfq-form').dispatchEvent(new Event('submit'));
         }
      }
   </script>
<?php
}
?>

</body>

</html>

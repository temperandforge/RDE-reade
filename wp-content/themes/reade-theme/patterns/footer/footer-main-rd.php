<div class="footer-main">
   <div class="flex-col">
      <a href="/" class="footer-logo-link">
         <!-- <span class="sr-only visually-hidden"><?php //echo get_bloginfo(); ?> - go to home</span> -->
         <?php if($option_fields && array_key_exists('logo', $option_fields) && $logo = $option_fields['logo']) { 
            echo wp_get_attachment_image($logo['ID'], 'thumbnail', false, ['role' => 'presentation']); 
         } else { ?>
            <img src="<?php echo get_stylesheet_directory(); ?>/assets/svg/logo.svg" alt="Home - <?php echo get_bloginfo() ?>" role="presentation" />
         <?php } ?>
      </a>

      <div class="footer-links flex">
         <?php
            $location = 'footer-navigation';
            if(!has_nav_menu($location)) {
               $location = 'primary-navigation';
            }
            wp_nav_menu( array(
               'menu' => get_term(get_nav_menu_locations()[$location], 'nav_menu')->name,
               'container' => false, // remove nav container
               'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
               'menu_class' => 'menu-section-list', // adding custom nav class
               'depth' => 1, // limit the depth of the nav
               ) );
            ?>
      </div>

   </div>
      <?php if(array_key_exists('address_line_one', $option_fields) && $address_line_one = $option_fields['address_line_one']): ?>
      <address>
         <?php echo $address_line_one; ?><br/>
         <?php echo $option_fields['address_line_two']; ?>
      </address>
      <?php endif; ?>
      <?php if(array_key_exists('phone', $option_fields) && $phone = $option_fields['phone']): ?>
      <p><strong>Phone</strong> <a href="tel:<?php format_phone($phone);?>" rel="noreferrer"><?php echo $phone;?></a></p>
      <?php endif; ?>
      <?php if(array_key_exists('email', $option_fields) && $email = $option_fields['email']): ?>
      <p><strong>Email</strong> <a href="mailto:<?php $email;?>" rel="noreferrer"><?php echo $email;?></a></p>
      <?php endif; ?>
   </div>
   <div class="footer-subscribe">
      <h6><?php echo __('Subscribe to our newsletter', TEXTDOMAIN); ?></h6>
      <p><?php echo __('A monthly digest of the latest news, articles, and resources.', TEXTDOMAIN); ?></p>
      <div>
         <!-- <h4 class="title is-6"><?php //echo get_term(get_nav_menu_locations()["footer-navigation"], 'nav_menu')->name; ?></h4> -->
         <?php
         // wp_nav_menu( array(
         // 'menu' => get_term(get_nav_menu_locations()["footer-navigation"], 'nav_menu')->name,
         // 'container' => false, // remove nav container
         // 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
         // 'menu_class' => 'menu-section-list', // adding custom nav class
         // 'depth' => 1, // limit the depth of the nav
         // ) );
         ?>
      </div>
   </div>
</div>
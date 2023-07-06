<?php
$option_fields = get_fields('option'); ?>

<section class="mobile-menu loading">
   <div class="mobile-menu--header">
      <!-- TODO dup -->
      <a href="<?php echo get_site_url() ?>" class="mobile-menu--logo-link">
         <?php if($option_fields && array_key_exists('logo', $option_fields) && $logo = $option_fields['logo']) { 
         echo wp_get_attachment_image($logo['ID'], 'thumbnail', false, ['role' => 'presentation']); 
         } else { ?>
         <span class="sr-only"><?php echo __("Home - ".get_bloginfo(), TEXTDOMAIN); ?></span>
         <!-- TODO -->
         <?php //svg('logo'); ?>
         <!--//TODO -->
         <!-- <img src="<?php //echo get_stylesheet_directory(); ?>/assets/svg/logo.svg" alt="Home - <?php //echo get_bloginfo() ?>"> -->
         <?php } ?>
      </a>
      <button class="mobile-menu--close-btn">
         <span class="sr-only"><?php echo __("close mobile menu", TEXTDOMAIN);?></span>
         <svg aria-hidden="true" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.84171 3.34171C4.29732 2.8861 5.03601 2.8861 5.49162 3.34171L10.5 8.35008L15.5084 3.34171C15.964 2.8861 16.7027 2.8861 17.1583 3.34171C17.6139 3.79732 17.6139 4.53601 17.1583 4.99162L12.1499 10L17.1583 15.0084C17.6139 15.464 17.6139 16.2027 17.1583 16.6583C16.7027 17.1139 15.964 17.1139 15.5084 16.6583L10.5 11.6499L5.49162 16.6583C5.03601 17.1139 4.29732 17.1139 3.84171 16.6583C3.3861 16.2027 3.3861 15.464 3.84171 15.0084L8.85008 10L3.84171 4.99162C3.3861 4.53601 3.3861 3.79732 3.84171 3.34171Z" fill="white"/> </svg>
      </button>
   </div>
   <nav class="mobile-menu--menu">
      <?php
         wp_nav_menu( array(
         'menu' => get_term(get_nav_menu_locations()['primary-navigation'], 'nav_menu')->name,
         'container'      => false,
         'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
         'menu_class'     => 'mobile-menu--menu-list', 
         'depth'          => 2,
         'theme_location' => 'Primary Navigation'
         ) );
      ?>
   </nav>
   <div class="mobile-menu--footer"> <!-- TODO -->
      <a class="btn-blue-dark-blue" href="/contact">Contact</a>
      <!-- <a class="btn">English</a> -->
      <div class="language-switcher btn">
         <!-- TODO on click -->
         <svg aria-hidden="true" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2.44567 10.7601C2.44418 10.8252 2.44344 10.8906 2.44344 10.9561C2.44344 14.9785 5.25593 18.3441 9.0217 19.1935V17.1423C9.0217 16.4646 8.47233 15.9152 7.79464 15.9152C6.19463 15.9152 4.89757 14.6182 4.89757 13.0182V11.9871C4.89757 11.3094 4.34819 10.7601 3.6705 10.7601H2.44567ZM2.65031 9.09006H3.6705C5.27051 9.09006 6.56757 10.3871 6.56757 11.9871V13.0182C6.56757 13.6959 7.11695 14.2452 7.79464 14.2452C9.39464 14.2452 10.6917 15.5423 10.6917 17.1423V19.3982C10.7569 19.3996 10.8222 19.4004 10.8877 19.4004C11.6698 19.4004 12.4271 19.2941 13.1458 19.0951V17.1423C13.1458 15.5423 14.4429 14.2452 16.0429 14.2452H18.6675C19.0954 13.2344 19.332 12.1229 19.332 10.9561C19.332 9.78932 19.0954 8.67782 18.6675 7.66696L18.105 7.66696C17.4273 7.66696 16.8779 8.21634 16.8779 8.89403C16.8779 10.494 15.5808 11.7911 13.9808 11.7911C12.3808 11.7911 11.0838 10.494 11.0838 8.89403C11.0838 8.21634 10.5344 7.66696 9.8567 7.66696H9.34119C7.45647 7.66696 5.9286 6.1391 5.9286 4.25438V4.12065C4.29842 5.3054 3.10843 7.05909 2.65031 9.09006ZM7.5986 3.17634V4.25438C7.5986 5.21678 8.37878 5.99696 9.34119 5.99696H9.8567C11.4567 5.99696 12.7538 7.29402 12.7538 8.89403C12.7538 9.57172 13.3031 10.1211 13.9808 10.1211C14.6585 10.1211 15.2079 9.57172 15.2079 8.89403C15.2079 7.41774 16.3121 6.19937 17.7397 6.01977C16.2062 3.89483 13.7085 2.5118 10.8877 2.5118C9.72096 2.5118 8.60946 2.74843 7.5986 3.17634ZM17.7232 15.9152H16.0429C15.3652 15.9152 14.8158 16.4646 14.8158 17.1423V18.4331C15.9679 17.8265 16.9627 16.9616 17.7232 15.9152ZM0.773438 10.9561C0.773438 5.37012 5.30176 0.841797 10.8877 0.841797C16.4737 0.841797 21.002 5.37012 21.002 10.9561C21.002 16.5421 16.4737 21.0704 10.8877 21.0704C5.30176 21.0704 0.773438 16.5421 0.773438 10.9561Z" fill="#009FC6"/> </svg>
         <?php echo do_shortcode('[gtranslate]'); ?>
      </div>
   </div>
</section>

<?php
$option_fields = get_fields('option'); ?>

<section class="mobile-menu">
   <div class="mobile-menu--header">
      <!-- TODO dup -->
      <a href="<?php echo get_site_url() ?>" class="xlogo-link">
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
   <div class="mobile-menu--footer">
      <a class="btn-blue-dark-blue">Contact</a>
      <a class="btn">English</a>
   </div>
</section>

<?php
if(!defined('option_fields')) { //TODO
  $option_fields = get_fields('options'); 
} 
?>

<div class="navbar-wrap">
  <div class="theme-main">
    <div class="theme-inner-wrap-wide">
      <!-- //TODO -->
      <div class="navbar d-flex flex items-center">
        <a href="<?php echo get_site_url() ?>" class="logo-link">
          <?php if($option_fields && array_key_exists('logo', $option_fields) && $logo = $option_fields['logo']) { 
            echo wp_get_attachment_image($logo['ID'], 'thumbnail', false, ['role' => 'presentation']); 
          } else { ?>
            <span class="sr-only"><?php echo __("Home - ".get_bloginfo(), TEXTDOMAIN); ?></span>
            <?php svg('logo'); ?>
            <!--//TODO -->
            <!-- <img src="<?php //echo get_stylesheet_directory(); ?>/assets/svg/logo.svg" alt="Home - <?php //echo get_bloginfo() ?>"> -->
          <?php } ?>
        </a>
        <nav>
          <?php
            // header menu
            wp_nav_menu( array(
              'menu' => get_term(get_nav_menu_locations()['primary-navigation'], 'nav_menu')->name,
              'container' => false, // remove nav container
              'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'menu_class' => 'header-links', // adding custom nav class
              'depth' => 2, // limit the depth of the nav
              // // 'theme_location' => 'Primary Navigation',
              // 'walker' => new Theme_Menu_Walker(),
              // 'show_carets' => true
            ) );
          ?>
        </nav>
        <div class="flex items-center ml-auto lg:ml-0" aria-label="search / change language / view notifications">
            <!-- TODO BEM -->
            <div class="doc-notifications">
               <span class="doc-count"></span>
               <svg aria-hidden="true" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"> <mask id="mask0_3744_12010" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="25"> <rect y="0.684326" width="24" height="24" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_3744_12010)"> <path d="M8 18.6843H16V16.6843H8V18.6843ZM8 14.6843H16V12.6843H8V14.6843ZM6 22.6843C5.45 22.6843 4.97917 22.4885 4.5875 22.0968C4.19583 21.7052 4 21.2343 4 20.6843V4.68433C4 4.13433 4.19583 3.66349 4.5875 3.27183C4.97917 2.88016 5.45 2.68433 6 2.68433H14L20 8.68433V20.6843C20 21.2343 19.8042 21.7052 19.4125 22.0968C19.0208 22.4885 18.55 22.6843 18 22.6843H6ZM13 9.68433V4.68433H6V20.6843H18V9.68433H13Z" fill="#009FC6"/> </g> </svg>
            </div>
          <div class="search-wrap mr-6">
             <form role="search" method="get" action="<?php echo get_site_url() ?>">
               <!-- <span aria-hidden="true" class="focus-detection fillall"></span> -->
               <label for="mobile_search" class="sr-only">Search</label>
               <input type="search" placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="off" id="mobile_search" spellcheck="false" name="s" />
               <button type="submit" aria-label="search"> <!-- TODO -->
                 <svg aria-hidden="true" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M16.627 16.3103L11.543 11.2263M13.2376 6.98967C13.2376 10.2654 10.5821 12.921 7.30632 12.921C4.03054 12.921 1.375 10.2654 1.375 6.98967C1.375 3.71389 4.03054 1.05835 7.30632 1.05835C10.5821 1.05835 13.2376 3.71389 13.2376 6.98967Z" stroke="#009FC6" stroke-width="1.81934" stroke-linecap="round" stroke-linejoin="round"/> </svg>
               </button>
            </form>
          </div>
          <div class="language-switcher flex">
            <!-- TODO psudeo-dropdown -->
            <!-- <button>English</button> -->
            <!-- TODO on click -->
            <svg aria-hidden="true" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2.44567 10.7601C2.44418 10.8252 2.44344 10.8906 2.44344 10.9561C2.44344 14.9785 5.25593 18.3441 9.0217 19.1935V17.1423C9.0217 16.4646 8.47233 15.9152 7.79464 15.9152C6.19463 15.9152 4.89757 14.6182 4.89757 13.0182V11.9871C4.89757 11.3094 4.34819 10.7601 3.6705 10.7601H2.44567ZM2.65031 9.09006H3.6705C5.27051 9.09006 6.56757 10.3871 6.56757 11.9871V13.0182C6.56757 13.6959 7.11695 14.2452 7.79464 14.2452C9.39464 14.2452 10.6917 15.5423 10.6917 17.1423V19.3982C10.7569 19.3996 10.8222 19.4004 10.8877 19.4004C11.6698 19.4004 12.4271 19.2941 13.1458 19.0951V17.1423C13.1458 15.5423 14.4429 14.2452 16.0429 14.2452H18.6675C19.0954 13.2344 19.332 12.1229 19.332 10.9561C19.332 9.78932 19.0954 8.67782 18.6675 7.66696L18.105 7.66696C17.4273 7.66696 16.8779 8.21634 16.8779 8.89403C16.8779 10.494 15.5808 11.7911 13.9808 11.7911C12.3808 11.7911 11.0838 10.494 11.0838 8.89403C11.0838 8.21634 10.5344 7.66696 9.8567 7.66696H9.34119C7.45647 7.66696 5.9286 6.1391 5.9286 4.25438V4.12065C4.29842 5.3054 3.10843 7.05909 2.65031 9.09006ZM7.5986 3.17634V4.25438C7.5986 5.21678 8.37878 5.99696 9.34119 5.99696H9.8567C11.4567 5.99696 12.7538 7.29402 12.7538 8.89403C12.7538 9.57172 13.3031 10.1211 13.9808 10.1211C14.6585 10.1211 15.2079 9.57172 15.2079 8.89403C15.2079 7.41774 16.3121 6.19937 17.7397 6.01977C16.2062 3.89483 13.7085 2.5118 10.8877 2.5118C9.72096 2.5118 8.60946 2.74843 7.5986 3.17634ZM17.7232 15.9152H16.0429C15.3652 15.9152 14.8158 16.4646 14.8158 17.1423V18.4331C15.9679 17.8265 16.9627 16.9616 17.7232 15.9152ZM0.773438 10.9561C0.773438 5.37012 5.30176 0.841797 10.8877 0.841797C16.4737 0.841797 21.002 5.37012 21.002 10.9561C21.002 16.5421 16.4737 21.0704 10.8877 21.0704C5.30176 21.0704 0.773438 16.5421 0.773438 10.9561Z" fill="#009FC6"/> </svg>
            <?php echo do_shortcode('[gtranslate]'); ?>
          </div>
        </div>
        <!-- //TODO STARTER footer-header -->
        <button id="toggle_nav" class="toggle-nav" aria-label='toggle mobile menu'>
          <em class="hamburger">
            <div></div>
            <div></div>
            <div></div>
          </em>
          <span class="sr-only visually-hidden">toggle mobile menu</span>
        </button>
      </divc>
    </div>
  </div>
</div>

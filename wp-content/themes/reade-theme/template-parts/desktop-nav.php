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
        <div class="" aria-label="search / change language / view notifications">
          <!-- TODO BEM -->
          <div class="doc-notifications">
            <span class="doc-count"></div>
            <svg aria-hidden="true" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"> <mask id="mask0_3744_12010" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="25"> <rect y="0.684326" width="24" height="24" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_3744_12010)"> <path d="M8 18.6843H16V16.6843H8V18.6843ZM8 14.6843H16V12.6843H8V14.6843ZM6 22.6843C5.45 22.6843 4.97917 22.4885 4.5875 22.0968C4.19583 21.7052 4 21.2343 4 20.6843V4.68433C4 4.13433 4.19583 3.66349 4.5875 3.27183C4.97917 2.88016 5.45 2.68433 6 2.68433H14L20 8.68433V20.6843C20 21.2343 19.8042 21.7052 19.4125 22.0968C19.0208 22.4885 18.55 22.6843 18 22.6843H6ZM13 9.68433V4.68433H6V20.6843H18V9.68433H13Z" fill="#009FC6"/> </g> </svg>
          </div>
          <div class="search-wrap">
            <button aria-label="search"> <!-- TODO -->
              <svg aria-hidden="true" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M16.627 16.3103L11.543 11.2263M13.2376 6.98967C13.2376 10.2654 10.5821 12.921 7.30632 12.921C4.03054 12.921 1.375 10.2654 1.375 6.98967C1.375 3.71389 4.03054 1.05835 7.30632 1.05835C10.5821 1.05835 13.2376 3.71389 13.2376 6.98967Z" stroke="#009FC6" stroke-width="1.81934" stroke-linecap="round" stroke-linejoin="round"/> </svg>
            </button>
            <!-- TODO -->
            <form role="search" method="get" action="<?php echo get_site_url() ?>">
              <label for="mobile_search" class="sr-only">Search</label>
              <input type="search" placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="off" id="mobile_search" spellcheck="false" name="s" />
            </form>
          </div>
          <div class="language-switcher">
            <!-- TODO psudeo-dropdown -->
            <button>English</button>
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

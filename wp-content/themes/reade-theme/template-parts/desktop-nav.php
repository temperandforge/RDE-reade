<?php
if(!defined('option_fields')) {
  $option_fields = get_fields('options'); 
} ?>

<div class="navbar-wrap">
  <div class="theme-main">
    <div class="_theme-inner-wrap-wide">
       <div class="navbar">
        <a href="<?php echo get_site_url() ?>" class="logo-link" aria-label="<?php echo __("Home - ".get_bloginfo(), TEXTDOMAIN); ?>">
          <?php //if($option_fields && array_key_exists('logo', $option_fields) && $logo = $option_fields['logo']) { 
            //echo wp_get_attachment_image($logo['ID'], 'thumbnail', false, ['role' => 'presentation']); 
          //} else { ?>
            <span class="sr-only"><?php echo __("Home - ".get_bloginfo(), TEXTDOMAIN); ?></span>
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 624 204" style="enable-background:new 0 0 624 204;" xml:space="preserve"> <style type="text/css"> .st0{fill:#009FC6;} </style> <path class="st0" d="M309.97,109.46c16.17,0,21.6-7.91,21.6-17.67h-24.3c-32.94,0-46.39,9.82-46.39,32.28 c0,23.78,21.81,33.81,45.37,33.81c17.45,0,30.97-6.33,38.39-18.54c0,17.23,0.65,17.45,23.34,17.45V96.37 c0-28.57-11.12-46.46-55.4-46.46h-40.79c0,21.59,0.87,23.12,19.63,23.12h21.81c17.89,0,25.96,3.71,25.96,18.76v17.89 c0,25.08,0,25.74-27.7,25.74c-15.49,0-20.94-4.8-20.94-11.56C290.55,109.87,290.64,109.46,309.97,109.46z"/> <path class="st0" d="M57.22,49.48v80.31c0,18.25-2.31,22.51-5.59,25.13c-7.11,5.69-18.19,3.93-24.08,3.93V86.52 C27.56,58.34,42.39,49.48,57.22,49.48z"/> <path class="st0" d="M99.32,104.78c19.4-1.84,38.17-17.08,38.17-45.87c0-17.89-6.54-44.35-59.11-44.35H9.1 c0,12.23,7.12,25.59,28.35,25.59h42.03c25.52,0,27.71,10.48,28.14,18.76c0.67,12.95-0.69,21.78-5.13,26.23 c-3.09,3.09-8.17,6.65-22.57,6.65h-8.29c-8.67,0-9.79,8.44-4.63,15.05l57.89,73.66c9.84,12.55,19.84,15.9,30.11,15.77h20.2 L99.32,104.78z"/> <path class="st0" d="M614.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H565c-16.23,0-21.67,8.76-21.67,18.1h58.8C613.57,111.86,614.9,109.2,614.9,94.84z"/> <path class="st0" d="M253.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H204c-16.23,0-21.67,8.76-21.67,18.1h58.8C252.57,111.86,253.9,109.2,253.9,94.84z"/> <path class="st0" d="M462.36,87.55c4.45,14.52,2.82,40.16,2.93,51.79c0,17.45,4.78,17.45,26.81,17.45V29.84 c0-10.47-0.66-15.7-3.93-18.32c-5.02-3.93-18.98-2.84-24.87-2.84v55.19c-3.93-8.07-17.23-15.71-32.94-15.71 c-38.39,0-48.86,25.96-48.86,54.75c0,28.57,10.91,55.19,49.08,55.19c21.75,0,27.35-14.38,27.02-24.69 c-3.56,0.47-9.17,2.44-20.7,1.96c-21.17-0.86-26.17-12.39-26.17-32.46c0-31.63-0.22-30.32,26.39-30.32 C451.4,72.6,458.97,76.48,462.36,87.55z"/> </svg>

          <?php //} ?>
        </a>
        <nav>
          <?php
            wp_nav_menu( array(
              'menu' => get_term(get_nav_menu_locations()['primary-navigation'], 'nav_menu')->name,
              'container' => false,
              'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'menu_class' => 'header-links',
              'depth' => 2,
              'walker' => new Custom_Menu_Walker()
            ) );
          ?>
        </nav>
         <div class="flex items-center ml-auto lg:ml-0">
            <a href="/itemized-rfq/">
              <span class="sr-only">RFQ</span>
              <div class="doc-notifications" title="View Quote">
               <?php

               global $woocommerce;
               if ($woocommerce->cart->get_cart_contents_count() > 0) {
                ?><span id="doc-count" class="doc-count"></span><?php
                }
              
              ?>
               <svg aria-hidden="true" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"> <mask id="mask0_3744_12010" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="25"> <rect y="0.684326" width="24" height="24" fill="#D9D9D9"/> </mask> <g mask="url(#mask0_3744_12010)"> <path d="M8 18.6843H16V16.6843H8V18.6843ZM8 14.6843H16V12.6843H8V14.6843ZM6 22.6843C5.45 22.6843 4.97917 22.4885 4.5875 22.0968C4.19583 21.7052 4 21.2343 4 20.6843V4.68433C4 4.13433 4.19583 3.66349 4.5875 3.27183C4.97917 2.88016 5.45 2.68433 6 2.68433H14L20 8.68433V20.6843C20 21.2343 19.8042 21.7052 19.4125 22.0968C19.0208 22.4885 18.55 22.6843 18 22.6843H6ZM13 9.68433V4.68433H6V20.6843H18V9.68433H13Z" fill="#009FC6"/> </g> </svg>
              </div>
            </a>
            <div class="search-wrap mr-6">
               <form role="search" id="header-site-search" method="get" action="<?php echo get_site_url() ?>">
               <!-- <form role="search" method="get" action="<?php echo get_site_url() ?>"> -->
                  <!-- //TODO <span aria-hidden="true" class="focus-detection fillall"></span> -->
                  <label for="desktop_search" class="sr-only">Search</label>
                  <input type="search" placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="off" id="desktop_search" spellcheck="false" name="s" />
                  <button type="submit" aria-label="search"> <!-- TODO -->
                  <svg aria-hidden="true" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M16.627 16.3103L11.543 11.2263M13.2376 6.98967C13.2376 10.2654 10.5821 12.921 7.30632 12.921C4.03054 12.921 1.375 10.2654 1.375 6.98967C1.375 3.71389 4.03054 1.05835 7.30632 1.05835C10.5821 1.05835 13.2376 3.71389 13.2376 6.98967Z" stroke="#009FC6" stroke-width="1.81934" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                  </button>
               </form>
            </div>
            <div class="language-switcher">
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
      </div>
    </div>
  </div>
</div>

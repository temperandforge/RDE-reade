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
            <svg class="svg-logo" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 624 204" style="enable-background:new 0 0 624 204;" xml:space="preserve"> <style type="text/css"> .st0{fill:#009FC6;} </style> <path class="st0" d="M309.97,109.46c16.17,0,21.6-7.91,21.6-17.67h-24.3c-32.94,0-46.39,9.82-46.39,32.28 c0,23.78,21.81,33.81,45.37,33.81c17.45,0,30.97-6.33,38.39-18.54c0,17.23,0.65,17.45,23.34,17.45V96.37 c0-28.57-11.12-46.46-55.4-46.46h-40.79c0,21.59,0.87,23.12,19.63,23.12h21.81c17.89,0,25.96,3.71,25.96,18.76v17.89 c0,25.08,0,25.74-27.7,25.74c-15.49,0-20.94-4.8-20.94-11.56C290.55,109.87,290.64,109.46,309.97,109.46z"/> <path class="st0" d="M57.22,49.48v80.31c0,18.25-2.31,22.51-5.59,25.13c-7.11,5.69-18.19,3.93-24.08,3.93V86.52 C27.56,58.34,42.39,49.48,57.22,49.48z"/> <path class="st0" d="M99.32,104.78c19.4-1.84,38.17-17.08,38.17-45.87c0-17.89-6.54-44.35-59.11-44.35H9.1 c0,12.23,7.12,25.59,28.35,25.59h42.03c25.52,0,27.71,10.48,28.14,18.76c0.67,12.95-0.69,21.78-5.13,26.23 c-3.09,3.09-8.17,6.65-22.57,6.65h-8.29c-8.67,0-9.79,8.44-4.63,15.05l57.89,73.66c9.84,12.55,19.84,15.9,30.11,15.77h20.2 L99.32,104.78z"/> <path class="st0" d="M614.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H565c-16.23,0-21.67,8.76-21.67,18.1h58.8C613.57,111.86,614.9,109.2,614.9,94.84z"/> <path class="st0" d="M253.9,94.84c0-25.96-17.01-46.68-51.48-46.68c-44.93,0-56.93,26.61-56.93,54.75c0,27.92,11.78,54.1,56.49,54.1 h43.41c0-21.59-1.31-22.9-20.72-22.9h-23.56c-16.58,0-26.39-8.73-26.39-22.25v-18.1c0-23.12,0.65-23.12,25.74-23.12 c14.83,0,24.65,9.16,24.65,23.12H204c-16.23,0-21.67,8.76-21.67,18.1h58.8C252.57,111.86,253.9,109.2,253.9,94.84z"/> <path class="st0" d="M462.36,87.55c4.45,14.52,2.82,40.16,2.93,51.79c0,17.45,4.78,17.45,26.81,17.45V29.84 c0-10.47-0.66-15.7-3.93-18.32c-5.02-3.93-18.98-2.84-24.87-2.84v55.19c-3.93-8.07-17.23-15.71-32.94-15.71 c-38.39,0-48.86,25.96-48.86,54.75c0,28.57,10.91,55.19,49.08,55.19c21.75,0,27.35-14.38,27.02-24.69 c-3.56,0.47-9.17,2.44-20.7,1.96c-21.17-0.86-26.17-12.39-26.17-32.46c0-31.63-0.22-30.32,26.39-30.32 C451.4,72.6,458.97,76.48,462.36,87.55z"/> </svg>
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
         <div class="flex gap-x-6 items-center ml-auto lg:ml-0">
            <div class="flex flex-row-reverse gap-x-2">
              <?php

              if (!empty($option_fields['rfq_button_link']) && !empty($option_fields['rfq_button_link']['title']) && !empty($option_fields['rfq_button_link']['url'])) {
                ?>
                <a href="<?php echo $option_fields['rfq_button_link']['url']; ?>" <?php if (!empty($option_fields['rfq_button_link']['target'])) { ?>target="_blank"<?php } ?> class="relative whitespace-nowrap btn-rfq flex flex-row gap-x-2 px-6 items-center bg-[#CFEEF6] rounded-[0.375rem] h-[46px] transition-colors duration-300 hover:bg-[#BAE3E9] text-[#009FC6] font-semibold" title="Build RFQ">
                <?php echo $option_fields['rfq_button_link']['title']; ?>
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <mask id="mask0_6978_20" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="23" height="23">
                  <rect x="0.771484" y="0.5" width="22" height="22" fill="#D9D9D9"/>
                  </mask>
                  <g mask="url(#mask0_6978_20)">
                  <path d="M20.0447 10.6292V17.9167C20.0447 18.4208 19.8651 18.8524 19.5061 19.2115C19.1471 19.5705 18.7155 19.75 18.2113 19.75H5.37799C4.87382 19.75 4.44222 19.5705 4.0832 19.2115C3.72417 18.8524 3.54465 18.4208 3.54465 17.9167V10.6292C3.19327 10.3083 2.92209 9.89583 2.73111 9.39167C2.54014 8.8875 2.53632 8.3375 2.71965 7.74167L3.68215 4.625C3.80438 4.22778 4.02209 3.89931 4.33528 3.63958C4.64847 3.37986 5.01132 3.25 5.42382 3.25H18.1655C18.578 3.25 18.937 3.37604 19.2426 3.62813C19.5481 3.88021 19.7697 4.2125 19.9072 4.625L20.8697 7.74167C21.053 8.3375 21.0492 8.87986 20.8582 9.36875C20.6672 9.85764 20.396 10.2778 20.0447 10.6292ZM13.8113 9.66667C14.2238 9.66667 14.537 9.52535 14.7509 9.24271C14.9648 8.96007 15.0488 8.64306 15.003 8.29167L14.4988 5.08333H12.7113V8.475C12.7113 8.79583 12.8183 9.07465 13.0322 9.31146C13.246 9.54826 13.5058 9.66667 13.8113 9.66667ZM9.68632 9.66667C10.0377 9.66667 10.3242 9.54826 10.5457 9.31146C10.7672 9.07465 10.878 8.79583 10.878 8.475V5.08333H9.09049L8.58632 8.29167C8.52521 8.65833 8.60542 8.97917 8.82695 9.25417C9.04847 9.52917 9.33493 9.66667 9.68632 9.66667ZM5.60715 9.66667C5.88215 9.66667 6.12278 9.56736 6.32903 9.36875C6.53528 9.17014 6.66132 8.91806 6.70715 8.6125L7.21132 5.08333H5.42382L4.50715 8.15417C4.41549 8.45972 4.46514 8.78819 4.65611 9.13958C4.84709 9.49097 5.1641 9.66667 5.60715 9.66667ZM17.9822 9.66667C18.4252 9.66667 18.746 9.49097 18.9447 9.13958C19.1433 8.78819 19.1891 8.45972 19.0822 8.15417L18.1197 5.08333H16.378L16.8822 8.6125C16.928 8.91806 17.054 9.17014 17.2603 9.36875C17.4665 9.56736 17.7072 9.66667 17.9822 9.66667ZM5.37799 17.9167H18.2113V11.4542C18.1349 11.4847 18.0853 11.5 18.0624 11.5H17.9822C17.5697 11.5 17.2068 11.4313 16.8936 11.2938C16.5804 11.1563 16.271 10.9347 15.9655 10.6292C15.6905 10.9042 15.3773 11.1181 15.0259 11.2708C14.6745 11.4236 14.3002 11.5 13.903 11.5C13.4905 11.5 13.1047 11.4236 12.7457 11.2708C12.3867 11.1181 12.0697 10.9042 11.7947 10.6292C11.5349 10.9042 11.2332 11.1181 10.8894 11.2708C10.5457 11.4236 10.1752 11.5 9.77799 11.5C9.33493 11.5 8.93389 11.4236 8.57486 11.2708C8.21584 11.1181 7.89882 10.9042 7.62382 10.6292C7.30299 10.95 6.98597 11.1753 6.67278 11.3052C6.35959 11.4351 6.00438 11.5 5.60715 11.5H5.50403C5.46584 11.5 5.42382 11.4847 5.37799 11.4542V17.9167Z" fill="#009FC6"/>
                  </g>
                </svg>



                
                  <?php

                  global $woocommerce;
                  if ($woocommerce->cart->get_cart_contents_count() > 0) {
                    ?><span id="doc-count" class="doc-count"></span><?php
                  }
              
                  ?>
                
              </a>
                <?php 
              }

              ?>
              <div class="search-wrap site-header__search">
                <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="0.771484" y="0.5" width="46" height="46" rx="6" fill="#CFEEF7"/>
                  <mask id="mask0_6901_583" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="11" y="11" width="25" height="25">
                  <rect x="11.7715" y="11.5" width="24" height="24" fill="#D9D9D9"/>
                  </mask>
                  <g mask="url(#mask0_6901_583)">
                  <path d="M31.3715 32.5L25.0715 26.2C24.5715 26.6 23.9965 26.9167 23.3465 27.15C22.6965 27.3833 22.0048 27.5 21.2715 27.5C19.4548 27.5 17.9173 26.8708 16.659 25.6125C15.4007 24.3542 14.7715 22.8167 14.7715 21C14.7715 19.1833 15.4007 17.6458 16.659 16.3875C17.9173 15.1292 19.4548 14.5 21.2715 14.5C23.0882 14.5 24.6257 15.1292 25.884 16.3875C27.1423 17.6458 27.7715 19.1833 27.7715 21C27.7715 21.7333 27.6548 22.425 27.4215 23.075C27.1882 23.725 26.8715 24.3 26.4715 24.8L32.7715 31.1L31.3715 32.5ZM21.2715 25.5C22.5215 25.5 23.584 25.0625 24.459 24.1875C25.334 23.3125 25.7715 22.25 25.7715 21C25.7715 19.75 25.334 18.6875 24.459 17.8125C23.584 16.9375 22.5215 16.5 21.2715 16.5C20.0215 16.5 18.959 16.9375 18.084 17.8125C17.209 18.6875 16.7715 19.75 16.7715 21C16.7715 22.25 17.209 23.3125 18.084 24.1875C18.959 25.0625 20.0215 25.5 21.2715 25.5Z" fill="#009FC6"/>
                  </g>
                </svg>

                <!--<form role="search" id="header-site-search" method="get" action="<?php echo get_site_url() ?>">
                  //TODO <span aria-hidden="true" class="focus-detection fillall"></span>
                  <label for="desktop_search" class="sr-only">Search</label>
                  <input type="search" placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="off" id="desktop_search" spellcheck="false" name="s" />
                  <button type="submit" aria-label="search">
                  <svg aria-hidden="true" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M16.627 16.3103L11.543 11.2263M13.2376 6.98967C13.2376 10.2654 10.5821 12.921 7.30632 12.921C4.03054 12.921 1.375 10.2654 1.375 6.98967C1.375 3.71389 4.03054 1.05835 7.30632 1.05835C10.5821 1.05835 13.2376 3.71389 13.2376 6.98967Z" stroke="#009FC6" stroke-width="1.81934" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                  </button>
                </form>
                -->
              </div>
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
<!-- search-is-open : class when container is open -->
<div class="site-header__search-container">
      <form action="/" method="get">
         <div class="site-header__search-icon-input" tabindex="0" aria-label="Search Reade">
            <svg class="site-header__search-icon width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <mask id="mask0_6982_209" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="25">
              <rect y="0.300415" width="24" height="24" fill="#D9D9D9"/>
              </mask>
              <g mask="url(#mask0_6982_209)">
              <path d="M17.2503 10.7241C17.2503 12.2303 16.7613 13.6216 15.9377 14.7504L20.092 18.908C20.5022 19.3181 20.5022 19.9843 20.092 20.3945C19.6818 20.8046 19.0157 20.8046 18.6055 20.3945L14.4512 16.2369C13.3224 17.0638 11.9311 17.5495 10.4249 17.5495C6.6546 17.5495 3.59961 14.4945 3.59961 10.7241C3.59961 6.9538 6.6546 3.8988 10.4249 3.8988C14.1953 3.8988 17.2503 6.9538 17.2503 10.7241ZM10.4249 15.4494C11.0455 15.4494 11.6599 15.3271 12.2332 15.0897C12.8065 14.8522 13.3274 14.5042 13.7662 14.0654C14.205 13.6266 14.553 13.1057 14.7905 12.5324C15.028 11.9591 15.1502 11.3447 15.1502 10.7241C15.1502 10.1036 15.028 9.48916 14.7905 8.91587C14.553 8.34258 14.205 7.82167 13.7662 7.38289C13.3274 6.94412 12.8065 6.59606 12.2332 6.35859C11.6599 6.12113 11.0455 5.99891 10.4249 5.99891C9.80442 5.99891 9.18997 6.12113 8.61667 6.35859C8.04338 6.59606 7.52248 6.94412 7.0837 7.38289C6.64492 7.82167 6.29686 8.34258 6.0594 8.91587C5.82193 9.48916 5.69971 10.1036 5.69971 10.7241C5.69971 11.3447 5.82193 11.9591 6.0594 12.5324C6.29686 13.1057 6.64492 13.6266 7.0837 14.0654C7.52248 14.5042 8.04338 14.8522 8.61667 15.0897C9.18997 15.3271 9.80442 15.4494 10.4249 15.4494Z" fill="#004455"/>
              </g>
            </svg>

            <input aria-label="Reade Search Input" class="site-header__search-input" type="search" name="s" autocomplete="off" placeholder="Search" value="<?php echo is_search() ? get_search_query() : ''; ?>">
            <span class="site-header__search-clear" tabindex="0" aria-label="Clear Search">clear</span>
         </div>
         <div class="site-header__search-close" tabindex="0" aria-label="Close Search, Press Escape" role="button">
         <svg width="68" height="44" viewBox="0 0 68 44" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect y="0.800415" width="68" height="43" rx="6" fill="#CFEEF7"/>
<mask id="mask0_6982_218" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="22" y="10" width="24" height="25">
<rect x="22" y="10.3004" width="24" height="24" fill="#D9D9D9"/>
</mask>
<g mask="url(#mask0_6982_218)">
<path d="M40.7736 17.5597C41.3359 16.9974 41.3359 16.0844 40.7736 15.5221C40.2114 14.9599 39.2983 14.9599 38.7361 15.5221L33.9998 20.2629L29.259 15.5266C28.6968 14.9644 27.7837 14.9644 27.2215 15.5266C26.6592 16.0889 26.6592 17.0019 27.2215 17.5642L31.9623 22.3005L27.226 27.0412C26.6637 27.6035 26.6637 28.5166 27.226 29.0788C27.7882 29.641 28.7013 29.641 29.2635 29.0788L33.9998 24.338L38.7406 29.0743C39.3028 29.6365 40.2159 29.6365 40.7781 29.0743C41.3404 28.5121 41.3404 27.599 40.7781 27.0367L36.0373 22.3005L40.7736 17.5597Z" fill="#009FC6"/>
</g>
</svg>

         </div>
      </form>
   </div>

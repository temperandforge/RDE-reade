<?php
if(!defined('option_fields')) { //TODO
  $option_fields = get_fields('options'); 
} 
?>

<div class="navbar-wrap">
  <div class="main">
    <div class="inner-wrap">
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
        <button id="toggle_nav" class="toggle-nav">
          <em class="hamburger">
          <div></div>
          <div></div>
          <div></div>
          </em>
          <span class="sr-only visually-hidden">Toggle mobile menu</span>
        </button>
      </div>
    </div>
  </div>
</div>

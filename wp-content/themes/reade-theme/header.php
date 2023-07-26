<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- //TODO -->
  <!-- <meta 
    http-equiv="Content-Security-Policy" 
    content="
      default-src 'self'; 
      img-src 'self' data: https://reade.wpengine.com https://reade.com https://secure.gravatar.com; 
      style-src 'self' 'unsafe-inline' https:; 
      font-src 'self' https://fonts.gstatic.com https://use.typekit.net data:; 
      script-src 'self' 'unsafe-inline' https:; 
      object-src 'none'; 
      "> -->
   <!-- require-trusted-types-for 'script'; trusted-types default; -->
  <?php wp_head(); ?>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <!-- September Font -->
  <link href="https://use.typekit.net/fvv7hkq.css" rel="stylesheet">
  <!-- <link 
      rel="preload" 
      as="style" 
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" 
      onload="this.onload=null;this.rel='stylesheet';"
      >
  <noscript>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet" type="text/css">
  </noscript> -->

   <style>
      .mobile-mepnu.loading,
      .mobile-menu.loading .sub-menu {
         display: none;
      }
   </style>

  <?php // fix slideout logged in style ?>
  <?php if (is_user_logged_in()) { ?>
  <style>
  @media screen and (max-width: 600px) {
    #wpadminbar {
      position: fixed !important;
    }
  }
  </style>
  <?php } ?>
</head>

<body <?php body_class(); ?>>
  <a href="#main-content" class="sr-only"><?php echo __("Skip to main content", TEXTDOMAIN); ?></a>
  <?php include( locate_template( 'template-parts/mobile-nav.php', false, false ) );  ?>
  <?php include( locate_template( 'template-parts/desktop-nav.php', false, false ) );  ?>

  <?php

  if (is_woocommerce()) {
    $options = get_fields('options');
    ?>
    <div id="add-to-quote-success" class="lity-hide">
      <svg class="add-to-quote-success-close" width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg" data-lity-close>
        <circle cx="18.2539" cy="17.5269" r="17.3652" fill="#CFEEF7"/>
        <path d="M22.9615 14.2339L19.6685 17.5269L22.9615 20.8199C23.057 20.9122 23.1332 21.0225 23.1856 21.1445C23.238 21.2665 23.2656 21.3978 23.2667 21.5305C23.2679 21.6633 23.2426 21.795 23.1923 21.9179C23.142 22.0408 23.0678 22.1524 22.9739 22.2463C22.88 22.3402 22.7683 22.4145 22.6454 22.4648C22.5225 22.515 22.3909 22.5403 22.2581 22.5392C22.1253 22.538 21.9941 22.5104 21.8721 22.458C21.7501 22.4056 21.6397 22.3294 21.5475 22.2339L18.2545 18.9409L14.9615 22.2339C14.8692 22.3294 14.7589 22.4056 14.6369 22.458C14.5149 22.5104 14.3837 22.538 14.2509 22.5392C14.1181 22.5403 13.9864 22.515 13.8635 22.4648C13.7406 22.4145 13.629 22.3402 13.5351 22.2463C13.4412 22.1524 13.3669 22.0408 13.3167 21.9179C13.2664 21.795 13.2411 21.6633 13.2422 21.5305C13.2434 21.3978 13.271 21.2665 13.3234 21.1445C13.3758 21.0225 13.452 20.9122 13.5475 20.8199L16.8405 17.5269L13.5475 14.2339C13.452 14.1417 13.3758 14.0313 13.3234 13.9093C13.271 13.7873 13.2434 13.6561 13.2422 13.5233C13.2411 13.3906 13.2664 13.2589 13.3167 13.136C13.3669 13.0131 13.4412 12.9014 13.5351 12.8075C13.629 12.7136 13.7406 12.6394 13.8635 12.5891C13.9864 12.5388 14.1181 12.5135 14.2509 12.5147C14.3837 12.5158 14.5149 12.5434 14.6369 12.5958C14.7589 12.6482 14.8692 12.7244 14.9615 12.8199L18.2545 16.1129L21.5475 12.8199C21.6397 12.7244 21.7501 12.6482 21.8721 12.5958C21.9941 12.5434 22.1253 12.5158 22.2581 12.5147C22.3909 12.5135 22.5225 12.5388 22.6454 12.5891C22.7683 12.6394 22.88 12.7136 22.9739 12.8075C23.0678 12.9014 23.142 13.0131 23.1923 13.136C23.2426 13.2589 23.2679 13.3906 23.2667 13.5233C23.2656 13.6561 23.238 13.7873 23.1856 13.9093C23.1332 14.0313 23.057 14.1417 22.9615 14.2339Z" fill="#004455"/>
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
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.63128C12.348 6.28957 12.902 6.28957 13.2437 6.63128L16.7437 10.1313C17.0854 10.473 17.0854 11.027 16.7437 11.3687L13.2437 14.8687C12.902 15.2104 12.348 15.2104 12.0063 14.8687C11.6646 14.527 11.6646 13.973 12.0063 13.6313L14.0126 11.625H3.875C3.39175 11.625 3 11.2332 3 10.75C3 10.2668 3.39175 9.875 3.875 9.875H14.0126L12.0063 7.86872C11.6646 7.52701 11.6646 6.97299 12.0063 6.63128Z" fill="white"/>
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
                <a class="btn-green-light-green btn-arrow" href="<?php echo $options['atqs_bottom_button']['url']; ?>">
                  <?php echo $options['atqs_bottom_button']['title']; ?>
                  <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 6.63128C12.348 6.28957 12.902 6.28957 13.2437 6.63128L16.7437 10.1313C17.0854 10.473 17.0854 11.027 16.7437 11.3687L13.2437 14.8687C12.902 15.2104 12.348 15.2104 12.0063 14.8687C11.6646 14.527 11.6646 13.973 12.0063 13.6313L14.0126 11.625H3.875C3.39175 11.625 3 11.2332 3 10.75C3 10.2668 3.39175 9.875 3.875 9.875H14.0126L12.0063 7.86872C11.6646 7.52701 11.6646 6.97299 12.0063 6.63128Z" fill="white"/>
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

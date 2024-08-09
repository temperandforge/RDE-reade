<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script>
  if (window.location.href.includes('lang=es')) {
    if (!window.location.href.includes('lang-set=1')) {
      // Set the cookie named "googtrans" with the value "/en/es"
      document.cookie = "googtrans=/en/es; path=/";
        
      // Reload the page
    document.location.href = window.location.href.replace('?lang=es', '?lang-set=1');
    }
  }
  </script>
  
  <?php
   
   wp_head();

   /**
    * Load recaptcha if contact form 7 is not present
    *
    * We will load specific javascript in the footer to check for recaptcha responses */
   global $post;

   if (! empty($post->post_content) && ! has_shortcode($post->post_content, 'contact-form-7')) {
      ?>
      <link rel="preconnect" href="https://www.google.com">
      <link rel="preconnect" href="https://www.gstatic.com" crossorigin>
      <script async src="https://www.google.com/recaptcha/api.js?render=6LfEWw8pAAAAAHc07h0kwQDiqZJPDCm2J0CTJACT"></script>
      <?php
   }
  ?>

  <?php

  if (!empty(get_field('gtm_head', 'options'))) {
    echo get_field('gtm_head', 'options');
  }

  ?>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

   <style>
      .mobile-menu.loading {
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
  <?php }
  $headers = array(
    "X-Custom-Header: website-",
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
);

  ?>
</head>

<body <?php body_class(); ?>>
  <a href="#main-content" class="sr-only"><?php echo __("Skip to main content", TEXTDOMAIN); ?></a>
  <?php include( locate_template( 'template-parts/mobile-nav.php', false, false ) );  ?>
  <?php include( locate_template( 'template-parts/desktop-nav.php', false, false ) );  ?>

  

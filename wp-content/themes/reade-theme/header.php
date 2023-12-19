<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- //TODO -->
  <!-- <meta 
    http-equiv="Content-Security-Policy" 
    content="
      default-src 'self'; 
      font-src 'self' data: https://fonts.gstatic.com https://use.typekit.net;
      img-src 'self' data: https://reade.wpengine.com https://secure.gravatar.com https://cdn.gtranslate.net; 
      script-src 'self' 
         <?php if( IS_LOCAL ) { 
            //echo "'unsafe-inline' "; 
         } else { ?>
         'sha256-iIr4q36PyVNA4P4kimvb9AsD9EFSN7S2a4jm9KEWYVY='
         'sha256-h3JABsExOt/n2fHKR4py5RBf4T0cY4tvadWA77p+o5U='
         'sha256-eHL/Izx7K/qWL0kdBXXnHwsLSHvGOJn/THLHydUZdog='
         'sha256-KwnvQTtu+yCN5S8WrJoU8oBC9+DiEu1pg4UQMZvl/7s='
         'sha256-CSpeNcGc9mEwoH8pqbdZxgIRVwNBbSE+avwsgADJvKs='
         'sha256-m16ZMcWtXyc/TG61mIUG72BHGVeSMSSyiqsvhWPot/0='
         'sha256-ATiVyhKFjD/l50SVfcO+fYyrXiz2OhpfZ0TBjlZjJD0='
         'sha256-7nWgRnpVWats471LIIVH3brFWOVH5nnnE+mUbHZHu58='
         'sha256-8//zSBdstORCAlBMo1/Cig3gKc7QlPCh9QfWbRu0OjU='
         'sha256-hfXxIc+s7Zu1qVWEelLpqI6o0fB18XBEV6qabda2aE0='
         'sha256-lRjvU+Ovjmmxf3/997fldyACVfnepKrNmyg7/ilu5AY='
         'sha256-tyAYsFWvk5C2Ynwfe+8NWzoBt1ZLMJ6QoAVaagpipmk='
         'sha256-snvaDPzOaWCFbnG/Ad1l9+3xD3fOHnY16CK1OttdP8g='
         'sha256-C3tzgmdqHbOPCAFKoc9ZVI4dX8DzBPS1Fxh2Tmbm0/8='
         'sha256-GVoG8PgoLPPEO3dbynO+c/p9gw/pB3P9zxhbgWC4BL8='
         <?php
         }
         //echo 'https://cdnjs.cloudflare.com https://translate.google.com/'; ?>
      ; 
      style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com https://p.typekit.net https://use.typekit.net; 
      object-src 'none'; 
      "> -->
      <!-- require-trusted-types-for 'script'; -->
      <?php
      
      wp_head();

      /**
       * Load recaptcha if contact form 7 is not present
       *
       * We will load specific javascript in the footer to check for recaptcha responses */
      global $post;

      if (!has_shortcode($post->post_content, 'contact-form-7')) {
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
  <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet"> -->
  <!-- September Font -->
  <!-- <link rel="stylesheet" href="https://use.typekit.net/gll2aqr.css"> -->
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
  <?php } ?>
</head>

<body <?php body_class(); ?>>
  <a href="#main-content" class="sr-only"><?php echo __("Skip to main content", TEXTDOMAIN); ?></a>
  <?php include( locate_template( 'template-parts/mobile-nav.php', false, false ) );  ?>
  <?php include( locate_template( 'template-parts/desktop-nav.php', false, false ) );  ?>

  

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      .mobile-menu.loading,
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
  <a href="#main_content" class="sr-only"><?php echo __("Skip to main content", TEXTDOMAIN); ?></a>
  <?php include( locate_template( 'template-parts/mobile-nav.php', false, false ) );  ?>
  <?php include( locate_template( 'template-parts/desktop-nav.php', false, false ) );  ?>

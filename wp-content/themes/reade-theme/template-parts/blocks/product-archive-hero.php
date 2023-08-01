<?php

if (is_archive()) {
  $fields = $args;
} else {
  $fields = get_fields();
}

$options = get_fields('options');

?>
<div class="product-archive-hero">
  <div class="pah-top bg-light-blue">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/reade-logo.svg" class="pah-top-decor" alt="Reade Logo" width="1515" height="500">
    <div class="pah-top-container">
      <div class="pah-top-container-top">
        <?php

        if (!empty($fields['headline'])) {
          ?>
          <h1 class="pah-headline"><?php echo $fields['headline']; ?></h1>
          <?php
        }

        if (!empty($fields['text'])) {
          ?>
          <p class="pah-text"><?php echo $fields['text']; ?></p>
          <?php
        }

        ?>
      </div>
      <?php

      if (!empty($fields['applications'])) {
        ?>
        <div class="pah-top-container-bottom">
          <?php

          foreach ($fields['applications'] AS $app) {
            ?>
            <div class="pah-application"><?php echo $app['application']; ?></div>
            <?php
          }

          ?>
        </div>
        <?php
      }

      if (!empty($fields['image'])) {
        ?>
        <div class="pah-image-mobile">
          <img src="<?php echo $fields['image']['sizes']['large']; ?>" alt="<?php echo $fields['image']['alt']; ?>" width="<?php echo $fields['image']['sizes']['large-width']; ?>" height="<?php echo $fields['image']['sizes']['large-height']; ?>">
        </div>
        <?php
      } else {
        if (!empty($options['category_fallback_image']['url'])) {
          ?>
          <div class="pah-image-mobile">
            <img src="<?php echo $options['category_fallback_image']['sizes']['medium_large']; ?>" alt="<?php echo $product_category->name; ?> Category" width="<?php echo $options['category_fallback_image']['sizes']['medium_large-width']; ?>" height="<?php echo $options['category_fallback_image']['sizes']['medium_large-height']; ?>">
          </div>
          <?php
        }
      }

  ?>
    </div>
  </div>
  <?php

  if (!empty($fields['image'])) {
    ?>
    <div class="pah-image">
      <img src="<?php echo $fields['image']['sizes']['large']; ?>" alt="<?php echo $fields['image']['alt']; ?>" width="<?php echo $fields['image']['sizes']['large-width']; ?>" height="<?php echo $fields['image']['sizes']['large-height']; ?>">
    </div>
    <?php
  } else {
    if (!empty($options['category_fallback_image']['url'])) {
          ?>
          <div class="pah-image">
            <img src="<?php echo $options['category_fallback_image']['sizes']['medium_large']; ?>" alt="<?php echo $product_category->name; ?> Category" width="<?php echo $options['category_fallback_image']['sizes']['medium_large-width']; ?>" height="<?php echo $options['category_fallback_image']['sizes']['medium_large-height']; ?>">
          </div>
          <?php
        }
  }

  ?>

</div>
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
      <a href="/products/" class="btn-light-blue-blue-alt btn-arrow-reverse">
          <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M4.99372 0.881282C4.65201 0.539573 4.09799 0.539573 3.75628 0.881282L0.256282 4.38128C-0.0854273 4.72299 -0.0854273 5.27701 0.256282 5.61872L3.75628 9.11872C4.09799 9.46043 4.65201 9.46043 4.99372 9.11872C5.33543 8.77701 5.33543 8.22299 4.99372 7.88128L2.98744 5.875H13.125C13.6082 5.875 14 5.48325 14 5C14 4.51675 13.6082 4.125 13.125 4.125H2.98744L4.99372 2.11872C5.33543 1.77701 5.33543 1.22299 4.99372 0.881282Z" fill="#009FC6"/>
</svg>
          <?php echo !empty($options['back_to_all_products_text']) ? $options['back_to_all_products_text'] : 'Back To All Products'; ?>
        </a>
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
          <img src="<?php echo $fields['image']['sizes']['large']; ?>" alt="<?php echo $fields['image']['alt']; ?>" width="<?php echo $fields['image']['sizes']['large-width']; ?>" height="<?php echo $fields['image']['sizes']['large-height']; ?>" loading="eager">
        </div>
        <?php
      } else {
        if (!empty($options['category_fallback_image']['url'])) {
          ?>
          <div class="pah-image-mobile">
            <img src="<?php echo $options['category_fallback_image']['sizes']['medium_large']; ?>" alt="<?php echo $product_category->name; ?> Category" width="<?php echo $options['category_fallback_image']['sizes']['medium_large-width']; ?>" height="<?php echo $options['category_fallback_image']['sizes']['medium_large-height']; ?>" loading="eager">
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
      <img src="<?php echo $fields['image']['sizes']['large']; ?>" alt="<?php echo $fields['image']['alt']; ?>" width="<?php echo $fields['image']['sizes']['large-width']; ?>" height="<?php echo $fields['image']['sizes']['large-height']; ?>" loading="eager">
    </div>
    <?php
  } else {
    if (!empty($options['category_fallback_image']['url'])) {
          ?>
          <div class="pah-image">
            <img src="<?php echo $options['category_fallback_image']['sizes']['medium_large']; ?>" alt="<?php echo $product_category->name; ?> Category" width="<?php echo $options['category_fallback_image']['sizes']['medium_large-width']; ?>" height="<?php echo $options['category_fallback_image']['sizes']['medium_large-height']; ?>" loading="eager">
          </div>
          <?php
        }
  }

  ?>

</div>
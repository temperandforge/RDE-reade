<?php

$fields = get_fields();
global $product;

$terms = wp_get_post_terms($product->get_id(), 'product_cat');
$term_ids = array();
$related_products = '';

if (!empty($terms)) {
  foreach ($terms AS $term) {
    $term_ids[] = $term->term_id;
  }

  $args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => 9,
    'post__not_in' => array($product->get_id()),
    'tax_query' => array(
        array(
          'taxonomy' => 'product_cat',
          'field' => 'term_id',
          'terms' => $term_ids,
          'operator' => 'IN',
        ),
      ),
      'meta_query'     => array(
        array(
          'key'     => 'is_main_product',
          'value'   => true,
          'compare' => '='
        ),
    ),
  );

  $related_products = new WP_Query($args);

}

if (!empty($related_products)) {
  $count = count($related_products->posts);
  ?>
  <div class="product-related-products">
    <h4 class="prp-title"><?php echo !empty($fields['related_products_text']) ? $fields['related_products_text'] : 'Related Products'; ?></h4>
    <div class="prp-container">
      <?php

      foreach ($related_products->posts AS $product) {
        $product = new WC_Product($product->ID);
        $permalink = $product->get_permalink();
        $image = get_the_post_thumbnail($product->get_id(), 'medium');

        ?>
        <div class="prp-product">
          <a class="fillall" href="<?php echo $permalink; ?>">
            <span class="sr-only">View <?php echo $product->get_name(); ?></span>
          </a>
          <?php

          if ($image) {
            echo $image;
          } else {
            $image = get_field('default_product_image', 'options');

            if (!empty($image)) {
              ?>
              <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['sizes']['medium_width']; ?>" height="<?php echo $image['sizes']['medium_height']; ?>">
              <?php
            }
        }
        
        echo $product->get_name(); ?>
        </div>
        <?php
      }

      ?>
    </div>
    <?php

    if ($count > 3) {
      ?>
      <a class="btn-blue-dark-blue" href="javascript: void(0);" id="prp-load-more"><?php

      echo !empty($fields['load_more_button_text']) ? $fields['load_more_button_text'] : 'Load More';

      ?>
      </a>
      <?php
    }

    ?>
  </div>
  <?php
}
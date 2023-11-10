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

  if (ALL_PRODUCTS_CAT_ID) {
    $term_ids = array_filter($term_ids, function ($element) {
      return $element !== ALL_PRODUCTS_CAT_ID;
    });
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

if (!empty($related_products->posts)) {
  $count = count($related_products->posts);
  ?>
  <div class="product-related-products">
    <h3 class="prp-title"><?php echo !empty($fields['related_products_text']) ? $fields['related_products_text'] : 'Related Products'; ?></h3>
    <div class="prp-container">
      <?php

      foreach ($related_products->posts AS $product) {
        $product = new WC_Product($product->ID);
        $permalink = $product->get_permalink();
        $desc = $product->get_short_description();

        ?>
        <div class="prp-product">
          <div class="prp-product-container">
            <a class="fillall" href="<?php echo $permalink; ?>">
              <span class="sr-only">View <?php echo $product->get_name(); ?></span>
            </a>
            <div class="prp-product-name">
              <?php echo $product->get_name(); ?>
            </div>
            <div class="prp-product-desc">
              <?php echo $desc; ?>
            </div>
            <div class="prp-product-view">
              <button class="btn-light-blue-blue btn-arrow">
                View Product
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.88128C12.348 5.53957 12.902 5.53957 13.2437 5.88128L16.7437 9.38128C17.0854 9.72299 17.0854 10.277 16.7437 10.6187L13.2437 14.1187C12.902 14.4604 12.348 14.4604 12.0063 14.1187C11.6646 13.777 11.6646 13.223 12.0063 12.8813L14.0126 10.875H3.875C3.39175 10.875 3 10.4832 3 10C3 9.51675 3.39175 9.125 3.875 9.125H14.0126L12.0063 7.11872C11.6646 6.77701 11.6646 6.22299 12.0063 5.88128Z" fill="#009FC6"/>
                </svg>

              </button>
            </div>
            
          </div>
        </div>
        <?php
      }

      ?>
    </div>
    <?php

    if ($count > 3) {
      ?>
      <button class="btn-blue-dark-blue" href="javascript: void(0);" id="prp-load-more"><?php

      echo !empty($fields['load_more_button_text']) ? $fields['load_more_button_text'] : 'Load More';

      ?>
      </button>
      <?php
    }

    ?>
  </div>
  <?php
}
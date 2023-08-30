<?php

$fields = get_fields();
global $product;


if (!empty($_GET['from'])) {

   $from = (int) $_GET['from'];
   $fromObj = get_term($from, 'product_cat');

   if ($fromObj) {
      $back_button_text = 'Back to ' . $fromObj->name;
      $back_button_link = get_term_link(get_term($fromObj->term_id, 'product_cat'), 'product_cat');
   } else {
      $back_button_text = 'Back to All Products';
      $back_button_link = get_site_url() . '/products/';
   }
} else {

   $back_button_text = 'Back to All Products';
   $back_button_link = get_site_url() . '/products/';
}

?>
<a class="btn-white-blue btn-arrow-reverse ph-btn" href="<?php echo $back_button_link; ?>">
   <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
   <path fill-rule="evenodd" clip-rule="evenodd" d="M8.49372 6.01214C8.15201 5.67043 7.59799 5.67043 7.25628 6.01214L3.75628 9.51214C3.41457 9.85385 3.41457 10.4079 3.75628 10.7496L7.25628 14.2496C7.59799 14.5913 8.15201 14.5913 8.49372 14.2496C8.83543 13.9079 8.83543 13.3538 8.49372 13.0121L6.48744 11.0059H16.625C17.1082 11.0059 17.5 10.6141 17.5 10.1309C17.5 9.64761 17.1082 9.25586 16.625 9.25586H6.48744L8.49372 7.24958C8.83543 6.90787 8.83543 6.35385 8.49372 6.01214Z" fill="#009FC6"/>
   </svg>
   <?php echo $back_button_text; ?>
</a>

<div class="product-hero">

   <div class="bg-geometric bg-light-blue-100">
      &nbsp;
   </div>
   
            
   <div class="product-hero-container">
         <div class="product-hero-content">
            <a class="ph-btn-mobile btn-white-blue btn-arrow-reverse" href="<?php echo $back_button_link; ?>">
               <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M8.49372 6.01214C8.15201 5.67043 7.59799 5.67043 7.25628 6.01214L3.75628 9.51214C3.41457 9.85385 3.41457 10.4079 3.75628 10.7496L7.25628 14.2496C7.59799 14.5913 8.15201 14.5913 8.49372 14.2496C8.83543 13.9079 8.83543 13.3538 8.49372 13.0121L6.48744 11.0059H16.625C17.1082 11.0059 17.5 10.6141 17.5 10.1309C17.5 9.64761 17.1082 9.25586 16.625 9.25586H6.48744L8.49372 7.24958C8.83543 6.90787 8.83543 6.35385 8.49372 6.01214Z" fill="#009FC6"/>
               </svg>
               <?php echo $back_button_text; ?>
            </a>

            <?php

            $categories = get_the_terms($product->get_id(), 'product_cat');

            if (!empty($categories)) {
               ?>
               <div class="product-hero-categories">
                  <?php

                  foreach ($categories AS $cat) {
                     ?>
                     <div class="product-hero-category">
                        <?php
                        echo $cat->name;
                        ?>
                     </div>
                     <?php
                  }

                  ?>
               </div>
               <?php
            }

            ?>
            <h1 class="product-hero-title"><?php echo str_replace(array('®'), array('<sup>®</sup>'), $product->get_name()); ?></h1>

            <?php

            if (!empty($fields['product_description'])) {
               ?>
               <div class="product-hero-description">
                  <?php echo $fields['product_description']; ?>
               </div>
               <?php
            }

            ?>
         </div>
      </div>
</div>
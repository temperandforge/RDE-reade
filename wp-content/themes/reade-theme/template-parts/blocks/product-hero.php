<?php

$fields = get_fields();
global $product;

?>
<div class="product-hero">
   <div class="bg-geometric bg-light-blue-100">
      &nbsp;
   </div>
   <div class="product-hero-container">
         <div class="product-hero-content">
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
            <h1 class="product-hero-title"><?php echo $product->get_name(); ?></h1>

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
<?php

$fields = get_fields();

?>
<div class="product-archive-block">
   <div class="pab-top">
      <?php

      if (!empty($fields['headline'])) {
         ?>
         <h2 class="pab-headline"><?php echo $fields['headline']; ?></h2>
         <?php
      }

      if (!empty($fields['text'])) {
         ?>
         <div class="pab-text">
            <?php echo $fields['text']; ?>
         </div>
         <?php
      }

      ?>
   </div>

   <div class="pab-filters">
      <div class="pab-filters-left">
         <?php

         $filter1_options = array(
            'id' => 'filter1'
         );

         $filter2_options = array(
            'id' => 'filter2'
         );

         $filter3_options = array(
            'id' => 'filter3'
         );

         tf_dropdown($filter1_options);
         tf_dropdown($filter2_options);
         tf_dropdown($filter3_options);

         ?>
      </div>
      <div class="pab-filters-right">
         right
      </div>
   </div>
</div>
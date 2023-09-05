<?php

$fields = get_fields();

?>
<div class="dual-column-cta">
   <div class="dual-column-cta-container">
      <div class="dual-column-cta-container-left">
         <?php

         if (!empty($fields['left_column_heading'])) {
            ?>
            <h3><?php echo $fields['left_column_heading']; ?></h3>
            <?php
         }

         if (!empty($fields['left_column_text'])) {
            ?>
            <p><?php echo $fields['left_column_text']; ?></p>
            <?php
         }

         if (!empty($fields['left_column_button'])) {
            ?>
            <a class="btn-blue-dark-blue" href="<?php echo $fields['left_column_button']['url']; ?>" <?php if (!empty($fields['left_column_button']['target'])) { ?> target="_blank"<?php } ?>><?php echo $fields['left_column_button']['title']; ?></a>
            <?php
         }

         ?>
      </div>
      <div class="dual-column-cta-container-right">
         <?php

         if (!empty($fields['right_column_heading'])) {
            ?>
            <h3><?php echo $fields['right_column_heading']; ?></h3>
            <?php
         }

         if (!empty($fields['right_column_text'])) {
            ?>
            <p><?php echo $fields['right_column_text']; ?></p>
            <?php
         }

         if (!empty($fields['right_column_button'])) {
            ?>
            <a class="btn-blue-dark-blue" href="<?php echo $fields['right_column_button']['url']; ?>" <?php if (!empty($fields['right_column_button']['target'])) { ?> target="_blank"<?php } ?>><?php echo $fields['right_column_button']['title']; ?></a>
            <?php
         }

         ?>
      </div>
   </div>
</div>
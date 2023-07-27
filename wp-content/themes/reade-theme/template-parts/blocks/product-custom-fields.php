<?php

$fields = get_fields();

if (!empty($fields['custom_fields'])) {
   ?>
   <div class="product-custom-fields">
      <?php

      foreach ($fields['custom_fields'] AS $cf) {
         if (!empty($cf['title']) && !empty($cf['text'])) {
            ?>
            <div class="product-custom-fields-title">
               <span><?php echo $cf['title']; ?></span>
               <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M3.80493 7.79459C3.53156 7.52122 3.53156 7.078 3.80493 6.80464L8.00493 2.60464C8.2783 2.33127 8.72151 2.33127 8.99488 2.60464L13.1949 6.80464C13.4682 7.078 13.4682 7.52122 13.1949 7.79458C12.9215 8.06795 12.4783 8.06795 12.2049 7.79458L9.1999 4.78956L9.1999 12.8996C9.1999 13.2862 8.8865 13.5996 8.4999 13.5996C8.1133 13.5996 7.7999 13.2862 7.7999 12.8996L7.7999 4.78956L4.79488 7.79459C4.52151 8.06795 4.0783 8.06795 3.80493 7.79459Z" fill="#006078"/>
               </svg>
            </div>
            <div class="product-custom-fields-text"><?php echo $cf['text']; ?></div>
            <?php
         }
      }

      ?>
   </div>
   <?php
}
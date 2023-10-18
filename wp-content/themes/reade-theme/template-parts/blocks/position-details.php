<?php
// Block preview
if (!empty($block['data']['_is_preview'])) {
?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Position Details Block">
   </figure>
<?php
} else if ($fields = get_fields() ?: []) {

?>
<aside class="in-page-nav psuedo-select">
                  <p class="psuedo-select-active">
                     <span><?php echo __("Select", TEXTDOMAIN);?></span>
                     <svg class="svg-arrow-down" aria-hidden="true" width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M0.519284 0.965493C0.28888 1.17537 0.272236 1.53228 0.482109 1.76269L5.25031 6.99734C5.35724 7.11473 5.50869 7.18164 5.66749 7.18164C5.82629 7.18164 5.97774 7.11473 6.08467 6.99734L10.8529 1.76268C11.0627 1.53228 11.0461 1.17537 10.8157 0.965492C10.5853 0.755619 10.2284 0.772263 10.0185 1.00267L5.66749 5.77932L1.31648 1.00267C1.1066 0.772264 0.749688 0.75562 0.519284 0.965493Z" fill="#004455"/> </svg>
                  </p>
                  <nav class="pseudo-select-nav">
                     <ul class="pseudo-select-menu--list"></ul>
                  </nav>
               </aside>

   <div class="position-details">
      <?php

      $position_parts = array('about_reade', 'job_purpose', 'job_description', 'requirements', 'benefits', 'eoe');

      foreach ($position_parts AS $part) {
         ?>
         <div class="position-details-part">
            <?php
            if (!empty($fields[$part])) {
               echo $fields[$part];
            }
            ?>
         </div>
         <?php
      }

      ?>
   </div>

<?php
} ?>

<?php
// Block preview
if (!empty($block['data']['_is_preview'])) {
?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Benefits Block">
   </figure>
<?php
} else if ($fields = get_fields() ?: []) {

?>

   <div class="dual-block--section">
      <div class="dual-block--main">
         <div class="dual-block--inner">
            <div class="dual-block--wrap<?php echo ($fields['image_left'] === true) ? ' reverse' : null; ?>">
               <div class="dual-block--first">
                  <?php if (!empty($fields['heading'])) : ?>
                     <h2><?php echo $fields['heading']; ?></h2>
                  <?php endif; ?>
                  <?php if (!empty($fields['content'])) : ?>
                     <p><?php echo $fields['content']; ?></p>
                  <?php endif; ?>
                  <?php if (!empty($fields['link'])) : ?>
                     <a href="<?php echo $fields['link']['title']; ?>" target="<?php echo $fields['link']['target'] ?: '_self'; ?>" class="btn-blue-dark-blue">
                        <?php echo $fields['link']['title']; ?>
                     </a>
                  <?php endif; ?>
               </div>
               <div class="dual-block--second">
                  <figure>
                     <?php echo wp_get_attachment_image($fields['image']['id'], 'full'); ?>
                  </figure>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php
} ?>

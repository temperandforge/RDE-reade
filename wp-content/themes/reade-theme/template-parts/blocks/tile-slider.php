<?php
// Block preview
if (!empty($block['data']['_is_preview'])) {
?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/image.webp" alt="Preview of Benefits Block">
   </figure>
<?php
} else if ($fields = get_fields() ?: []) {

   $tileCount = count($fields['tiles'])

?>


   <div class="tile-slider--section">
      <div class="tile-slider--main">
         <div class="tile-slider--inner">
            <?php if (!empty($fields['heading']) || !empty($fields['content'])) : ?>
               <div class="tile-slider--heading">
                  <?php if (!empty($fields['heading'])) : ?>
                     <h2><?php echo $fields['heading']; ?></h2>
                  <?php endif; ?>
                  <?php if (!empty($fields['content'])) : ?>
                     <p><?php echo $fields['content']; ?></p>
                  <?php endif; ?>
               </div>
            <?php endif; ?>
            <div class="tile-slider--wrapper">
               <div class="tile-slider--slider">
                  <?php foreach ($fields['tiles'] as $tile) : ?>
                     <div class="tile-slider--slide">
                        <p><strong><?php echo $tile['heading']; ?></strong></p>
                     </div>
                  <?php endforeach; ?>
               </div>
               <?php if ($fields['icon'] != 'no-svg') : ?>
                  <div class="tile-slider--decor <?php echo $fields['icon']; ?>" aria-hidden="true"></div>
               <?php endif; ?>
            </div>
            <div class="tile-slider--nav<?php echo ($tileCount <= 9) && ($tileCount >= 6) ? ' lg:hidden' : null; ?><?php echo $tileCount <= 6 ? ' hidden' : null; ?>">
               <div class="tile-slider--dots"></div>
               <div class="tile-slider--arrows"></div>
            </div>
            <?php if (!empty($fields['link'])) : ?>
               <div class="tile-slider--link">
                  <a href="<?php echo $fields['link']['url']; ?>" target="<?php echo $fields['link']['target'] ?: '_self'; ?>" class="btn-blue-dark-blue">
                     <?php echo $fields['link']['title']; ?>
                  </a>
               </div>
            <?php endif; ?>
         </div>
      </div>
   </div>


<?php
} ?>

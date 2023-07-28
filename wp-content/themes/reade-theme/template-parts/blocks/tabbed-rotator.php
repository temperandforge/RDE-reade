<?php
// Block preview
if (!empty($block['data']['_is_preview'])) {
?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/image.webp" alt="Preview of Benefits Block">
   </figure>
<?php
} else if ($fields = get_fields() ?: []) {

?>
   <div class="tabbed-rotator--section">
      <div class="tabbed-rotator--main">
         <div class="tabbed-rotator--inner">

            <div class="tabbed-rotator--heading">
               <?php if (!empty($fields['heading'])) : ?>
                  <h2><?php echo $fields['heading']; ?></h2>
               <?php endif; ?>
               <?php if (!empty($fields['content'])) : ?>
                  <p><?php echo $fields['content']; ?></p>
               <?php endif; ?>
            </div>

            <div class="tabbed-rotator-content--wrap closed">
               <div class="tabbed-rotator-nav--wrap">
                  <?php foreach ($fields['tabs'] as $key => $tab) : ?>
                     <?php if ($key === 0) : ?>
                        <button class="current-tab"><?php echo $tab['heading']; ?></button>
                     <?php endif; ?>
                  <?php endforeach; ?>
                  <div class="tabbed-rotator--nav">
                  </div>
               </div>

               <div class="tabbed-rotator--tabs">
                  <?php foreach ($fields['tabs'] as $tab) : ?>
                     <div class="tabbed-rotator--tab" data-title="<?php echo $tab['heading']; ?>">
                        <div class="tabbed-rotator--content<?php echo empty($tab['image']) ? ' single' : null; ?>">
                           <?php if (!empty($tab['heading'])) : ?>
                              <h3><?php echo $tab['heading']; ?></h3>
                           <?php endif; ?>
                           <?php if (!empty($tab['content'])) : ?>
                              <p><?php echo $tab['content']; ?></p>
                           <?php endif; ?>
                           <?php if (!empty($tab['link'])) : ?>
                              <a href="<?php echo $tab['link']['title']; ?>" target="<?php echo $tab['link']['target'] ?: '_self'; ?>" class="btn">
                                 <?php echo $tab['link']['title']; ?>
                              </a>
                           <?php endif; ?>
                        </div>
                        <?php if (!empty($tab['image'])) : ?>
                           <figure class="tabbed-rotator--figure">
                              <?php echo wp_get_attachment_image($tab['image']['id'], 'full'); ?>
                           </figure>
                        <?php endif; ?>
                     </div>
                  <?php endforeach; ?>
               </div>

            </div>

         </div>
      </div>
   </div>

<?php
} ?>

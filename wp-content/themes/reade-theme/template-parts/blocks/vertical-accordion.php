<?php
// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/image.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = get_fields() ?: []) {

?>
   <div class="vertical-accordion--section">
      <div class="vertical-accordion--main">
         <div class="vertical-accordion--inner">
            <div class="vertical-accordion--wrapper">
               <div class="vertical-accordion--accordions">
                  <?php foreach ($fields['accordion_items'] as $index => $item) : ?>
                     <div class="vertical-accordion--accordion">
                        <div class="vertical-accordion-mobile--figure" aria-hidden="true">
                           <figure>
                              <?php echo wp_get_attachment_image($item['image']['ID'], 'large'); ?>
                           </figure>
                        </div>
                        <div class="vertical-accordion--heading">
                           <p class="vertical-accordion--number"><?php echo $index + 1; ?></p>
                           <?php if (!empty($item['heading'])) : ?>
                              <h2>
                                 <button class="vertical-accordion--btn" aria-expanded="<?php echo ($index == 0) ? 'true' : 'false'; ?>" data-aria-controls="accordion<?php echo $index + 1; ?>" id="accordion<?php echo $index + 1; ?>id">
                                    <?php echo $item['heading']; ?>
                                 </button>
                              </h2>
                           <?php endif; ?>
                        </div>
                        <div class="vertical-accordion--content <?php echo ($index == 0) ? 'active' : 'inactive'; ?>" aria-hidden="<?php echo ($index == 0) ? 'false' : 'true'; ?>">
                           <?php if (!empty($item['content'])) : ?>
                              <div>
                                 <?php echo $item['content']; ?>
                              </div>
                           <?php endif; ?>
                           <?php if (!empty($item['link'])) : ?>
                              <a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target'] ?: '_self'; ?>" class="btn">
                                 <?php echo $item['link']['title']; ?>
                              </a>
                           <?php endif; ?>
                        </div>
                     </div>
                  <?php endforeach; ?>
               </div>
               <div class="vertical-accordion--figures" aria-hidden="true">
                  <?php foreach ($fields['accordion_items'] as $index => $item) : ?>
                     <figure class="vertical-accordion--figure <?php echo ($index == 0) ? 'active' : 'inactive'; ?>">
                        <?php echo wp_get_attachment_image($item['image']['ID'], 'full'); ?>
                     </figure>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php
} ?>

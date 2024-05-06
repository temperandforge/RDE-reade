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

   <div class="primary-hero--section">
      <div class="primary-hero--wrap">
         <div class="primary-hero--inner">
            <div class="primary-hero--content">
               <?php if (!empty($fields['heading'])) : ?>
                  <h1><?php echo $fields['heading']; ?></h1>
               <?php endif; ?>
               <?php if (!empty($fields['content'])) : ?>
                  <p><?php echo $fields['content']; ?></p>
               <?php endif; ?>
               <?php 
               if ( array_key_exists('buttons', $fields) && $buttons = $fields['buttons']) {  ?>
               <div class="buttons--wrap">
               <?php
                  foreach($buttons as $idx => $button) :
                     if( ! $btn = $button['btn'] ) {
                        continue;
                     }
                  ?>
                     <a class="<?php echo $idx == 0 ? "btn-blue-dark-blue" : "btn-white-blue";?> btn-arrow" href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target'] ?: '_self'; ?>">
                        <span><?php echo $btn['title']; ?></span>
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1151 5.22214C11.5708 4.76653 12.3095 4.76653 12.7651 5.22214L17.4317 9.88881C17.8873 10.3444 17.8873 11.0831 17.4317 11.5387L12.7651 16.2054C12.3095 16.661 11.5708 16.661 11.1151 16.2054C10.6595 15.7498 10.6595 15.0111 11.1151 14.5555L13.7902 11.8804L4.94011 11.8804C4.29577 11.8804 3.77344 11.3581 3.77344 10.7138C3.77344 10.0694 4.29577 9.5471 4.94011 9.5471H13.7902L11.1151 6.87206C10.6595 6.41645 10.6595 5.67775 11.1151 5.22214Z" fill="white" />
                        </svg>
                     </a>
                  <?php endforeach; ?>
               </div>
               <?php 
               } else if (!empty($fields['link'])) { ?>
                  <a class="btn-blue-dark-blue btn-arrow" href="<?php echo $fields['link']['url']; ?>" target="<?php echo $fields['link']['target'] ?: '_self'; ?>">
                     <span><?php echo $fields['link']['title']; ?></span>
                     <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1151 5.22214C11.5708 4.76653 12.3095 4.76653 12.7651 5.22214L17.4317 9.88881C17.8873 10.3444 17.8873 11.0831 17.4317 11.5387L12.7651 16.2054C12.3095 16.661 11.5708 16.661 11.1151 16.2054C10.6595 15.7498 10.6595 15.0111 11.1151 14.5555L13.7902 11.8804L4.94011 11.8804C4.29577 11.8804 3.77344 11.3581 3.77344 10.7138C3.77344 10.0694 4.29577 9.5471 4.94011 9.5471H13.7902L11.1151 6.87206C10.6595 6.41645 10.6595 5.67775 11.1151 5.22214Z" fill="white" />
                     </svg>
                  </a>
               <?php } ?>
               <div class="primary-hero--decor" aria-hidden="true">
                  <svg class="small-boxes" width="138" height="176" viewBox="0 0 138 176" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M136.844 27.6575L91.5328 1L46.2812 27.6575L91.5583 54.3149V113.099L136.844 86.4497V27.6575ZM136.844 27.6575L91.5583 54.3149L46.2812 27.6575V86.4497L91.5583 113.099" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round" />
                     <path d="M91.5625 89.3308L46.2515 62.6733L1 89.3308L46.277 115.988V174.772L91.5625 148.123V89.3308ZM91.5625 89.3308L46.277 115.988L1 89.3308V148.123L46.277 174.772" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round" />
                  </svg>

                  <svg class="small-box" width="93" height="115" viewBox="0 0 93 115" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M91.5625 27.6575L46.2515 1L1 27.6575L46.277 54.3149V113.099L91.5625 86.4497V27.6575ZM91.5625 27.6575L46.277 54.3149L1 27.6575V86.4497L46.277 113.099" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round" />
                  </svg>

                  <svg class="big-boxes" width="392" height="393" viewBox="0 0 392 393" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M228.101 177.081L114.476 110.233L1 177.081L114.54 243.929V391.339L228.101 324.512V177.081ZM228.101 177.081L114.54 243.929L1 177.081V324.512L114.54 391.339" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round" />
                     <path d="M390.425 67.848L276.8 1L163.324 67.848L276.864 134.696V282.106L390.425 215.279V67.848ZM390.425 67.848L276.864 134.696L163.324 67.848V215.279L276.864 282.106" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round" />
                  </svg>

                  <svg class="medium-box" width="158" height="195" viewBox="0 0 158 195" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M156.688 46.8275L78.793 1L1 46.8275L78.8368 92.6549V193.712L156.688 147.899V46.8275ZM156.688 46.8275L78.8368 92.6549L1 46.8275V147.899L78.8368 193.712" stroke="#AEE3F0" stroke-width="2" stroke-linejoin="round" />
                  </svg>


               </div>
            </div>
            <figure class="primary-hero--figure">
               <?php echo wp_get_attachment_image($fields['image']['ID'], 'full'); ?>
            </figure>
         </div>
      </div>
   </div>

<?php
} ?>

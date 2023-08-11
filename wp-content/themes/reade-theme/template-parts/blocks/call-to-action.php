<?php
// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = get_fields() ?: []) {

?>
<div class="call-to-action">
   <div class="call-to-action-content">
   </div>
   <div class="call-to-action-img">
      <picture>
         <?php if (isset($fields['img']) && isset($fields['img']['ID'])) {
            echo wp_get_attachment_image($fields['img']['ID'], [2048,2048], false, ['role'=>'presentation']);
         } ?>
      </picture>
   </div>
</div>

<?php 
} ?>

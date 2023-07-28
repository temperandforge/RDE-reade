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

<div class="grid-hero--section">
   <div class="grid-hero--wrap">
      <div class="grid-hero--inner">
         <?php if (!empty($fields['image'])) : ?>
            <figure class="grid-hero--figure">
               <?php echo wp_get_attachment_image($fields['image']['ID'], 'full'); ?>
            </figure>
         <?php endif; ?>
         <div class="grid-hero--content">
            <?php if ($fields['heading']) : ?>
               <h1><?php echo $fields['heading']; ?></h1>
            <?php endif; ?>
            <?php if ($fields['content']) : ?>
               <p><?php echo $fields['content']; ?></p>
            <?php endif; ?>
            <?php if (array_key_exists('icon', $fields) && $fields['icon'] != 'no-svg') : ?>
               <div class="grid-hero--decor <?php echo $fields['icon']; ?>" aria-hidden="true"></div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>

<?php 
} ?>

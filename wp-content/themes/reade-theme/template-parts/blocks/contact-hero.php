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

   <div class="contact-hero--section">
      <div class="contact-hero--wrap">

         <figure class="contact-hero--figure">
            <?php echo wp_get_attachment_image($fields['image']['ID'], 'full'); ?>
         </figure>
         <div class="contact-hero--content">
            <?php if (!empty($fields['heading'])) : ?>
               <h1><?php echo $fields['heading']; ?></h1>
            <?php endif; ?>
            <?php if (!empty($fields['content'])) : ?>
               <?php echo $fields['content']; ?>
            <?php endif; ?>
         </div>

      </div>
   </div>

<?php
} ?>

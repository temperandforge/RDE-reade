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

<div class="contact-form--section">
 <div class="contact-form--wrap">
  <?php if(($fields['heading']) || (!empty($fields['content']))) :?>
   <div class="contact-form--heading">
    <?php if($fields['heading']) :?>
     <h2><?php echo $fields['heading'] ;?></h2>
    <?php endif ;?>
    <?php if($fields['content']) :?>
     <p><?php echo $fields['content'] ;?></p>
    <?php endif ;?>
   </div>
  <?php endif ;?>
  <div class="contact-form--form">
   <?php if($fields['form_code']): ?>
    <?php echo do_shortcode($fields['form_code']); ?>
   <?php endif ;?>
  </div>
 </div>
</div>

<?php 
} ?>

<?php

echo '<script>console.log('.json_encode($block, JSON_PRETTY_PRINT).');</script>';//debug

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = get_fields() ?: []) {
   echo '<script>console.log('.json_encode($fields, JSON_PRETTY_PRINT).');</script>';//debug
?>

<section class="basic-content" 
   style="
      <?php if( $pt = $fields['padding-row']['padding-top'] ): ?>
         padding-top: <?php echo $fields['padding-row']['padding-top'].'em;'; ?>
      <?php endif; ?>
      <?php if( $pb = $fields['padding-row']['padding-bottom'] ): ?>
         padding-bottom: <?php echo $fields['padding-row']['padding-bottom'].'em;'; ?>
      <?php endif; ?>
   ">
   <div class="basic-content--wrap">
      <?php if( $heading = $fields['heading'] ): ?>
         <h2><?php echo __($heading, TEXTDOMAIN); ?></h2>
         <?php echo $fields['content']; ?>
      <?php endif; ?>
   </div>
</section>


<?php 
} ?>

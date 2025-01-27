<?php


// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = $args) {
?>

<?php if( $fields['cta_copy'] ): ?>

   <section class="product-cta"
   style="
         <?php if( $pt = $fields['padding-row']['padding-top'] ): ?>
            padding-top: <?php echo $fields['padding-row']['padding-top'].'em;'; ?>
         <?php endif; ?>
         <?php if( $pb = $fields['padding-row']['padding-bottom'] ): ?>
            padding-bottom: <?php echo $fields['padding-row']['padding-bottom'].'em;'; ?>
         <?php endif; ?>
      ">
      <div class="product-cta--wrap">
         <h4><?php echo $fields['cta_copy']; ?></h4>
         <a class="btn-blue-dark-blue" href="<?php echo $fields['cta_link']['url']; ?>"><?php echo $fields['cta_link']['title']; ?></a>
      </div>
   </section>

<?php endif; ?>


<?php 
} ?>

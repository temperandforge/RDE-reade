<?php

print_r ($args);

// Block preview
if( !empty( $block['data']['_is_preview'] ) ) { 
   ?>
   <figure>
      <img style="object-fit: contain; max-width: 100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blocks/grid-hero.webp" alt="Preview of Benefits Block">
   </figure>
<?php 
} else if( $fields = $args) {
?>



<section class="product-cta">
   <div class="product-cta--wrap">
      <h4><?php echo $fields['copy']; ?></h4>
      <a href="<?php echo $fields['link']['link']; ?>" class="btn-blue-dark-blue"><?php echo $fields['link']['title']; ?></a>
   </div>
</section>


<?php 
} ?>

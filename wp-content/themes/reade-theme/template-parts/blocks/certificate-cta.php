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

<div class="certificate-cta <?php if ($fields['lightblue_background']) { echo 'bg-light-blue'; } ?>">
  <?php

  if (!empty($fields['headline'])) {
    ?><h2 class="certificate-cta-headline"><?php echo $fields['headline']; ?></h2><?php
  }

  if (!empty($fields['text'])) {
    ?><p class="certificate-cta-text"><?php echo $fields['text']; ?></p><?php
  }

  if (!empty($fields['button'])) {
    ?>
    <a class="btn-blue-dark-blue" href="<?php echo $fields['button']['url']; ?>" <?php if ($fields['button']['target']) { ?> target="_blank" <?php } ?>><?php echo $fields['button']['title']; ?>
    </a>
    <?php
  }

  ?>
</div>

<?php 
} ?>

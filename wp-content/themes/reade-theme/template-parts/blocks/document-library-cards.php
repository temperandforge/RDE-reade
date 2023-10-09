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

<div class="document-library-cards">
  <?php

  if (!empty($fields['cards'])) {

    foreach ($fields['cards'] AS $card) {

      if (!empty($card['headline']) || !empty($card['text']) || !empty($card['button']['url'])) {
        ?>
        <div class="document-library-card">
          <?php

          if (!empty($card['headline'])) {
            ?><h2 class="document-library-card-headline"><?php echo $card['headline']; ?></h2><?php
          }

          if (!empty($card['text'])) {
            ?>
            <p class="document-library-card-text"><?php echo $card['text']; ?></p><?php
          }

          if (!empty($card['button'])) {
            ?>
            <a class="btn-blue-dark-blue" href="<?php echo $card['button']['url']; ?>" <?php if (!empty($card['button']['target'])) { ?>target="_blank"<?php } ?>><?php echo $card['button']['title']; ?></a>
            <?php
          }

          ?>
        </div>
        <?php
      }
    }

  }

  ?>
</div>

<?php
} ?>

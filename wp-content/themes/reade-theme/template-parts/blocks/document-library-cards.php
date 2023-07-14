<?php

$fields = get_fields();

?>

<div class="document-library-cards">
  <?php

  if (!empty($fields['cards'])) {

    foreach ($fields['cards'] AS $card) {
      ?>
      <div class="document-library-card">
        <?php

        if (!empty($card['headline'])) {
          ?><h5 class="document-library-card-headline"><?php echo $card['headline']; ?></h5><?php
        }

        if (!empty($card['text'])) {
          ?>
          <p class="document-library-card-text"><?php echo $card['text']; ?></p><?php
        }

        if (!empty($card['button'])) {
          ?>
          <a class="btn-blue-dark-blue" href="<?php echo $card['button']['url']; ?>"><?php echo $card['button']['title']; ?></a>
          <?php
        }

        ?>
      </div>
      <?php
    }

  }

  ?>
</div>
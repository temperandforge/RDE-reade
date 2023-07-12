<?php

$fields = get_fields();

?>

<div class="content-grid">
  <?php

  if (!empty($fields['headline']) || !empty($fields['text'])) {
    ?>
    <div class="content-grid-text <?php if ($fields['wider_text']) { ?>wider-text<?php } ?>">
      <?php

      if (!empty($fields['headline'])) {
        ?><h2 class="content-grid-text-headline"><?php echo $fields['headline']; ?></h2><?php
      }

      if (!empty($fields['text'])) {
        ?>
        <p class="content-grid-text-text"><?php echo $fields['text']; ?></p>
        <?php
      }

      ?>
    </div>
    <?php
  }

  if (!empty($fields['items'])) {
    ?>
    <div class="content-grid-items">
      <?php
      
      foreach ($fields['items'] AS $item) {
        ?>
        <div class="content-grid-items-item"><?php echo $item['item_text']; ?></div>
        <?php
      }

      ?>
    </div>
    <?php
  }

  ?>
</div>
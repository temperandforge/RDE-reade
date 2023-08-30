<?php

$fields = get_fields();

?>

<div class="primary-cta bg-geometric">
  <div class="cta-decor-bg" aria-hidden="true"></div>
  <div class="primary-cta-main">
    <?php

    if (!empty($fields['background_image'])) {
      ?>
      <img src="<?php echo $fields['background_image']['url']; ?>"
        alt="<?php echo $fields['background_image']['alt']; ?>"
        width="<?php echo $fields['background_image']['width']; ?>"
        height="<?php echo $fields['background_image']['height']; ?>"
      >
      <?php
    }

    ?>
    <div class="primary-cta-main-container">
      <?php

      if (!empty($fields['headline'])) {
        ?>
        <h2 class="primary-cta-title"><?php echo $fields['headline']; ?></h2>
        <?php
      }

      if (!empty($fields['sub_text'])) {
        ?>
        <p class="primary-cta-subtext"><?php echo $fields['sub_text']; ?></p>
        <?php
      }

      if (!empty($fields['button'])) {
        ?>
        <a class="btn-green-light-green btn-arrow" href="<?php echo $fields['button']['link']; ?>"><?php echo $fields['button']['title']; ?> 
        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 6.62268C12.848 6.28097 13.402 6.28097 13.7437 6.62268L17.2437 10.1227C17.5854 10.4644 17.5854 11.0184 17.2437 11.3601L13.7437 14.8601C13.402 15.2018 12.848 15.2018 12.5063 14.8601C12.1646 14.5184 12.1646 13.9644 12.5063 13.6227L14.5126 11.6164H4.375C3.89175 11.6164 3.5 11.2246 3.5 10.7414C3.5 10.2581 3.89175 9.86639 4.375 9.86639H14.5126L12.5063 7.86011C12.1646 7.5184 12.1646 6.96438 12.5063 6.62268Z" fill="#072D36"/>
        </svg>
        </a>
        <?php
      }

      ?>
    </div>
  </div>
</div>
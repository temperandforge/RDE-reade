<?php

$fields = get_fields();

?>

<div class="split-content-block">
    <div class="split-content-block-text">
        <?php

        if (!empty($fields['headline'])) {
            ?><h2 class="split-content-block-text-headline"><?php echo $fields['headline']; ?></h2><?php
        }

        if (!empty($fields['text'])) {
            ?>
            <p class="split-content-block-text-text"><?php echo $fields['text']; ?></p>
            <?php
        }

        ?>
    </div>
    <div class="split-content-block-bottom <?php if ($fields['alignment']) { echo 'split-content-block-align-right'; } ?>">
        
        <?php

        if (!empty($fields['image']['url'])) {
            ?>
            <div class="split-content-block-image">
                <img src="<?php echo $fields['image']['sizes']['large']; ?>"
                    alt="<?php echo $fields['image']['alt']; ?>"
                    width="<?php echo $fields['image']['sizes']['large-width']; ?>"
                    height="<?php echo $fields['image']['sizes']['large-height']; ?>"
                >
            </div>
            <?php
        }

        ?>

        <div class="split-content-block-card">
            <?php

            if (!empty($fields['card_headline'])) {
                ?>
                <h3 class="split-content-block-card-headline"><?php echo $fields['card_headline']; ?></h3>
                <?php
            }

            if (!empty($fields['card_text'])) {
                ?>
                <p class="split-content-block-card-text"><?php echo $fields['card_text']; ?></p>
                <?php
            }

            ?>
        </div>
    </div>
</div>
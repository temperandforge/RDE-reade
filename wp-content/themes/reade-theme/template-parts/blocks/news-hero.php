<?php

$fields = get_fields();

?>
<div class="news-hero">
    <div class="news-hero-left">
        <div class="news-hero-left-container">
            <h1 class="title"><?php echo !empty($fields['headline']) ? $fields['headline'] : 'Reade News'; ?></h1>
            <p class="news-hero-text"></p><?php echo !empty($fields['text']) ? nl2br($fields['text']) : ''; ?></p>
        </div>
    </div>
    <div class="news-hero-right">
        <?php

        if (!empty($fields['image'])) {
            ?>
            <img src="<?php echo $fields['image']['sizes']['medium_large']; ?>"
             alt="<?php echo !empty($fields['image']['alt']) ? $fields['image']['alt'] : ''; ?>"
             width="<?php echo $fields['image']['sizes']['medium_large-width']; ?>"
             height="<?php echo $fields['image']['sizes']['medium_large-height']; ?>"
            >
            <?php
        }

        ?>
    </div>
</div>
<div class="blog-hero-part">
    <?php

    if (isset($hero_breadcrumbs) && count($hero_breadcrumbs)) {
        ?>
        <p class="blog-hero-breadcrumb">
            <?php

            foreach ($hero_breadcrumbs AS $hb_url => $hb_text) {
                ?>
                <a href="<?php echo $hb_url; ?>"><?php echo $hb_text; ?></a>
                <?php
            }

            ?>
        </p>
        <?php
    }

    if (isset($hero_headline) && $hero_headline) {
        ?>
        <h1 class="title"><?php echo $hero_headline; ?></h1>
        <?php
    }

            
    if (!empty($hero_description)) {
        ?>
        <p class="blog-hero-description"><?php echo $hero_description; ?></p>
        <?php
    }

    if (isset($hero_search) && $hero_search) {
        ?>
        <input class="news-search" type="text" name="sv" placeholder="<?php echo !empty($fields['search_placeholder_text']) ? $fields['search_placeholder_text'] : 'Search'; ?>">
        <?php
    }
    ?>
</div>
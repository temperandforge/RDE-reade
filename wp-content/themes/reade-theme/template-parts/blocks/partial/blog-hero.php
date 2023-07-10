<div class="blog-hero-part">
    <?php

    if (isset($hero_breadcrumbs) && count($hero_breadcrumbs)) {
        ?>
        <p class="blog-hero-breadcrumb">
            <?php

            foreach ($hero_breadcrumbs AS $hb_url => $hb_text) {
                ?>
                <a href="<?php echo $hb_url; ?>"><?php echo $hb_text; ?></a> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.88128C12.348 5.53957 12.902 5.53957 13.2437 5.88128L16.7437 9.38128C17.0854 9.72299 17.0854 10.277 16.7437 10.6187L13.2437 14.1187C12.902 14.4604 12.348 14.4604 12.0063 14.1187C11.6646 13.777 11.6646 13.223 12.0063 12.8813L14.0126 10.875H3.875C3.39175 10.875 3 10.4832 3 10C3 9.51675 3.39175 9.125 3.875 9.125H14.0126L12.0063 7.11872C11.6646 6.77701 11.6646 6.22299 12.0063 5.88128Z" fill="#009FC6"/>
</svg>

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
        <form action="/news-search/" method="GET">
            <label for="sv-input">
                <span class="sr-only">Search</span>
               <input id="sv-input" class="news-search" type="text" name="sv" placeholder="<?php echo !empty($fields['search_placeholder_text']) ? $fields['search_placeholder_text'] : 'Search'; ?>">
            </label>
            
        </form>
        <?php
    }
    ?>
</div>
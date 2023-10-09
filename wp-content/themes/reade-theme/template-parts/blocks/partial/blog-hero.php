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
        <form id="search-form" action="/news-search/" method="GET">
            <label for="sv-input">
                <span class="sr-only">Search</span>
               <input id="sv-input" class="news-search" type="text" name="sv" placeholder="<?php echo !empty($fields['search_placeholder_text']) ? $fields['search_placeholder_text'] : 'Search'; ?>">
               <?php

               if ($qo = get_queried_object()) {
                ?>
                <input type="hidden" name="from" value="<?php echo $qo->term_id; ?>">
                <?php
               }

               ?>
               <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="document.getElementById('search-form').submit();">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 5.25C6.317 5.25 4.75 6.817 4.75 8.75C4.75 10.683 6.317 12.25 8.25 12.25C10.183 12.25 11.75 10.683 11.75 8.75C11.75 6.817 10.183 5.25 8.25 5.25ZM3 8.75C3 5.85051 5.35051 3.5 8.25 3.5C11.1495 3.5 13.5 5.85051 13.5 8.75C13.5 9.88385 13.1406 10.9338 12.5294 11.792L16.7437 16.0063C17.0854 16.348 17.0854 16.902 16.7437 17.2437C16.402 17.5854 15.848 17.5854 15.5063 17.2437L11.292 13.0294C10.4338 13.6406 9.38385 14 8.25 14C5.35051 14 3 11.6495 3 8.75Z" fill="#009FC6" onclick="document.getElementById('search-form').submit();" />
                </svg>
            </label>
            
        </form>
        <?php
    }
    ?>
</div>
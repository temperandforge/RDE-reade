<?php

$fields = get_fields();

if (!empty($fields['category'])) {
    
    $cat = get_term_by('id', $fields['category'], 'category');
    if ($cat && $cat->count > 0) {
        ?><div class="news-category">
            <div class="news-category-top">
                <div class="news-category-top-left">
                    <h2 class="category-name"><?php echo $cat->name; ?></h2>
                    <?php
                    
                    if (!empty($cat->description)) {
                        ?>
                        <p class="category-desc"><?php echo $cat->description; ?></p>
                        <?php
                    }

                    ?>
                </div>
                <div class="news-category-top-right">
                    <a class="btn-white-blue btn-arrow" href="<?php echo get_category_link($cat->term_id); ?>"><?php echo !empty($fields['button_text']) ? $fields['button_text'] : 'View'; echo ' ' . $cat->name; ?>
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8696 5.95428C13.2113 5.61257 13.7653 5.61257 14.107 5.95428L17.607 9.45428C17.9487 9.79599 17.9487 10.35 17.607 10.6917L14.107 14.1917C13.7653 14.5334 13.2113 14.5334 12.8696 14.1917C12.5279 13.85 12.5279 13.296 12.8696 12.9543L14.8758 10.948H4.73828C4.25503 10.948 3.86328 10.5562 3.86328 10.073C3.86328 9.58975 4.25503 9.198 4.73828 9.198H14.8758L12.8696 7.19172C12.5279 6.85001 12.5279 6.29599 12.8696 5.95428Z" fill="#009FC6"/>
                    </svg>
                    </a>
                </div>
            </div>
            <div class="news-category-articles dragscroll">
                <?php

                // get most recent posts
                $nposts = get_posts(array(
                    'numberposts' => 3,
                    'category' => $cat->term_id
                ));

                foreach ($nposts AS $npost) {
                    include 'partial/news-card.php';
                }

                ?>
            </div>
        </div>
        <?php
    }
}
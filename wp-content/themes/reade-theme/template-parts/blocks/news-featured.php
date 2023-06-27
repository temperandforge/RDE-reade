<?php

$fields = get_fields();

?>
<div class="news-featured">
    <div class="news-featured-top">
        <div class="news-featured-top-left">
            <?php

            $ddopts = array(
                'show_all' => false,
                'select_text' => !empty($fields['category_select_text']) ? $fields['category_select_text'] : 'All',
                'svg' => '<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.519284 0.965493C0.28888 1.17537 0.272236 1.53228 0.482109 1.76269L5.25031 6.99734C5.35724 7.11473 5.50869 7.18164 5.66749 7.18164C5.82629 7.18164 5.97774 7.11473 6.08467 6.99734L10.8529 1.76268C11.0627 1.53228 11.0461 1.17537 10.8157 0.965492C10.5853 0.755619 10.2284 0.772263 10.0185 1.00267L5.66749 5.77932L1.31648 1.00267C1.1066 0.772264 0.749688 0.75562 0.519284 0.965493Z" fill="#009FC6"/>
                </svg>',
                'width' => '342px'
            );

            if (!empty($fields['categories_in_dropdown'])) {
                $catids = array_values($fields['categories_in_dropdown']);
                foreach ($catids AS $catid) {
                    $caturl = get_category_link($catid);
                    $ddopts['values'][$caturl] = get_term_by('id', $catid, 'category')->name;
                }
            }

            tf_dropdown($ddopts);

            ?>
        </div>
        <div class="news-featured-top-right">
                <input type="text" name="sv" placeholder="<?php echo !empty($fields['search_placeholder_text']) ? $fields['search_placeholder_text'] : 'Search'; ?>">
            </form>
        </div>
    </div>
    <?php

    if (!empty($fields['featured_article'])) {
        $farticleimg = get_the_post_thumbnail($fields['featured_article'][0]->ID);
        
        ?>
        <div class="news-featured-article">
            <div class="news-featured-article-left">
                <h4 class="news-headline">
                <?php

                echo $fields['featured_article'][0]->post_title;

                ?>
                </h4>

                <?php

                if (!empty($fields['featured_article'][0]->post_excerpt)) {
                    ?>
                    <p class="news-excerpt"><?php echo $fields['featured_article'][0]->post_excerpt; ?></p>
                    <?php
                }

                ?>
                <a class="btn-green-dark-green btn-arrow" href="<?php echo get_permalink($fields['featured_article'][0]->ID); ?>">
                Read More
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5063 6.38128C12.848 6.03957 13.402 6.03957 13.7437 6.38128L17.2437 9.88128C17.5854 10.223 17.5854 10.777 17.2437 11.1187L13.7437 14.6187C13.402 14.9604 12.848 14.9604 12.5063 14.6187C12.1646 14.277 12.1646 13.723 12.5063 13.3813L14.5126 11.375H4.375C3.89175 11.375 3.5 10.9832 3.5 10.5C3.5 10.0168 3.89175 9.625 4.375 9.625H14.5126L12.5063 7.61872C12.1646 7.27701 12.1646 6.72299 12.5063 6.38128Z" fill="#FAFAFA"/>
                </svg>
                </a>
            </div>
            <div class="news-featured-article-right">
                <?php
                if ($farticleimg) {
                    echo $farticleimg;
                }
                ?>
            </div>
        </div>
        <?php
    }

    ?>
   
</div>
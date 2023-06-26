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
                    $ddopts['values'][$catid] = get_term_by('id', $catid, 'category')->name;
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
                left
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
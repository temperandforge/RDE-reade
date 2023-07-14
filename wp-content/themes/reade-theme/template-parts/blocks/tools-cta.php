<?php

$fields = get_fields();

?>

<div class="tools-cta">
  <div class="tools-cta-top bg-grid">
    <div class="tools-cta-top-container">
        <div class="tools-cta-top-left">
            <?php

            if (!empty($fields['main_image'])) {
                ?>
                <img src="<?php echo $fields['main_image']['sizes']['medium_large']; ?>"
                    alt="<?php echo $fields['main_image']['alt']; ?>"
                    width="<?php echo $fields['main_image']['sizes']['medium_large-width']; ?>"
                    height="<?php echo $fields['main_image']['sizes']['medium_large-height']; ?>"
                >
                <?php
            }

            ?>
        </div>
        <div class="tools-cta-top-right">
            <?php

            if (!empty($fields['headline'])) {
                ?>
                <h1 class="title"><?php echo $fields['headline']; ?></h1>
                <?php
            }

            if (!empty($fields['sub_text'])) {
                ?>
                <p class="tools-cta-sub-text"><?php echo nl2br($fields['sub_text']); ?></p>
                <?php
            }

            ?>
        </div>
    </div>
  </div>
  <?php

    if (!empty($fields['categories'])) {
        ?>
        <div class="tools-cta-bottom">
            <?php
            
            if (!empty($fields['decor_image'])) {
                ?>
                <img
                    class="tools-decor-image"
                    src="<?php echo $fields['decor_image']['url']; ?>"
                    alt="<?php echo $fields['decor_image']['alt']; ?>"
                    width="<?php echo $fields['decor_image']['width']; ?>"
                    height="<?php echo $fields['decor_image']['height']; ?>"
                >
                <?php
            }

            ?>
            <div class="tools-cta-bottom-container">
                <?php

                foreach ($fields['categories'] AS $category) {
                    //$term = get_term_by('term_taxonomy_id', $category, 'tools_category');
                    //$cfields = get_fields($term);
                    
                    ?>
                    <div class="tools-cta-bottom-category">
                        <h2 class="tools-category"><?php echo $category['headline']; ?></h2>
                        <?php

                        if (!empty($category['text'])) {
                            ?>
                            <p><?php echo $category['text']; ?></p>
                            <?php
                        }

                        if (!empty($category['button'])) {
                            ?>
                            <a class="btn-blue-dark-blue btn-arrow" href="<?php echo $category['button']['url']; ?>">
                            <?php echo $category['button']['title']; ?>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0063 5.88128C12.348 5.53957 12.902 5.53957 13.2437 5.88128L16.7437 9.38128C17.0854 9.72299 17.0854 10.277 16.7437 10.6187L13.2437 14.1187C12.902 14.4604 12.348 14.4604 12.0063 14.1187C11.6646 13.777 11.6646 13.223 12.0063 12.8813L14.0126 10.875H3.875C3.39175 10.875 3 10.4832 3 10C3 9.51675 3.39175 9.125 3.875 9.125H14.0126L12.0063 7.11872C11.6646 6.77701 11.6646 6.22299 12.0063 5.88128Z" fill="#FAFAFA"/>
                            </svg>
                            </a>
                            <?php
                        }

                        ?>
                    </div>
                    <?php
                }

                ?>
            </div>
        </div>
        <?php
    }

    ?>
</div>